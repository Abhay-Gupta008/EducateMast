@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="justify-content-lg-start col-md-4">
                <h3 class="text-dark">{{ config('app.name') }}</h3>
                <hr />
                <h5 class="text-dark">Latest Posts</h5>
                @foreach($latestPosts as $latestPost)
                    <div class="mb-3 bg-white">
                        <div class="card-header"><a class="text-dark" href="/{{ $latestPost->category->slug }}/{{ $latestPost->slug }}">{{ $latestPost->title }}</a></div>

                        <div class="card-body">
                            {{ $latestPost->excerpt }}
                        </div>
                    </div>
                @endforeach
                <hr />
                <div>&copy; Copyright {{ env('APP_START') }}-{{ now()->year }} {{ config('app.name') }} and/or all child companies ("Herizon Web" and "Sahaj Website"). Version: {{ env('APP_VERSION') }}</div>
            </div>
            <div class="col-md-8 justify-content-lg-end">
                @foreach($posts as $post)
                    <div class="mb-3 bg-white">
                        <div class="card-header"><a class="text-dark" href="{{ route('posts.show', [$post->category->slug, $post->slug]) }}">{{ $post->title }}</a></div>

                        <div class="card-body">
                            {{ $post->excerpt }}
                        </div>
                    </div>
                @endforeach
                <div class="col-md-12 d-flex justify-content-center">{{ $posts->links() }}</div>
            </div>
        </div>
    </div>
@endsection
