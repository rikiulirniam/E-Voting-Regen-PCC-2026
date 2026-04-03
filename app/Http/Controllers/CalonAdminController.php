<?php

namespace App\Http\Controllers;

use App\Models\CalonAdmin;
use App\Http\Requests\StoreCalonAdminRequest;
use App\Http\Requests\UpdateCalonAdminRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class CalonAdminController extends Controller
{
    public function index()
    {
        return view("pages.admin.camin.index", [
            "camin" => CalonAdmin::orderBy('no_urut')->get()
        ]);
    }

    // frontend
    public function camin()
    {
        $calon_admin = CalonAdmin::orderBy('no_urut')->get();
        return view('pages.public.voting', compact('calon_admin'));
    }
    public function vote_in(Request $request)
    {
        try {
            $camin_id = $request->input('c_admin_id');
            $user = auth()->user();

            \Log::info('Vote attempt', ['user_id' => $user->id, 'camin_id' => $camin_id]);

            // Validate that c_admin_id is provided
            if (!$camin_id) {
                return back()->with('error', 'Calon admin harus dipilih.');
            }

            $camin = CalonAdmin::findOrFail($camin_id);
                $peserta = $user->peserta;

            // Validate that peserta exists
            if (!$peserta) {
                \Log::error('Vote failed: Peserta not found', ['user_id' => $user->id]);
                return redirect()->route('logout');
            }

            // Check if already voted
            if ($peserta->status_vote === 'sudah') {
                \Log::info('Vote rejected: User already voted', ['user_id' => $user->id, 'peserta_id' => $peserta->id]);
                return redirect()->route('vote-in.success')->with('info', 'Anda sudah melakukan voting.');
            }

            // Create voting record
            $voting = $camin->votings()->create(['id_peserta' => $peserta->id]);

            // Update peserta status
            $peserta->update(['status_vote' => 'sudah']);

            \Log::info('Vote recorded successfully', [
                'user_id' => $user->id,
                'peserta_id' => $peserta->id,
                'camin_id' => $camin_id,
                'voting_id' => $voting->id,
            ]);

            return redirect()->route('vote-in.success')->with('success', 'Vote berhasil direkam!');
        } catch (\Illuminate\Database\QueryException $e) {
            // Handle double vote attempt (unique constraint violation on id_peserta)
            if (strpos($e->getMessage(), 'UNIQUE constraint failed') !== false ||
                strpos($e->getMessage(), 'Duplicate entry') !== false) {
                \Log::warning('Duplicate vote attempt (constraint violation)', [
                    'user_id' => $user->id ?? null,
                    'error' => $e->getMessage(),
                ]);
                return redirect()->route('vote-in.success')->with('info', 'Anda sudah melakukan voting.');
            }

            // Log other database errors
            \Log::error('Voting database error: ' . $e->getMessage(), ['user_id' => $user->id ?? null]);
            return back()->with('error', 'Terjadi kesalahan database. Silakan coba lagi.');
        } catch (\Exception $e) {
            \Log::error('Voting error: ' . $e->getMessage(), ['user_id' => $user->id ?? null, 'trace' => $e->getTraceAsString()]);
            return back()->with('error', 'Terjadi kesalahan. Silakan coba lagi.');
        }
    }

    public function vote_in_fallback()
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        $peserta = $user->peserta;

        if ($peserta && $peserta->status_vote === 'sudah') {
            return redirect()->route('vote-in.success');
        }

        return redirect()->route('dashboard');
    }

    public function vote_in_success()
    {
        $camin = CalonAdmin::all();
        return view('pages.public.vote_in', compact('camin'));
    }
    // fe end

    public function create()
    {
        return view("pages.admin.camin.create");
    }

    public function store(StoreCalonAdminRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('calon_admins', 'public');
        }

        CalonAdmin::create($data);

        return redirect()->route('camin.index')->with('success', 'Calon admin berhasil ditambahkan.');
    }

    public function show(CalonAdmin $calonAdmin)
    {
        //
    }

    public function edit(CalonAdmin $camin)
    {
        return view("pages.admin.camin.edit", compact('camin'));
    }

    public function update(UpdateCalonAdminRequest $request, CalonAdmin $camin)
    {
        $data = $request->validated();

        if ($request->hasFile('foto')) {
            if ($camin->foto) {
                Storage::disk('public')->delete($camin->foto);
            }
            $data['foto'] = $request->file('foto')->store('calon_admins', 'public');
        } else {
            unset($data['foto']);
        }

        $camin->update($data);

        return redirect()->route('camin.index')->with('success', 'Calon admin berhasil diperbarui.');
    }

    public function destroy(CalonAdmin $camin)
    {
        if ($camin->foto) {
            Storage::disk('public')->delete($camin->foto);
        }

        $camin->delete();

        return redirect()->route('camin.index')->with('success', 'Calon admin berhasil dihapus.');
    }
}
