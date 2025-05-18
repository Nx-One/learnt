<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ForumPost;
use App\Models\ForumThread;
use App\Models\Course;
use App\Models\Unit;
use App\Models\SubUnit;

class ForumPostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, $thread_id)
    {
        // Validate and store the new post
        $request->validate([
            'body' => 'required|string',
        ]);

        $post = new ForumPost();
        $post->body = $request->body;
        $post->user_id = auth()->id();
        $post->thread_id = $thread_id;
        // Save the post
        $post->save();

        return redirect()->route('forum.thread.show', ['thread_id' => $thread_id])->with('success', 'Post created successfully.');
    }

    public function update(Request $request, $post_id)
    {
        // Validate and update the post
        $request->validate([
            'body' => 'required|string',
        ]);

        $post = ForumPost::findOrFail($post_id);
        $post->body = $request->body;
        // Save the updated post
        $post->save();

        return redirect()->back()->with('success', 'Post updated successfully.');
    }

    public function destroy($post_id)
    {
        // Delete the post
        ForumPost::destroy($post_id);

        return redirect()->back()->with('success', 'Post deleted successfully.');
    }
}
