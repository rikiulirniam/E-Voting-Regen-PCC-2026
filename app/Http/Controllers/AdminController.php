<?php

namespace App\Http\Controllers;

use App\Models\CalonAdmin;
use App\Models\Peserta;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view("pages.admin.dashboard", [
            'totalPeserta'     => Peserta::count(),
            'sudahVote'        => Peserta::where('status_vote', 'sudah')->count(),
            'belumVote'        => Peserta::where('status_vote', 'belum')->count(),
            'totalCamin'       => CalonAdmin::count(),
        ]);
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
