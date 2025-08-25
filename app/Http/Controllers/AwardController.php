<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAwardRequest;
use App\Http\Requests\UpdateAwardRequest;
use App\Infrastructure\Models\Award;
use App\Infrastructure\Models\Media;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AwardController extends Controller
{
    public function index(): View
    {
        $awards = Award::with('image')->orderByDesc('year')->paginate(10);
        return view('awards.index', compact('awards'));
    }

    public function create(): View
    {
        $media = Media::all();
        return view('awards.create', compact('media'));
    }

    public function store(StoreAwardRequest $request): RedirectResponse
    {
        $data = $request->validated();

        // If you have image_media_id selected
        $award = Award::create($data);

        return redirect()->route('awards.index')
            ->with('success', 'Award created successfully.');
    }

    public function show(Award $award): View
    {
        return view('awards.show', compact('award'));
    }

    public function edit(Award $award): View
    {
        $media = Media::all();
        return view('awards.edit', compact('award', 'media'));
    }

    public function update(UpdateAwardRequest $request, Award $award): RedirectResponse
    {
        $data = $request->validated();
        $award->update($data);

        return redirect()->route('awards.index')
            ->with('success', 'Award updated successfully.');
    }

    public function destroy(Award $award): RedirectResponse
    {
        $award->delete();

        return redirect()->route('awards.index')
            ->with('success', 'Award deleted successfully.');
    }
}
