<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLikeRequest;
use App\Http\Requests\UpdateLikeRequest;
use App\Infrastructure\Models\Like;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $likes = Like::with(['post', 'user'])->paginate(20);
        return view('likes.index', compact('likes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('likes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLikeRequest $request): RedirectResponse
    {
        $data = $request->validated();

        // Avoid duplicate likes
        $like = Like::firstOrCreate([
            'post_id' => $data['post_id'],
            'user_id' => $data['user_id'],
        ]);

        return redirect()->back()->with('success', 'You liked the post!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Like $like): View
    {
        return view('likes.show', compact('like'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Like $like): View
    {
        return view('likes.edit', compact('like'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLikeRequest $request, Like $like): RedirectResponse
    {
        $data = $request->validated();
        $like->update($data);

        return redirect()->route('likes.index')->with('success', 'Like updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Like $like): RedirectResponse
    {
        $like->delete();

        return redirect()->back()->with('success', 'Like removed successfully.');
    }
}
