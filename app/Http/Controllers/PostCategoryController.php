<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostCategoryRequest;
use App\Http\Requests\UpdatePostCategoryRequest;
use App\Infrastructure\Models\PostCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PostCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $postCategories = PostCategory::with(['post', 'category'])->paginate(20);
        return view('post_categories.index', compact('postCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('post_categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostCategoryRequest $request): RedirectResponse
    {
        $data = $request->validated();
        PostCategory::create($data);

        return redirect()->route('post_categories.index')
            ->with('success', 'Post category assigned successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(PostCategory $postCategory): View
    {
        return view('post_categories.show', compact('postCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PostCategory $postCategory): View
    {
        return view('post_categories.edit', compact('postCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostCategoryRequest $request, PostCategory $postCategory): RedirectResponse
    {
        $data = $request->validated();
        $postCategory->update($data);

        return redirect()->route('post_categories.index')
            ->with('success', 'Post category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PostCategory $postCategory): RedirectResponse
    {
        $postCategory->delete();

        return redirect()->route('post_categories.index')
            ->with('success', 'Post category removed successfully.');
    }
}
