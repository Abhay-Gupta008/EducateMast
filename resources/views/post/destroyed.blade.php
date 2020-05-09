@extends('layouts.app')
@section('content')
    <div class="container mb-5">
        <div class="row">
            <div class="col-md-12"><h3 class="font-weight-bolder text-center">Destroyed Posts</h3></div>
            <div class="col-md-12"><hr/></div>
            @if($destroyedPosts->count() == 0)
                <div class="col-md-12"><h3 class="text-center">Nothing to restore!</h3></div>
            @endif
            @foreach($destroyedPosts as $post)
                <div class="col-md-12">
                    <div class="card-header">{{ $post->title }}</div>
                </div>
                <div class="col-md-12 mb-3">
                    <div class="bg-light">
                        <div class="card-body">
                            {{ $post->excerpt }} <form class="mt-2" method="post" action="{{ route('posts.restore', [$post->id]) }}">@csrf <button class="btn btn-primary" type="submit">Restore Post</button> </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
