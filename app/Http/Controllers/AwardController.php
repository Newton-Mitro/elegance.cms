<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAwardRequest;
use App\Http\Requests\UpdateAwardRequest;
use App\Infrastructure\Models\Award;
use App\Infrastructure\Models\Media;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;

class AwardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $awards = Award::with('image')->orderByDesc('year')->paginate(10);

        return Inertia::render('award/index', [
            'awards' => $awards
        ]);
    }

    public function publicIndex(): Response
    {
        $awards = Award::with('image')->orderByDesc('year')->paginate(10);

        return Inertia::render('award/public_index', [
            'awards' => $awards
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): Response
    {
        $perPage = $request->input('perPage', 10);
        $media = Media::query()
            ->latest()
            ->paginate($perPage)
            ->withQueryString();

        return Inertia::render('award/create', [
            'media' => $media
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAwardRequest $request): RedirectResponse
    {
        $data = $request->validated();
        Award::create($data);

        return redirect()->route('awards.index')
            ->with('success', 'Award created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Award $award): Response
    {
        return Inertia::render('award/show', [
            'award' => $award->load('image')
        ]);
    }

    public function publicShow(Award $award): Response
    {
        return Inertia::render('award/public_show', [
            'award' => $award->load('image')
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Award $award, Request $request): Response
    {
        $perPage = $request->input('perPage', 10);
        $media = Media::query()
            ->latest()
            ->paginate($perPage)
            ->withQueryString();

        return Inertia::render('award/edit', [
            'award' => $award->load('image'),
            'media' => $media
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAwardRequest $request, Award $award): RedirectResponse
    {
        $data = $request->validated();
        $award->update($data);

        return redirect()->route('awards.index')
            ->with('success', 'Award updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Award $award): RedirectResponse
    {
        $award->delete();

        return redirect()->route('awards.index')
            ->with('success', 'Award deleted successfully.');
    }
}
