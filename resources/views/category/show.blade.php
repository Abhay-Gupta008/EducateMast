@extends('layouts.app')
@section('content')
    <div>
        <div class="container">
            <h2>Category: {{ $category->name }}</h2>
            <h5>Slug: {{ $category->slug }}</h5>
            @can('update', $category)<h6><a href="{{ route('categories.edit', [$category->slug]) }}" class="text-dark">Edit Category</a></h6>@endcan
        </div>
    </div>
    <div class="pt-1 pb-2">
        <div class="container">
            <hr>
        </div>
    </div>
    <div>
        <div class="container">
            @if($posts->count() > 0)
                @foreach($posts as $post)
                    <div class="pb-3">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">{{ $post->title }}</h4>
                                <h6 class="text-muted card-subtitle mb-2">Author: <a class="text-dark" href="{{ route('profiles.show', [$post->author->username]) }}">{{ $post->author->username }}</a></h6>
                                <p class="card-text">{{ $post->excerpt }}</p>
                                <a class="card-link" href="{{ route('posts.show', [$post->category->slug, $post->slug]) }}">View Post</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <h4 class="d-flex justify-content-center font-weight-bold mb-4">No Posts Here</h4>
            @endif
            <div class="d-flex justify-content-center">{{ $posts->links() }}</div>
        </div>
    </div>
@endsection
