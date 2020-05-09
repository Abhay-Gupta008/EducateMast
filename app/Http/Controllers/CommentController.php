<?php

namespace App\Http\Controllers;

use App\Category;
use App\Comment;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Post $post
     * @return void
     */
    public function store(Request $request, Category $category, Post $post)
    {
        $request->validate([
           'raw-body' => ['required', 'string', 'min:3', 'max:500']
        ]);


        $comment = Comment::create([
            'body' => $this->format($request['raw-body']),
            'raw_body' => $request['raw-body'],
            'user_id' => Auth::user()->id,
            'post_id' => $post->id
        ]);

        $linkTo = route('posts.show', [$comment->post->category->slug, $comment->post->slug]).'#'.$comment->id;

        return redirect($linkTo)->with('message', 'Comment has been posted');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
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
