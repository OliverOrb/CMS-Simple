<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\PageRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $pages = Page::paginate();

        return view('page.index', compact('pages'))
            ->with('i', ($request->input('page', 1) - 1) * $pages->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $page = new Page();

        return view('page.create', compact('page'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PageRequest $request): RedirectResponse
    {
        Page::create($request->validated());

        return Redirect::route('pages.index')
            ->with('success', 'Page created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $page = Page::find($id);

        return view('page.show', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $page = Page::find($id);

        return view('page.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PageRequest $request, Page $page): RedirectResponse
    {
        $page->update($request->validated());

        return Redirect::route('pages.index')
            ->with('success', 'Page updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Page::find($id)->delete();

        return Redirect::route('pages.index')
            ->with('success', 'Page deleted successfully');
    }
}
