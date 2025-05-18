<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Course;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
   public function index()
    {
        $articles = Article::take(3)->get();
        $courses = Course::all();
        $user = auth()->user();

        // Determine whether to show the modal based on user's modal state
        $showModal = !$user->is_modal_closed;

        return view('home', compact('articles', 'courses', 'user', 'showModal'));
    }

    public function closeModal(Request $request)
    {
        $user = auth()->user();
        $user->is_modal_closed = true;
        $user->save();

        return response()->json(['success' => true]);
    }

    public function about()
    {
        return view('about');
    }
}
