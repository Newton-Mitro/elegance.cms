<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVisitorRequest;
use App\Http\Requests\UpdateVisitorRequest;
use App\Infrastructure\Models\Visitor;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class VisitorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $visitors = Visitor::latest()->paginate(20);
        return view('visitors.index', compact('visitors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('visitors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVisitorRequest $request): RedirectResponse
    {
        $data = $request->validated();
        Visitor::create($data);

        return redirect()->route('visitors.index')
            ->with('success', 'Visitor added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Visitor $visitor): View
    {
        return view('visitors.show', compact('visitor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Visitor $visitor): View
    {
        return view('visitors.edit', compact('visitor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVisitorRequest $request, Visitor $visitor): RedirectResponse
    {
        $data = $request->validated();
        $visitor->update($data);

        return redirect()->route('visitors.index')
            ->with('success', 'Visitor updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Visitor $visitor): RedirectResponse
    {
        $visitor->delete();

        return redirect()->route('visitors.index')
            ->with('success', 'Visitor deleted successfully.');
    }
}
