<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTeamRequest;
use App\Http\Requests\UpdateTeamRequest;
use App\Infrastructure\Models\Team;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $teams = Team::latest()->paginate(20);
        return view('teams.index', compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('teams.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTeamRequest $request): RedirectResponse
    {
        $data = $request->validated();

        Team::create($data);

        return redirect()->route('teams.index')
            ->with('success', 'Team member created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Team $team): View
    {
        return view('teams.show', compact('team'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Team $team): View
    {
        return view('teams.edit', compact('team'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTeamRequest $request, Team $team): RedirectResponse
    {
        $data = $request->validated();

        $team->update($data);

        return redirect()->route('teams.index')
            ->with('success', 'Team member updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team): RedirectResponse
    {
        $team->delete();

        return redirect()->route('teams.index')
            ->with('success', 'Team member deleted successfully.');
    }
}
