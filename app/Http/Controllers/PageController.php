<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\PageRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Add `with('user')` so it grabs the author info all at once!
        $pages = Page::with('user')->latest()->paginate(10);

        // This is necessary to make your `{{ ++$i }}` logic work in the blade file
        $i = (request()->input('page', 1) - 1) * 10;

        return view('page.index', compact('pages', 'i'))
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
    public function store(Request $request)
    {
        // 1. Validate what the user actually typed in the form
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        // 2. The User ID: Assign the currently logged-in user
        $validated['user_id'] = auth()->id();

        // 3. The Slug: Generate it automatically from the title they typed
        $validated['slug'] = Str::slug($validated['title']);

        // 4. Save to database (The ID is generated automatically here!)
        Page::create($validated);

        return redirect()->route('pages.index')
            ->with('success', 'Page created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Page $page)
    {
        return view('page.show', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page)
    {
        Gate::authorize('update', $page);

        return view('page.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Page $page) // <-- Change PostRequest to Request here
    {
        // 1. Check if they are allowed to edit
        Gate::authorize('update', $page);

        // 2. Validate the incoming data exactly like you did in the store() method
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        // 3. Re-generate the slug in case they changed the title!
        $validated['slug'] = Str::slug($validated['title']);

        // 4. Update the database
        $page->update($validated);

        return Redirect::route('pages.index')
            ->with('success', 'Page updated successfully');
    }

    public function destroy(Page $page)
    {
        Gate::authorize('delete', $page);

        $page->delete();

        return Redirect::route('pages.index')
            ->with('success', 'Page deleted successfully');
    }
}
