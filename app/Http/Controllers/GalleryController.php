<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGalleryRequest;
use App\Http\Requests\UpdateGalleryRequest;
use App\Infrastructure\Models\Gallery;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $galleries = Gallery::orderBy('created_at', 'desc')->paginate(10);
        return view('galleries.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('galleries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGalleryRequest $request): RedirectResponse
    {
        $data = $request->validated();
        Gallery::create($data);

        return redirect()->route('galleries.index')
            ->with('success', 'Gallery created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Gallery $gallery): View
    {
        return view('galleries.show', compact('gallery'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery): View
    {
        return view('galleries.edit', compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGalleryRequest $request, Gallery $gallery): RedirectResponse
    {
        $data = $request->validated();
        $gallery->update($data);

        return redirect()->route('galleries.index')
            ->with('success', 'Gallery updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery): RedirectResponse
    {
        $gallery->delete();

        return redirect()->route('galleries.index')
            ->with('success', 'Gallery deleted successfully.');
    }
}
