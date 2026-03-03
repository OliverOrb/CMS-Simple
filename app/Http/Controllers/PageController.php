<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use illuminate\View\View;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $pages = User::all();

        return view('pages.index', compact('pages'));
    }
    public function create(): View
    {
        return view('pages.create');
    }
}
