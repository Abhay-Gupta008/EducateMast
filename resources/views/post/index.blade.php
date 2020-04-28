@extends('layouts.app')
@section('description')Welcome to EducateMast | Check out all these blogs!@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="justify-content-lg-start col-md-4">
                <h3 class="text-dark">{{ config('app.name') }}</h3>
                <hr />
                <h5 class="text-dark">Latest Posts</h5>
                @foreach($latestPosts as $latestPost)
                    <div class="mb-3 bg-white">
                        <div class="card-header"><pre><div style="font-family: Nunito, sans-serif; font-size:0.9rem;"><a class="text-dark" href="{{ route('posts.show', [$latestPost->category->slug, $latestPost->slug]) }}">{{ $latestPost->title }}</a></div></pre></div>

                        <div class="card-body">
                            <pre><div class="col-md-12" style="font-family: Nunito; font-size:15px"><?php echo preg_replace($url, '<a href="http$2://$4" target="_blank" title="$0">$0</a>', e($latestPost->excerpt)); ?></div></pre>
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
                            <pre><div class="col-md-12" style="font-family: Nunito, sans-serif; font-size:1rem;"><?php echo preg_replace($url, '<a href="http$2://$4" target="_blank" title="$0">$0</a>', e($post->excerpt)); ?></div></pre>
                        </div>
                    </div>
                @endforeach
                <div class="col-md-12 d-flex justify-content-center">{{ $posts->links() }}</div>
            </div>
        </div>
    </div>
@endsection
