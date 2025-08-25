<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePageSectionRequest;
use App\Http\Requests\UpdatePageSectionRequest;
use App\Infrastructure\Models\PageSection;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PageSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $sections = PageSection::latest()->paginate(20); // paginate 20 per page
        return view('page_sections.index', compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('page_sections.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePageSectionRequest $request): RedirectResponse
    {
        $data = $request->validated();
        PageSection::create($data);

        return redirect()->route('page_sections.index')
            ->with('success', 'Page section created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(PageSection $pageSection): View
    {
        return view('page_sections.show', compact('pageSection'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PageSection $pageSection): View
    {
        return view('page_sections.edit', compact('pageSection'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePageSectionRequest $request, PageSection $pageSection): RedirectResponse
    {
        $data = $request->validated();
        $pageSection->update($data);

        return redirect()->route('page_sections.index')
            ->with('success', 'Page section updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PageSection $pageSection): RedirectResponse
    {
        $pageSection->delete();

        return redirect()->route('page_sections.index')
            ->with('success', 'Page section deleted successfully.');
    }
}
