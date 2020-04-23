@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card-header">
                    {{ $post->title }} | Authored by: <a class="text-dark" href="{{ route('profiles.show', [$post->author->username]) }}">{{ $post->author->username }}</a> | Category: <a class="text-dark" href="{{ route('categories.show', $post->category->slug) }}">{{ $post->category->name }}</a>@can('update', $post) | <a class="text-dark" href="{{ route('posts.edit', [$post->category->slug, $post->slug]) }}">Edit Post</a>@endcan
                </div>
            </div>
            <div class="col-md-12">
                <div class="bg-white">
                    <div class="card-body">
                        {!! preg_replace($url, '<a href="http$2://$4" target="_blank" title="$0">$0</a>', $post->body) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
