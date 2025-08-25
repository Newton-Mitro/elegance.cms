<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCareerRequest;
use App\Http\Requests\UpdateCareerRequest;
use App\Infrastructure\Models\Career;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CareerController extends Controller
{
    public function index(): View
    {
        $careers = Career::orderByDesc('deadline')->paginate(10);
        return view('careers.index', compact('careers'));
    }

    public function create(): View
    {
        return view('careers.create');
    }

    public function store(StoreCareerRequest $request): RedirectResponse
    {
        $data = $request->validated();

        Career::create($data);

        return redirect()->route('careers.index')
            ->with('success', 'Career created successfully.');
    }

    public function show(Career $career): View
    {
        return view('careers.show', compact('career'));
    }

    public function edit(Career $career): View
    {
        return view('careers.edit', compact('career'));
    }

    public function update(UpdateCareerRequest $request, Career $career): RedirectResponse
    {
        $data = $request->validated();
        $career->update($data);

        return redirect()->route('careers.index')
            ->with('success', 'Career updated successfully.');
    }

    public function destroy(Career $career): RedirectResponse
    {
        $career->delete();

        return redirect()->route('careers.index')
            ->with('success', 'Career deleted successfully.');
    }
}
