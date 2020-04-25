@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card-header">
                    Admin Dashboard
                </div>
            </div>
            <div class="col-md-12">
                <div class="bg-white">
                    <div class="card-body">
                        @can('viewTelescope')
                            <div class="col-md-12">Telescope: <a class="text-dark" href="{{ route('admin.telescope.show') }}">Click Here</a></div>
                        @endcan

                        @can('create', \App\Post::class)
                                <div class="col-md-12">Create a Post: <a class="text-dark" href="{{ route('posts.create') }}">Click Here</a></div>
                        @endcan

                        @can('restore', \App\Post::class)
                                <div class="col-md-12">Restore a Post: <a class="text-dark" href="{{ route('posts.destroyed') }}">Click Here</a></div>
                        @endcan

                        @can('create', \App\Category::class)
                                <div class="col-md-12">Create a Category: <a class="text-dark" href="{{ route('categories.create') }}">Click Here</a></div>
                        @endcan

                        @can('viewAny', \App\Category::class)
                                <div class="col-md-12">View all Categories: <a class="text-dark" href="{{ route('categories.index') }}">Click Here</a></div>
                        @endcan

                        @can('restore', \App\Category::class)
                                <div class="col-md-12">Restore a Category: <a class="text-dark" href="{{ route('categories.destroyed') }}">Click Here</a></div>
                        @endcan

                        @can('delete', \App\Post::class)
                            <div class="col-md-12">You can delete a post by editing it.</div>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
