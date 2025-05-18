<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\User;
use App\Models\Role;
use App\Models\UserRole;
use App\Http\Middleware\InstructorMiddleware;


class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $articles = Article::all();
        return view('articles.index', compact('articles'));
    }

    public function create()
    {
        return view('articles.create');
    }

    public function show($id)
    {
        $article = Article::find($id);
        return view('articles.show', compact('article'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required',
                'content' => 'required',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        $file = $request->file('cover_image');
        $fileName = $file->hashName();

        $article = new Article();
        $article->title = $request->title;
        $article->content = $request->content;
        $article->user_id = auth()->user()->id;
        $article->path_image_title = $fileName;
        $article->save();

        $path = $file->store('images', 'public');
        return redirect()->route('articles.index')->with('success', 'Article upload successfully');
    }
}
