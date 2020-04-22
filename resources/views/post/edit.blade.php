@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card-header">Edit Post</div>
            </div>
            <div class="col-md-12">
                <div class="bg-white">
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
