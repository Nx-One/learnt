<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ForumThread;
use App\Models\ForumPost;
use App\Models\Course;
use App\Models\Unit;
use App\Models\SubUnit;

class ForumThreadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index($course_id, $unit_id)
    {
        // Fetch threads related to the course and unit
        $threads = ForumThread::where('course_id', $course_id)->where('unit_id', $unit_id)->with('user.roles')->with('post')->paginate(5);
        $course = Course::findOrFail($course_id);
        return view('forum.index', compact('threads', 'course', 'unit_id'));
    }

    public function create()
    {
        // Show the form to create a new thread
        return view('forum.create');
    }

    public function store(Request $request, $course_id, $unit_id)
    {
        // Validate and store the new thread
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $thread = new ForumThread();
        $thread->title = $request->title;
        $thread->body = $request->body;
        $thread->user_id = auth()->id();
        $thread->course_id = $course_id;
        $thread->unit_id = $unit_id;
        // Save the thread
        $thread->save();

        return redirect()->route('forum.thread.index', ['course_id' => $course_id, 'unit_id' => $unit_id])->with('success', 'Thread created successfully.');
    }

    public function show($id)
    {
        // Show a specific thread
        $thread = ForumThread::with('unit')->with('user')->with('post.user')->findOrFail($id);
        $course = Course::findOrFail($thread->course_id);
        $unit_id = $thread->unit->id;
        return view('forum.show', compact('thread', 'course', 'unit_id'));
    }

    public function edit($id)
    {
        // Show the form to edit a thread
        $thread = ForumThread::findOrFail($id);
        return view('forum.edit', compact('thread'));
    }

    public function update(Request $request, $id)
    {
        // Validate and update the thread
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $thread = ForumThread::findOrFail($id);
        $thread->title = $request->title;
        $thread->content = $request->content;
        $thread->save();

        return redirect()->route('forum.index')->with('success', 'Thread updated successfully.');
    }

    public function destroy($id)
    {
        // Delete a thread
        $thread = ForumThread::findOrFail($id);
        $thread->delete();

        return redirect()->route('forum.index')->with('success', 'Thread deleted successfully.');
    }
}
