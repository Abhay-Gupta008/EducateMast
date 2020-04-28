@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center">
                <h2 class="font-weight-bolder">Category: {{ $category->name }}</h2>@can('update', $category)<h5 class="mt-2 pl-2"> | <a class="text-dark" href="{{ route('categories.edit', [$category->slug]) }}">Edit Category</a></h5>@endcan
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
                            <div class="card-body"><pre><div style="font-family: Nunito, sans-serif; font-size:1rem;" class="col-md-12"><?php echo preg_replace($url, '<a href="http$2://$4" target="_blank" title="$0">$0</a>', e($post->excerpt)); ?></div></pre></div>
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
