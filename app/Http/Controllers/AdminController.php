<?php

namespace App\Http\Controllers;

use App\Models\CalonAdmin;
use App\Models\Peserta;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('pages.admin.dashboard', $this->dashboardData());
    }

    public function display()
    {
        return view('pages.admin.display', array_merge(
            $this->dashboardData(),
            [
                'displayQrUrl' => config('app.display_qr_url'),
            ]
        ));
    }

    public function displayStats()
    {
        return response()->json($this->displayStatsData());
    }

    private function displayStatsData(): array
    {
        $totalPeserta = Peserta::count();
        $sudahVote = Peserta::where('status_vote', 'sudah')->count();
        $belumVote = Peserta::where('status_vote', 'belum')->count();
        $percentageVoted = $totalPeserta > 0 ? round(($sudahVote / $totalPeserta) * 100, 1) : 0.0;
        $percentageRemaining = max(0, round(100 - $percentageVoted, 1));

        return [
            'totalPeserta' => $totalPeserta,
            'sudahVote' => $sudahVote,
            'belumVote' => $belumVote,
            'percentageVoted' => $percentageVoted,
            'percentageRemaining' => $percentageRemaining,
            'updatedAt' => now()->format('H:i:s'),
        ];
    }

    private function dashboardData(): array
    {
        $stats = $this->displayStatsData();

        return [
            'totalPeserta'  => $stats['totalPeserta'],
            'sudahVote'     => $stats['sudahVote'],
            'belumVote'     => $stats['belumVote'],
            'totalCamin'    => CalonAdmin::count(),
            'votePerPaslon' => CalonAdmin::withCount('votings')->orderBy('no_urut')->get(),
        ];
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
