@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card-header">
                    Categories
                </div>
            </div>
            <div class="col-md-12">
                <div class="bg-white card-body">
                    @foreach($categories as $category)
                        <div class="text-center"><h4 class="font-weight-bolder">{{ $category->name }} : <a href="{{ route('categories.show', $category->slug) }}">{{ $category->slug }}</a></div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
