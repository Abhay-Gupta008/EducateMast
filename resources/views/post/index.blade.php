@extends('layouts.app')
@section('description')Welcome to EducateMast | Check out all these blogs!@endsection
@section('content')
    @if($posts->currentPage() > 1)<h3 class="pb-2 pt-1">Page: {{ $posts->currentPage() }}</h3>@endif
    @foreach($posts as $post)
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{ $post->title }}</h4>
                <h6 class="text-muted card-subtitle mb-2">Author: <a class="text-dark" href="{{ route('profiles.show', [$post->author->username]) }}">{{ $post->author->username }}</a><span style="padding:4px 0 4px 10px;margin-left:10px;border-left:1px solid #ddd">Category: </span><a class="text-dark" href="{{ route('categories.show', [$post->category->slug]) }}">{{ $post->category->name }}</a></h6>
                <p class="card-text">{{ $post->excerpt }}</p>
                <a class="card-link" href="{{ route('posts.show', [$post->category->slug, $post->slug]) }}">View Post</a>
            </div>
        </div>
    @endforeach
    @if($posts->links() != '')<div class="pt-3 pb-2 d-flex justify-content-center">
        {{ $posts->links() }}
    </div>@endif
@endsection
