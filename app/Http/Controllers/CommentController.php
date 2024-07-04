<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $validated = $request->validate([
            'content' => 'required|string',
        ]);

        $comment = new Comment($validated);
        $comment->user_id = Auth::id();
        $post->comments()->save($comment);

        return redirect()->route('posts.show', $post)->with('success', 'Comment added successfully!');
    }

    public function edit(Post $post, Comment $comment)
    {
        // Ensure that only the comment owner can edit the comment
        if (Auth::id() !== $comment->user_id) {
            return redirect()->route('posts.show', $post)->with('error', 'You can only edit your own comments.');
        }

        return view('comments.edit', compact('post', 'comment'));
    }

    public function update(Request $request, Post $post, Comment $comment)
    {
        $validated = $request->validate([
            'content' => 'required|string',
        ]);

        // Ensure that only the comment owner can update the comment
        if (Auth::id() !== $comment->user_id) {
            return redirect()->route('posts.show', $post)->with('error', 'You can only update your own comments.');
        }

        $comment->update($validated);

        return redirect()->route('posts.show', $post)->with('success', 'Comment updated successfully!');
    }

    public function destroy(Post $post, Comment $comment)
    {
        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted successfully!');
    }
}