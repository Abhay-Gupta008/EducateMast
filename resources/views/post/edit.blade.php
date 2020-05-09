@extends('layouts.app')
@section('content')
    <div class="container mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card-header">Edit Post <form method="post" class="ml-0 mt-2" action="{{ route('posts.destroy', [$post->category->slug, $post->slug]) }}">@csrf @method("DELETE")<button class="btn btn-danger" type="submit">Delete this Post</button></form></div>
            </div>
            <div class="col-md-12">
                <div class="bg-light">
                    <div class="card-body">
                        <form method="post" action="{{ route('posts.update', [$post->category->slug, $post->slug]) }}">
                            @method('PATCH')
                            @include('post.extras.form')
                            <div class="form-group mb-0">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Edit Post') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
