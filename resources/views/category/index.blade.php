@extends('layouts.app')
@section('content')
    <div class="container mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card-header">
                    Categories @can('restore', \App\Category::class) | <a class="text-dark" href="{{ route('categories.destroyed') }}">Restore Destroyed Categories</a>@endcan
                </div>
            </div>
            <div class="col-md-12">
                <div class="bg-light card-body">
                    @foreach($categories as $category)
                        <div class="text-center"><h4 class="font-weight-bolder">{{ $category->name }} : <a href="{{ route('categories.show', $category->slug) }}">{{ $category->slug }}</a></div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
