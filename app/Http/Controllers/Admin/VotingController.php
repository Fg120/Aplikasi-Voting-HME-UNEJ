<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\KandidatRepository;
use App\Repositories\LogVotingRepository;
use Illuminate\Http\Request;

class VotingController extends Controller
{
    private $kandidatRepo, $logVotingRepo;

    public function __construct()
    {
        $this->kandidatRepo = new KandidatRepository;
        $this->logVotingRepo = new LogVotingRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function monitor()
    {
        $kandidats = $this->kandidatRepo->all();
        $logs = $this->logVotingRepo->allLatest();
        return view('admin.voting.monitor', compact('kandidats', 'logs'));
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
