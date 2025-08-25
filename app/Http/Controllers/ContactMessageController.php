<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactMessageRequest;
use App\Http\Requests\UpdateContactMessageRequest;
use App\Infrastructure\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $messages = ContactMessage::orderBy('created_at', 'desc')->paginate(10);
        return view('contact_messages.index', compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('contact_messages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContactMessageRequest $request): RedirectResponse
    {
        $data = $request->validated();
        ContactMessage::create($data);

        return redirect()->route('contact_messages.index')
            ->with('success', 'Message sent successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ContactMessage $contactMessage): View
    {
        return view('contact_messages.show', compact('contactMessage'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ContactMessage $contactMessage): View
    {
        return view('contact_messages.edit', compact('contactMessage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContactMessageRequest $request, ContactMessage $contactMessage): RedirectResponse
    {
        $data = $request->validated();
        $contactMessage->update($data);

        return redirect()->route('contact_messages.index')
            ->with('success', 'Message updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ContactMessage $contactMessage): RedirectResponse
    {
        $contactMessage->delete();

        return redirect()->route('contact_messages.index')
            ->with('success', 'Message deleted successfully.');
    }
}
