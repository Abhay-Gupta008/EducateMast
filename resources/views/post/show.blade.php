@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card-header">
                    {{ $post->title }} | Authored by: {{ $post->author->username }} | Category: <a class="text-dark" href="{{ route('categories.show', $post->category->slug) }}">{{ $post->category->name }}</a>
                </div>
            </div>
            <div class="col-md-12">
                <div class="bg-white">
                    <div class="card-body">
                        {{ $post->body }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
