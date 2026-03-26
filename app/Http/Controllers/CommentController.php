<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'post_id' => 'required|exists:posts,id',
            'body' => 'required|string|max:1000',
        ]);

        $validated['user_id'] = auth()->id();

        Comment::create($validated);

        // back() simply returns the user to the Post page they were just on
        return back()->with('success', 'Comment posted successfully!');
    }

    public function destroy(Comment $comment)
    {
        // Security: Only the author OR an Admin/Editor can delete a comment
        if (auth()->id() !== $comment->user_id && !auth()->user()->hasAnyRole(['Admin', 'Editor'])) {
            abort(403, 'Unauthorized action.');
        }

        $comment->delete();

        return back()->with('success', 'Comment deleted!');
    }
}
