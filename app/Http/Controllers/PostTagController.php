<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostTagRequest;
use App\Http\Requests\UpdatePostTagRequest;
use App\Infrastructure\Models\PostTag;
use App\Infrastructure\Models\Post;
use App\Infrastructure\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PostTagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $postTags = PostTag::with(['post', 'tag'])->paginate(15);
        return view('post_tags.index', compact('postTags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $posts = Post::pluck('title', 'id');
        $tags = Tag::pluck('name', 'id');

        return view('post_tags.create', compact('posts', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostTagRequest $request): RedirectResponse
    {
        $data = $request->validated();
        PostTag::create($data);

        return redirect()->route('post_tags.index')
            ->with('success', 'Post-Tag association created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(PostTag $postTag): View
    {
        return view('post_tags.show', compact('postTag'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PostTag $postTag): View
    {
        $posts = Post::pluck('title', 'id');
        $tags = Tag::pluck('name', 'id');

        return view('post_tags.edit', compact('postTag', 'posts', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostTagRequest $request, PostTag $postTag): RedirectResponse
    {
        $data = $request->validated();
        $postTag->update($data);

        return redirect()->route('post_tags.index')
            ->with('success', 'Post-Tag association updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PostTag $postTag): RedirectResponse
    {
        $postTag->delete();

        return redirect()->route('post_tags.index')
            ->with('success', 'Post-Tag association deleted successfully.');
    }
}
