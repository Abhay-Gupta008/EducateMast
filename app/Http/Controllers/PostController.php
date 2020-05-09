<?php

namespace App\Http\Controllers;

use App\Events\PostCreated;
use App\Rules\Slug;
use Auth;
use App\Category;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
        $this->middleware('staff')->except('index', 'show');
        $this->middleware('admin')->only('destroyed', 'restore');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $latestPosts = Post::with('category')->latest()->paginate(2);
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

        $body = $this->format($validatedData['raw-body']);

        $post = Post::create([
            'title' => $validatedData['title'],
            'body' => $body,
            'raw_body' => $validatedData['raw-body'],
            'excerpt' => $validatedData['excerpt'],
            'slug' => $validatedData['slug'],
            'category_id' => $validatedData['category'],
            'author_id' => Auth::user()->id,
        ]);

        $postLink = route('posts.show', [$post->category->slug, $post->slug]);

        event(new PostCreated($postLink, $post));

        session()->flash('message', 'Post has been created');

        return response()->redirectTo($postLink);
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
     * @param Category $category
     * @param \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category, Post $post)
    {
        Gate::authorize('update', $post);
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
        Gate::authorize('update', $post);
        if ($request->slug == $post->slug) {
             $validatedData = $request->validate([
                'title' => ['required', 'min:3', 'max:255'],
                'raw-body' => ['required', 'min:10', 'max:5000'],
                'excerpt' => ['required', 'min:1', 'max:60'],
                'category' => ['required'],
            ]);

             $body = $this->format($validatedData['raw-body']);

             $post->update([
                 'title' => $validatedData['title'],
                 'body' => $body,
                 'raw_body' => $validatedData['raw-body'],
                 'category' => $validatedData['category'],
                 'excerpt' => $validatedData['excerpt'],
             ]);
        } else {
            $data = $this->validator($request);
            $body = $this->format($data['raw-body']);

            $post->update([
                'title' => $data['title'],
                'body' => $body,
                'raw_body' => $data['raw-body'],
                'slug' => $data['slug'],
                'category' => $data['category'],
                'excerpt' => $data['excerpt'],
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
            'raw-body' => ['required', 'min:10', 'max:5000'],
            'slug' => ['unique:posts', 'min:2', 'max:40', 'required', new Slug()],
            'excerpt' => ['min:1', 'max:50', 'string', 'required'],
            'category' => ['required'],
        ]);
    }

    private function format($type) {
        $url = '@\^\^(http)?(s)?(://)?(([a-zA-Z])([-\w]+\.)+([^\s\.]+[^\s]*)+)\^\^@';
        $return = preg_replace($url, '<a href="http$2://$4" target="_blank" title="$1$2$3$4">$1$2$3$4</a>', e($type));
        $bold = '@\*\*(.*)\*\*@';
        $return = preg_replace($bold, '<strong>$1</strong>', $return);
        $title = '@==(.*)==@';
        $return = preg_replace($title, '<h4>$1</h4>', $return);
        $italic = '@\*(.*)\*@';
        $return = preg_replace($italic, '<i>$1</i>', $return);
        $underline = '@\+\+(.*)\+\+@';
        $return = preg_replace($underline, '<u>$1</u>', $return);
        return $return;

    }
}
