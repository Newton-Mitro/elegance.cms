<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTestimonialRequest;
use App\Http\Requests\UpdateTestimonialRequest;
use App\Infrastructure\Models\Testimonial;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $testimonials = Testimonial::latest()->paginate(20);
        return view('testimonials.index', compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('testimonials.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTestimonialRequest $request): RedirectResponse
    {
        $data = $request->validated();
        Testimonial::create($data);

        return redirect()->route('testimonials.index')
            ->with('success', 'Testimonial created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Testimonial $testimonial): View
    {
        return view('testimonials.show', compact('testimonial'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Testimonial $testimonial): View
    {
        return view('testimonials.edit', compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTestimonialRequest $request, Testimonial $testimonial): RedirectResponse
    {
        $data = $request->validated();
        $testimonial->update($data);

        return redirect()->route('testimonials.index')
            ->with('success', 'Testimonial updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Testimonial $testimonial): RedirectResponse
    {
        $testimonial->delete();

        return redirect()->route('testimonials.index')
            ->with('success', 'Testimonial deleted successfully.');
    }
}
