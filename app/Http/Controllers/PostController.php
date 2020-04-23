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
        $this->middleware('admin')->only('edit', 'update', 'destroyed', 'restore');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $url = '@(http)?(s)?(://)?(([a-zA-Z])([-\w]+\.)+([^\s\.]+[^\s]*)+[^,.\s])@';
        $latestPosts = Post::with('category')->orderBy('created_at', 'desc')->paginate(2);
        $posts = Post::orderBy('created_at', 'desc')->with('category')->paginate(5);
        return response()->view('post.index', compact('latestPosts', 'posts', 'url'));
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
        $url = '@(http)?(s)?(://)?(([a-zA-Z])([-\w]+\.)+([^\s\.]+[^\s]*)+[^,.\s])@';
        return response()->view('post.show', compact('post', 'url'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @param \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category, Post $post)
    {
        $categories = Category::all();

        return response()->view('post.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Category $category
     * @param \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category, Post $post)
    {
        if ($request->slug == $post->slug) {
             $validatedData = $request->validate([
                'title' => ['required', 'min:3', 'max:255'],
                'body' => ['required', 'min:10', 'max:1200'],
                'category' => ['required'],
            ]);

            $excerpt = substr($validatedData['body'], 0, 30).'...';

             $post->update([
                 'title' => $validatedData['title'],
                 'body' => $validatedData['body'],
                 'category' => $validatedData['category'],
                 'excerpt' => $excerpt,
             ]);
        } else {
            $data = $this->validator($request);
            $excerpt = substr($data['body'], 0, 30).'...';
            $post->update([
                'title' => $data['title'],
                'body' => $data['body'],
                'slug' => $data['slug'],
                'category' => $data['category'],
                'excerpt' => $excerpt,
            ]);
        }

        $post->save();

        session()->flash('message', 'The post has been edited successfully');

        return response()->redirectTo(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @param \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category, Post $post)
    {
        $post->delete();
        session()->flash('message', 'The post has been deleted');

        return response()->redirectTo(route('posts.index'));
    }

    /**
     * Display the listing of destroyed posts.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroyed() {
        $destroyedPosts = Post::onlyTrashed()->paginate(5);
        return response()->view('post.destroyed', compact('destroyedPosts'));
    }

    /**
     * Restore the specified resource in storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function restore(int $id) {
        $post = Post::onlyTrashed()->findOrFail($id);
        $post->restore();
        session()->flash('message', 'The post has been restored');

        return response()->redirectTo(route('posts.index'));
    }

    private function validator(Request $request) {
        return $request->validate([
            'title' => ['required', 'min:3', 'max:255'],
            'body' => ['required', 'min:10', 'max:1200'],
            'slug' => ['unique:posts', 'min:2', 'max:40'],
            'category' => ['required'],
        ]);
    }
}
