@extends('layouts.app')
@section('description')Check out this post on {{ env('APP_NAME') }} | {{ $post->title }}@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card-header d-flex">
                    <div class="col-md-12"> {{ $post->title }} | Authored by: <a class="text-dark" href="{{ route('profiles.show', [$post->author->username]) }}">{{ $post->author->username }}</a> | Category: <a class="text-dark" href="{{ route('categories.show', $post->category->slug) }}">{{ $post->category->name }}</a>@can('update', $post) | <a class="text-dark" href="{{ route('posts.edit', [$post->category->slug, $post->slug]) }}">Edit Post</a>@endcan</div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="bg-white">
                    <div class="card-body">
                        <div class="col-md-12"><strong>Created At: {{ $post->created_at->format('g:i A, d M, Y') }} | Edited at: {{ $post->updated_at->format('g:i A, d M, Y') }}</strong></div>
                        <div class="col-md-12"><hr /></div>
                        <pre><div class="col-md-12" style="font-family: Nunito, sans-serif; font-size:1rem;"><?php echo preg_replace($url, '<a href="http$2://$4" target="_blank" title="$0">$0</a>', e($post->body)); ?></div></pre>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
