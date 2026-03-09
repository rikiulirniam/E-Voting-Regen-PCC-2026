<?php

namespace App\Http\Controllers;

use App\Models\Voting;
use App\Http\Requests\StoreVotingRequest;
use App\Http\Requests\UpdateVotingRequest;

class VotingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreVotingRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Voting $voting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Voting $voting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVotingRequest $request, Voting $voting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Voting $voting)
    {
        //
    }
}
