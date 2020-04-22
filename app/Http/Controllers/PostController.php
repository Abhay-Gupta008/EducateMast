<?php

namespace App\Http\Controllers;

use Auth;
use App\Category;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
        $this->middleware('staff')->except('index', 'show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $latestPosts = Post::with('category')->orderBy('created_at', 'desc')->paginate(2);
        $posts = Post::orderBy('created_at', 'desc')->with('category')->paginate(5);
        return response()->view('post.index', compact('latestPosts', 'posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post = new Post();

        $categories = Category::all();

        return response()->view('post.create', compact('post', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $this->validator($request);
        $excerpt = substr($validatedData['body'], 0, 30).'...';
        $post = Post::create([
            'title' => $validatedData['title'],
            'body' => $validatedData['body'],
            'excerpt' => $excerpt,
            'slug' => $validatedData['slug'],
            'category_id' => $validatedData['category'],
            'author_id' => Auth::user()->id,
        ]);

        session()->flash('message', 'Post has been created');

        return response()->redirectTo(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @param \App\Post $post
     *
     */
    public function show(Category $category, Post $post)
    {
        return response()->view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }

    private function validator(Request $request) {
        return $request->validate([
            'title' => ['required', 'min:3', 'max:255'],
            'body' => ['required', 'min:10', 'max:500'],
            'slug' => ['unique:posts', 'min:2', 'max:40'],
            'category' => ['required'],
        ]);
    }
}
