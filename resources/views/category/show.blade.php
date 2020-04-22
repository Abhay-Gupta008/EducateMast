@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="text-center col-md-12">
                <h2 class="font-weight-bolder">Category: {{ $category->name }}</h2>
            </div>
            <div class="text-center col-md-12">
                <h5 class="font-weight-bold">Slug: {{ $category->slug }}</h5>
            </div>
            <div class="col-md-12 mb-2">
                <hr/>
            </div>
                @foreach($posts as $post)
                <div class="col-md-12">
                        <div class="bg-white mb-3">
                            <div class="card-header"><a class="text-dark" href="{{ route('posts.show', [$category->slug, $post->slug]) }}">{{ $post->title }}</a></div>
                            <div class="card-body">{{ $post->body }}</div>
                        </div>
                    </div>
                @endforeach
                    @if($posts->count() == 0)
                    <div class="col-md-12">
                        <h3 class="text-center">Nothing to see here!</h3>
                    </div>
                    @endif
            <div class="col-md-12 d-flex justify-content-center">{{ $posts->links() }}</div>
        </div>
    </div>
@endsection
