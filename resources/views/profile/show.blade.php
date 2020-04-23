@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-1 ml-2">
                @if($profile->image)<img class="rounded-circle" src="{{ asset('storage/'.$profile->image) }}">@endif
            </div>
            <div class="col-md-5 pb-2 mt-2">
                <div class="d-flex justify-content-center"><h3>{{ $profile->user->name }}</h3>@can('update', $profile)<h6 class="mt-2 ml-2"><a class="text-dark" href="{{ route('profiles.edit', $profile->user->username) }}">Edit Profile</a></h6>@endcan</div><div class="font-weight-bolder d-flex justify-content-center">{{ $profile->user->username }}</div>
            </div>
            <div class="col-md-5 pb-2 mt-2">
                <div class="d-flex justify-content-center">
                    @if($profile->user->canPost())<div class="font-weight-bold mr-3">Posts: {{ $profile->user->posts->count() }}</div>@endif
                    <div class="font-weight-bold">Joined on: {{ $profile->user->created_at->format('jS F, Y') }}</div>
                </div>
                <div class="d-flex justify-content-center">{{ $profile->bio }}</div>
            </div>
            <div class="col-md-12"><hr/></div>
            <div class="col-md-12">
                @if(! $profile->user->canPost())
                    <h3 class="text-center">This user can't create posts</h3>
                @endif
                @if($profile->user->canPost())
                        @foreach($profile->user->posts as $post)
                            <div class="mb-3 bg-white">
                                <div class="card-header"><a class="text-dark" href="{{ route('posts.show', [$post->category->slug, $post->slug]) }}">{{ $post->title }}</a></div>

                                <div class="card-body">
                                    {{ $post->excerpt }}
                                </div>
                            </div>
                        @endforeach
                        @if($profile->user->posts->count() == 0)
                            <h3 class="text-center">No posts yet</h3>
                        @endif
                    @endif
            </div>
        </div>
    </div>
@endsection
