<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePageRequest;
use App\Http\Requests\UpdatePageRequest;
use App\Infrastructure\Models\Page;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $pages = Page::latest()->paginate(20); // paginate 20 per page
        return view('pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('pages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePageRequest $request): RedirectResponse
    {
        $data = $request->validated();
        Page::create($data);

        return redirect()->route('pages.index')->with('success', 'Page created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Page $page): View
    {
        return view('pages.show', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page): View
    {
        return view('pages.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePageRequest $request, Page $page): RedirectResponse
    {
        $data = $request->validated();
        $page->update($data);

        return redirect()->route('pages.index')->with('success', 'Page updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page): RedirectResponse
    {
        $page->delete();
        return redirect()->route('pages.index')->with('success', 'Page deleted successfully.');
    }
}
