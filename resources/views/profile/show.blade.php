@extends('layouts.app')
@section('content')
    <div class="text-center profile-card" style="margin:15px;background-color:#ffffff;">
        <div class="profile-card-img" style="background-image:url(&quot;iceland.jpg&quot;);height:150px;background-size:cover;"></div>
        <div><img class="rounded-circle mb-2" style="margin-top:-70px;" src="{{ asset($profile->profile_image()) }}" height="150px">
            <h3><div class="font-weight-bolder">{{ $profile->user->name }}</div><div class="font-weight-bold">{{'@'.$profile->user->username }}</div></h3><h4>{!! $profile->user->badges() !!}</h4>
            <p style="padding:20px;padding-bottom:0;padding-top:5px;">{{ $profile->bio }}</p>
        </div>
        <div class="row" style="padding:0;padding-bottom:10px;padding-top:20px;">
            @if($profile->user->canPost())
                <div class="col-md-12">
                    <p class="text-nowrap text-center">Posts</p>
                    <p class="text-center"><strong>{{ $profile->user->posts->count() }}</strong> </p>
                </div>
                <div class="col-md-12">
                    <p class="text-center">Comments</p>
                    <p class="text-center"><strong>{{ $profile->user->comments->count() }}</strong> </p>
                </div>
                </div>
                <div class="col-md-12">
                    <p class="text-center">Joined on</p>
                    <p class="text-center"><strong>{{ $profile->user->created_at->format('d F, Y') }}</strong> </p>
                </div>
            @else
                <div class="col-md-12">
                    <p class="text-center">Comments</p>
                    <p class="text-center"><strong>{{ $profile->user->comments->count() }}</strong> </p>
                </div>
            <div class="col-md-12">
                <p class="text-center">Joined on</p>
                <p class="text-center"><strong>{{ $profile->user->created_at->format('d F, Y') }}</strong> </p>
            </div>
            @endif
        </div>
    </div>
    @if($profile->user->canPost())
        @foreach($posts as $post)
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ $post->title }}</h4>
                    <h6 class="text-muted card-subtitle mb-2">Category: <a class="text-dark" href="{{ route('categories.show', [$post->category->slug]) }}">{{ $post->category->name }}</a></h6>
                    <p class="card-text">{{ $post->excerpt }}</p>
                    <a class="card-link" href="{{ route('posts.show', [$post->category->slug, $post->slug]) }}">View Post</a>
                </div>
            </div>
        @endforeach
        @if($posts->links() != '')<div class="mt-4 d-flex justify-content-center">{{ $posts->links() }}</div>@endif
    @endif
@endsection
