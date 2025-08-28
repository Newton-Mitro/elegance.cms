<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMediaRequest;
use App\Http\Requests\UpdateMediaRequest;
use App\Infrastructure\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\ImageOptimizer\OptimizerChainFactory;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;

class MediaController extends Controller
{
    public function index(Request $request): Response
    {
        $perPage = $request->input('perPage', 20);
        $type = $request->input('type', 'all');

        $query = Media::query();

        if ($type !== 'all') {
            switch ($type) {
                case 'images':
                    $query->where('file_type', 'like', 'image/%');
                    break;
                case 'videos':
                    $query->where('file_type', 'like', 'video/%');
                    break;
                case 'audio':
                    $query->where('file_type', 'like', 'audio/%');
                    break;
                case 'pdf':
                    $query->where('file_type', 'application/pdf');
                    break;
                case 'docs':
                    $query->whereIn('file_type', [
                        'application/msword',
                        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                        'application/vnd.ms-excel',
                        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                        'application/vnd.ms-powerpoint',
                        'application/vnd.openxmlformats-officedocument.presentationml.presentation',
                    ]);
                    break;
                case 'archives':
                    $query->whereIn('file_type', [
                        'application/zip',
                        'application/x-rar-compressed',
                        'application/x-7z-compressed',
                    ]);
                    break;
            }
        }

        $mediaItems = $query->latest()->paginate($perPage)->withQueryString();

        return Inertia::render('media/index', [
            'mediaItems' => $mediaItems,
            'filters' => [
                'type' => $type,
            ],
        ]);
    }


    public function create(): Response
    {
        return Inertia::render('media/create');
    }

    public function store(StoreMediaRequest $request): RedirectResponse
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $mimeType = $file->getClientMimeType();
            $extension = $file->getClientOriginalExtension();
            $fileName = uniqid() . '.' . $extension;
            $filePath = 'uploads/' . $fileName;

            // Save the original file first
            Storage::disk('public')->putFileAs('uploads', $file, $fileName);

            // Optimize only if it's an image
            if (str_starts_with($mimeType, 'image/')) {
                $optimizerChain = OptimizerChainFactory::create();
                $optimizerChain->optimize(storage_path('app/public/' . $filePath));
            }

            // Alt text fallback
            $altText = $request->input('alt_text')
                ?? pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

            Media::create([
                'file_name' => $fileName,
                'file_path' => $filePath,
                'file_type' => $mimeType,
                'alt_text' => $altText,
                'uploaded_by' => Auth::id(),
            ]);

            return redirect()->back()->with('success', 'Media uploaded successfully.');
        }

        return redirect()->back()->with('error', 'No file uploaded.');
    }


    public function show(Media $medium): Response
    {
        return Inertia::render('media/show', [
            'media' => $medium,
        ]);
    }

    public function edit(Media $medium): Response
    {
        return Inertia::render('media/edit', [
            'media' => $medium,
        ]);
    }

    public function update(UpdateMediaRequest $request, Media $medium): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('file')) {
            // Delete old file
            Storage::disk('public')->delete(str_replace('storage/', '', $medium->file_path));

            $file = $request->file('file');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('uploads', $fileName, 'public');

            $medium->update([
                'file_name' => $fileName,
                'file_path' => 'storage/' . $filePath,
                'file_type' => $file->getClientMimeType(),
            ]);
        }

        if (isset($data['alt_text'])) {
            $medium->update(['alt_text' => $data['alt_text']]);
        }

        return redirect()->route('media.index')->with('success', 'Media updated successfully.');
    }

    public function destroy(Media $medium): RedirectResponse
    {
        if (!empty($medium->file_path)) {
            // normalize path (strip "storage/" if it exists in DB)
            $path = str_replace('storage/', '', $medium->file_path);

            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
        }

        $medium->delete();

        return redirect()->route('media.index')->with('success', 'Media deleted successfully.');
    }

}
