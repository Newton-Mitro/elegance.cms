<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMediaRequest;
use App\Http\Requests\UpdateMediaRequest;
use App\Infrastructure\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $mediaItems = Media::latest()->paginate(20);
        return view('media.index', compact('mediaItems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('media.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMediaRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('uploads', $fileName, 'public');

            $media = Media::create([
                'file_name' => $fileName,
                'file_path' => 'storage/' . $filePath,
                'file_type' => $file->getClientMimeType(),
                'alt_text' => $data['alt_text'] ?? null,
                'uploaded_by' => Auth::id(),
            ]);

            return redirect()->route('media.index')->with('success', 'Media uploaded successfully.');
        }

        return redirect()->back()->with('error', 'No file uploaded.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Media $media): View
    {
        return view('media.show', compact('media'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Media $media): View
    {
        return view('media.edit', compact('media'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMediaRequest $request, Media $media): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('file')) {
            // Delete old file
            Storage::disk('public')->delete(str_replace('storage/', '', $media->file_path));

            $file = $request->file('file');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('uploads', $fileName, 'public');

            $media->update([
                'file_name' => $fileName,
                'file_path' => 'storage/' . $filePath,
                'file_type' => $file->getClientMimeType(),
            ]);
        }

        if (isset($data['alt_text'])) {
            $media->update(['alt_text' => $data['alt_text']]);
        }

        return redirect()->route('media.index')->with('success', 'Media updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Media $media): RedirectResponse
    {
        Storage::disk('public')->delete(str_replace('storage/', '', $media->file_path));
        $media->delete();

        return redirect()->route('media.index')->with('success', 'Media deleted successfully.');
    }
}
