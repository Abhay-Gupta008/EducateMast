@extends('layouts.app')
@section('content')
    <div class="container mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card-header">
                    Admin Dashboard
                </div>
            </div>
            <div class="col-md-12">
                <div class="bg-light">
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

                        @can('viewAny', App\User::class)
                                <div class="col-md-12">View all users: <a class="text-dark" href="{{ route('users.index') }}">Click Here</a></div>
                        @endcan

                        @can('addAdmins')
                             <admin-add-component token="{{ Auth::user()->api_token }}"></admin-add-component>
                        @endcan

                        @can('addAuthors')
                            <author-add-component token="{{ Auth::user()->api_token }}"></author-add-component>
                        @endcan

                        @can('addTrusted')
                             <trusted-add-component token="{{ Auth::user()->api_token }}"></trusted-add-component>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
