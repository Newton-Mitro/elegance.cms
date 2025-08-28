<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePageSectionRequest;
use App\Http\Requests\UpdatePageSectionRequest;
use App\Infrastructure\Models\PageSection;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PageSectionController extends Controller
{

    public function store(StorePageSectionRequest $request): RedirectResponse
    {
        $data = $request->validated();

        PageSection::create($data);

        return redirect()->back()
            ->with('success', 'Page section created successfully.');
    }


    public function update(UpdatePageSectionRequest $request, PageSection $pageSection): RedirectResponse
    {
        $data = $request->validated();
        $pageSection->update($data);

        return redirect()->back()
            ->with('success', 'Page section updated successfully.');
    }

    public function destroy(PageSection $pageSection): RedirectResponse
    {
        $pageSection->delete();

        return redirect()->back()
            ->with('success', 'Page section deleted successfully.');
    }
}
