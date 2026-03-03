<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use illuminate\View\View;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $comments = User::all();

        return view('comments.index', compact('comments'));
    }
}
