<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePageRequest;
use App\Http\Requests\UpdatePageRequest;
use App\Infrastructure\Models\Page;
use App\Infrastructure\Models\Media;
use App\Infrastructure\Models\PageSection;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $pages = Page::latest()->paginate(20);

        return Inertia::render('pages/index', [
            'pages' => $pages
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): Response
    {
        $perPage = $request->input('perPage', 10);
        $media = Media::latest()->paginate($perPage)->withQueryString();

        return Inertia::render('pages/Create', [
            'media' => $media
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePageRequest $request): RedirectResponse
    {
        $data = $request->validated();
        Page::create($data);

        return redirect()->route('pages.index')
            ->with('success', 'Page created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Page $page): Response
    {
        $sections = PageSection::with('media')
            ->where('page_id', $page->id)
            ->orderBy('sort_order', 'asc')
            ->get();

        return Inertia::render('pages/show', [
            'page' => $page,
            'sections' => $sections,
        ]);
    }

    public function edit(Page $page, Request $request): Response
    {
        $perPage = $request->input('perPage', 10);
        $media = Media::latest()->paginate($perPage)->withQueryString();
        $sections = PageSection::with('media')
            ->where('page_id', $page->id)
            ->orderBy('sort_order', 'asc')
            ->get();

        return Inertia::render('pages/edit', [
            'page' => $page,
            'sections' => $sections,
            'media' => $media
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePageRequest $request, Page $page): RedirectResponse
    {
        $data = $request->validated();
        $page->update($data);

        return redirect()->route('pages.index')
            ->with('success', 'Page updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page): RedirectResponse
    {
        $page->delete();

        return redirect()->route('pages.index')
            ->with('success', 'Page deleted successfully.');
    }
}
