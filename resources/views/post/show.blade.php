@extends('layouts.app')
@section('content')
    <body>
    <div class="article-clean">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-xl-8 offset-lg-1 offset-xl-2">
                    <div class="intro">
                        <h1 class="text-center">{{ $post->title }}</h1>
                        <p class="text-center"><span class="by">by</span> <a href="{{ route('profiles.show', [$post->author->username]) }}">{{ $post->author->username }}</a><span class="by date">Category: </span> <a href="{{ route('categories.show', [$post->category->slug]) }}">{{ $post->category->name }}</a><span class="date">{{ $post->created_at->format('d F, Y') }}</span>@can('update', $post)<span class="date"><a class="text-dark" href="{{ route('posts.edit', [$post->category->slug, $post->slug]) }}">Edit Post</a></span>@endcan</p></div>
                    <div class="text">
                        <pre><div style="font-family: sans-serif; font-size:1rem;">{!! $post->body !!}</div></pre>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @auth
        <div>
            <div class="container">
                <hr>
            </div>
        </div>
        <div class="pt-3">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <form action="{{ route('comments.create', [$post->category->slug, $post->slug]) }}" method="post">
                            @csrf
                            <div class="form-group">
                                <h1>Comment</h1>
                                <textarea style="resize: none;" rows="5" class="form-control col-md-12 @error('raw-body') is-invalid @enderror" name="raw-body"></textarea>
                                @error('raw-body')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group"><button class="btn btn-primary" type="submit">Post</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div>
            <div class="container pb-2">
                <hr>
            </div>
        </div>
        <h5 class="container pt-2">Please login to comment.</h5>
    @endauth
    @if($post->comments->count() > 0)
        <div class="pb-2">
            <div class="container pt-2 pb-2">
                <hr>
            </div>
        </div>
        <div class="container">
            <div class="pb-2">
                <h1>Comments</h1>
            </div>
            @foreach($post->comments()->latest()->get() as $comment)
                <div class="pb-3">
                    <div class="card">
                        <div class="card-body">
                            <a id="{{ $comment->id }}"><h4 class="card-title"><img class="mr-2 rounded-circle" height="50" width="50" src="{{ asset($comment->user->profile->profile_image()) }}"><a class="text-dark" href="{{ route('profiles.show', [$comment->user->username]) }}">{{ $comment->user->username }}</a></h4><h4 style="margin-left: 0 !important;">{!! $comment->user->badges() !!}</h4></a>
                            <p class="card-text"><pre><div style="font-family: sans-serif; font-size:1rem;">{!! $comment->body !!}</div></pre></p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="pt-2">
            <div class="container pb-2">
                <hr>
            </div>
        </div>
        <h5 class="pb-3 container">No comments.</h5>
    @endif
@endsection
