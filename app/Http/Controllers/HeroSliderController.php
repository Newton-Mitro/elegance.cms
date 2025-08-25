<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHeroSliderRequest;
use App\Http\Requests\UpdateHeroSliderRequest;
use App\Infrastructure\Models\HeroSlider;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class HeroSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $sliders = HeroSlider::orderBy('sort_order', 'asc')->paginate(10);
        return view('hero_sliders.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('hero_sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHeroSliderRequest $request): RedirectResponse
    {
        $data = $request->validated();
        HeroSlider::create($data);

        return redirect()->route('hero-sliders.index')
            ->with('success', 'Hero slider created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(HeroSlider $heroSlider): View
    {
        return view('hero_sliders.show', compact('heroSlider'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HeroSlider $heroSlider): View
    {
        return view('hero_sliders.edit', compact('heroSlider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHeroSliderRequest $request, HeroSlider $heroSlider): RedirectResponse
    {
        $data = $request->validated();
        $heroSlider->update($data);

        return redirect()->route('hero-sliders.index')
            ->with('success', 'Hero slider updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HeroSlider $heroSlider): RedirectResponse
    {
        $heroSlider->delete();

        return redirect()->route('hero-sliders.index')
            ->with('success', 'Hero slider deleted successfully.');
    }
}
