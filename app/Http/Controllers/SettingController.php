<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSettingRequest;
use App\Http\Requests\UpdateSettingRequest;
use App\Infrastructure\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $settings = Setting::latest()->paginate(20);
        return view('settings.index', compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('settings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSettingRequest $request): RedirectResponse
    {
        $data = $request->validated();

        Setting::create($data);

        return redirect()->route('settings.index')
            ->with('success', 'Setting created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Setting $setting): View
    {
        return view('settings.show', compact('setting'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $setting): View
    {
        return view('settings.edit', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSettingRequest $request, Setting $setting): RedirectResponse
    {
        $data = $request->validated();

        $setting->update($data);

        return redirect()->route('settings.index')
            ->with('success', 'Setting updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting): RedirectResponse
    {
        $setting->delete();

        return redirect()->route('settings.index')
            ->with('success', 'Setting deleted successfully.');
    }
}
