<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRouteVisitLogRequest;
use App\Http\Requests\UpdateRouteVisitLogRequest;
use App\Infrastructure\Models\RouteVisitLog;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RouteVisitLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $logs = RouteVisitLog::latest()->paginate(20);
        return view('route_visit_logs.index', compact('logs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('route_visit_logs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRouteVisitLogRequest $request): RedirectResponse
    {
        $data = $request->validated();

        RouteVisitLog::create($data);

        return redirect()->route('route_visit_logs.index')
            ->with('success', 'Route visit log created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(RouteVisitLog $routeVisitLog): View
    {
        return view('route_visit_logs.show', compact('routeVisitLog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RouteVisitLog $routeVisitLog): View
    {
        return view('route_visit_logs.edit', compact('routeVisitLog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRouteVisitLogRequest $request, RouteVisitLog $routeVisitLog): RedirectResponse
    {
        $data = $request->validated();

        $routeVisitLog->update($data);

        return redirect()->route('route_visit_logs.index')
            ->with('success', 'Route visit log updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RouteVisitLog $routeVisitLog): RedirectResponse
    {
        $routeVisitLog->delete();

        return redirect()->route('route_visit_logs.index')
            ->with('success', 'Route visit log deleted successfully.');
    }
}
