<?php

namespace App\Http\Controllers;

use App\Mail\PesertaCredentials;
use App\Models\CalonAdmin;
use App\Models\Peserta;
use App\Models\User;
use App\Models\Voting;
use App\Http\Requests\StorePesertaRequest;
use App\Http\Requests\UpdatePesertaRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PesertaController extends Controller
{
    public function index(Request $request)
    {
        $query = Peserta::with('user');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('nim', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $pesertas = $query->orderBy('name')->paginate(10)->withQueryString();

        return view('pages.admin.peserta.index', compact('pesertas'));
    }

    public function create()
    {
        return view('pages.admin.peserta.create');
    }

    public function store(StorePesertaRequest $request)
    {
        $file   = $request->file('file');
        $path   = $file->getRealPath();
        $handle = fopen($path, 'r');

        // Read first raw line to detect delimiter (handles sep=, or sep=; or plain CSV)
        $firstRaw  = fgets($handle);
        $delimiter = str_contains($firstRaw, ';') ? ';' : ',';

        if (str_starts_with(trim($firstRaw), 'sep=')) {
            // Extract explicit delimiter from sep= hint (e.g. sep=; → delimiter is ;)
            $sepVal    = trim(substr(trim($firstRaw), 4));
            $delimiter = $sepVal ?: $delimiter;
            fgetcsv($handle, 0, $delimiter); // skip header row
        }

        $inserted = 0;
        $skipped  = 0;
        $errors   = [];
        $row      = 1;

        while (($data = fgetcsv($handle, 1000, $delimiter)) !== false) {
            $row++;

            if (empty(array_filter($data))) {
                continue;
            }

            if (count($data) < 3) {
                $errors[] = "Baris {$row}: kolom tidak lengkap (minimal: name, nim, email).";
                $skipped++;
                continue;
            }

            [$name, $nim, $email] = array_map('trim', $data);
            $status_jabatan = isset($data[3]) ? trim($data[3]) : 'anggota aktif';

            $validator = Validator::make([
                'name'           => $name,
                'nim'            => $nim,
                'email'          => $email,
                'status_jabatan' => $status_jabatan,
            ], [
                'name'           => ['required', 'string', 'max:255'],
                'nim'            => ['required', 'string', 'max:50', 'unique:pesertas,nim'],
                'email'          => ['required', 'email', 'max:255', 'unique:pesertas,email'],
                'status_jabatan' => ['required', 'in:anggota aktif,STO'],
            ]);

            if ($validator->fails()) {
                $errors[] = "Baris {$row} ({$nim}): " . implode(', ', $validator->errors()->all());
                $skipped++;
                continue;
            }

            // Generate unique username (NIM as base, append random suffix if taken)
            $username = $nim;
            while (User::where('username', $username)->exists()) {
                $username = $nim . '_' . Str::random(4);
            }

            $plainPassword = Str::random(10);

            DB::transaction(function () use (
                $name,
                $nim,
                $email,
                $status_jabatan,
                $username,
                $plainPassword,
                &$inserted
            ) {
                $peserta = Peserta::create([
                    'name'           => $name,
                    'nim'            => $nim,
                    'email'          => $email,
                    'status_jabatan' => $status_jabatan,
                    'status_vote'    => 'belum',
                ]);

                User::create([
                    'name'       => $name,
                    'username'   => $username,
                    'password'   => Hash::make($plainPassword),
                    'role'       => 'user',
                    'id_peserta' => $peserta->id,
                ]);

                Mail::to($email)->send(new PesertaCredentials($peserta, $username, $plainPassword));
                $inserted++;
            });
        }

        fclose($handle);

        $message = "{$inserted} peserta berhasil diimpor dan kredensial dikirim via email.";
        if ($skipped > 0) {
            $message .= " {$skipped} baris dilewati.";
        }

        return redirect()->route('peserta.index')
            ->with('success', $message)
            ->with('import_errors', $errors);
    }

    public function importVoteResults(StorePesertaRequest $request)
    {
        $file = $request->file('file');
        $path = $file->getRealPath();
        $handle = fopen($path, 'r');

        $firstRaw = fgets($handle);
        $delimiter = str_contains((string) $firstRaw, ';') ? ';' : ',';

        if (str_starts_with(trim((string) $firstRaw), 'sep=')) {
            $sepVal = trim(substr(trim((string) $firstRaw), 4));
            $delimiter = $sepVal ?: $delimiter;
            $headerRow = fgetcsv($handle, 0, $delimiter);
        } else {
            $headerRow = str_getcsv((string) $firstRaw, $delimiter);
        }

        if ($headerRow === false) {
            fclose($handle);
            return redirect()->route('peserta.index')->with('error', 'File CSV kosong atau tidak valid.');
        }

        $normalizeHeader = static function (?string $value): string {
            $value = Str::lower(trim((string) $value));
            $value = str_replace(['.', '-', ' '], '_', $value);
            $value = preg_replace('/_+/', '_', $value);

            return trim((string) $value, '_');
        };

        $headerMap = [];
        foreach ($headerRow as $index => $headerCell) {
            $key = $normalizeHeader($headerCell);
            if ($key !== '') {
                $headerMap[$key] = $index;
            }
        }

        $resolveIndex = static function (array $aliases, array $map, ?int $fallback = null): ?int {
            foreach ($aliases as $alias) {
                if (array_key_exists($alias, $map)) {
                    return $map[$alias];
                }
            }

            return $fallback;
        };

        $nimIndex = $resolveIndex(['nim'], $headerMap, 1);
        $statusVoteIndex = $resolveIndex(['status_vote'], $headerMap, 5);
        $noUrutPilihanIndex = $resolveIndex(['no_urut_pilihan', 'no_urut', 'pilihan'], $headerMap, 6);

        if ($nimIndex === null || $statusVoteIndex === null) {
            fclose($handle);

            return redirect()->route('peserta.index')
                ->with('error', 'Header CSV wajib memuat kolom NIM dan Status Vote.');
        }

        $updated = 0;
        $skipped = 0;
        $errors = [];
        $row = 1;

        while (($data = fgetcsv($handle, 1000, $delimiter)) !== false) {
            $row++;

            if (empty(array_filter($data))) {
                continue;
            }

            $nim = trim((string) ($data[$nimIndex] ?? ''));
            $statusVote = Str::lower(trim((string) ($data[$statusVoteIndex] ?? '')));
            $noUrutPilihan = $noUrutPilihanIndex !== null
                ? trim((string) ($data[$noUrutPilihanIndex] ?? ''))
                : '';

            if ($nim === '') {
                $errors[] = "Baris {$row}: kolom NIM kosong.";
                $skipped++;
                continue;
            }

            if (!in_array($statusVote, ['belum', 'sudah'], true)) {
                $errors[] = "Baris {$row} ({$nim}): Status Vote harus bernilai belum/sudah.";
                $skipped++;
                continue;
            }

            $peserta = Peserta::where('nim', $nim)->first();
            if (!$peserta) {
                $errors[] = "Baris {$row} ({$nim}): peserta tidak ditemukan.";
                $skipped++;
                continue;
            }

            $selectedCalonAdmin = null;
            if ($statusVote === 'sudah') {
                if ($noUrutPilihan === '') {
                    $errors[] = "Baris {$row} ({$nim}): status_vote sudah, tapi No.Urut Pilihan kosong.";
                    $skipped++;
                    continue;
                }

                $selectedCalonAdmin = CalonAdmin::where('no_urut', $noUrutPilihan)->first();
                if (!$selectedCalonAdmin) {
                    $errors[] = "Baris {$row} ({$nim}): No.Urut Pilihan {$noUrutPilihan} tidak ditemukan di data calon admin.";
                    $skipped++;
                    continue;
                }
            }

            DB::transaction(function () use ($peserta, $statusVote, $selectedCalonAdmin, &$updated) {
                $peserta->update(['status_vote' => $statusVote]);

                if ($statusVote === 'sudah' && $selectedCalonAdmin) {
                    Voting::updateOrCreate(
                        ['id_peserta' => $peserta->id],
                        ['id_calon_admin' => $selectedCalonAdmin->id]
                    );
                } else {
                    Voting::where('id_peserta', $peserta->id)->delete();
                }

                $updated++;
            });
        }

        fclose($handle);

        $message = "{$updated} data hasil vote berhasil diimpor.";
        if ($skipped > 0) {
            $message .= " {$skipped} baris dilewati.";
        }

        return redirect()->route('peserta.index')
            ->with('success', $message)
            ->with('import_errors', $errors);
    }

    public function show(Peserta $peserta)
    {
        //
    }

    public function edit(Peserta $peserta)
    {
        $peserta->load('user');
        return view('pages.admin.peserta.edit', compact('peserta'));
    }

    public function update(UpdatePesertaRequest $request, Peserta $peserta)
    {
        $data = $request->validated();

        $statusVoteSebelumnya = $peserta->status_vote;

        $peserta->update([
            'name'           => $data['name'],
            'nim'            => $data['nim'],
            'email'          => $data['email'],
            'status_jabatan' => $data['status_jabatan'],
            'status_vote'    => $data['status_vote'],
        ]);

        if ($statusVoteSebelumnya !== 'belum' && $data['status_vote'] === 'belum') {
            Voting::where('id_peserta', $peserta->id)->delete();
        }

        if ($peserta->user) {
            $peserta->user->update(['username' => $data['username']]);
        }

        return redirect()->route('peserta.index')->with('success', 'Data peserta berhasil diperbarui.');
    }

    public function sendCredentials(Peserta $peserta)
    {
        $peserta->load('user');

        if (!$peserta->user) {
            return redirect()->route('peserta.index')->with('error', 'Peserta ini belum memiliki akun user.');
        }

        $plainPassword = Str::random(10);
        $peserta->user->update(['password' => Hash::make($plainPassword)]);

        Mail::to($peserta->email)->send(
            new PesertaCredentials($peserta, $peserta->user->username, $plainPassword)
        );

        return redirect()->route('peserta.index')
            ->with('success', "Kredensial baru berhasil dikirim ke {$peserta->email}.");
    }

    public function destroy(Peserta $peserta)
    {
        Voting::where('id_peserta', $peserta->id)->delete();
        $peserta->user?->delete();
        $peserta->delete();

        return redirect()->route('peserta.index')->with('success', 'Peserta berhasil dihapus.');
    }

    public function destroyAll()
    {
        $pesertaIds = Peserta::pluck('id');

        if ($pesertaIds->isEmpty()) {
            return redirect()->route('peserta.index')->with('error', 'Tidak ada data peserta untuk dihapus.');
        }

        DB::transaction(function () use ($pesertaIds) {
            Voting::whereIn('id_peserta', $pesertaIds)->delete();
            User::whereIn('id_peserta', $pesertaIds)->delete();
            Peserta::whereIn('id', $pesertaIds)->delete();
        });

        return redirect()->route('peserta.index')->with('success', 'Semua data peserta berhasil dihapus.');
    }

    public function downloadTemplate()
    {
        $headers = [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename="template_peserta.csv"',
        ];

        $callback = function () {
            $handle = fopen('php://output', 'w');
            fputs($handle, "sep=,\n");
            fputs($handle, "name,nim,email,status_jabatan\n");
            fputs($handle, "Contoh Nama,2024001,contoh@email.com,anggota aktif\n");
            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function export()
    {
        $pesertas = Peserta::with(['user', 'voting.calonAdmin'])->orderBy('name')->get();

        $filename = 'peserta_' . now()->format('Ymd_His') . '.csv';

        $headers = [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($pesertas) {
            $handle = fopen('php://output', 'w');
            fputs($handle, "sep=,\n");
            fputcsv($handle, ['Nama', 'NIM', 'E-mail', 'Username', 'Status Jabatan', 'Status Vote', 'No.Urut Pilihan']);

            foreach ($pesertas as $peserta) {
                fputcsv($handle, [
                    $peserta->name,
                    $peserta->nim,
                    $peserta->email,
                    $peserta->user?->username ?? '',
                    $peserta->status_jabatan,
                    $peserta->status_vote,
                    $peserta->voting?->calonAdmin?->no_urut ?? '',
                ]);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }
}

