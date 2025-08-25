<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNoticeRequest;
use App\Http\Requests\UpdateNoticeRequest;
use App\Infrastructure\Models\Notice;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class NoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $notices = Notice::latest()->paginate(20);
        return view('notices.index', compact('notices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('notices.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNoticeRequest $request): RedirectResponse
    {
        $data = $request->validated();
        Notice::create($data);

        return redirect()->route('notices.index')->with('success', 'Notice created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Notice $notice): View
    {
        return view('notices.show', compact('notice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Notice $notice): View
    {
        return view('notices.edit', compact('notice'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNoticeRequest $request, Notice $notice): RedirectResponse
    {
        $data = $request->validated();
        $notice->update($data);

        return redirect()->route('notices.index')->with('success', 'Notice updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notice $notice): RedirectResponse
    {
        $notice->delete();
        return redirect()->route('notices.index')->with('success', 'Notice deleted successfully.');
    }
}
