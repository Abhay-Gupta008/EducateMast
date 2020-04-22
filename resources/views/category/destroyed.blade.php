@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12"><h3 class="font-weight-bolder text-center">Destroyed Categories</h3></div>
            <div class="col-md-12"><hr/></div>
            @if($destroyedCategories->count() == 0)
                <div class="col-md-12"><h3 class="text-center">Nothing to restore!</h3></div>
            @endif
            @foreach($destroyedCategories as $category)
                <div class="col-md-12">
                    <div class="card-header">{{ $category->name }}</div>
                </div>
                <div class="col-md-12 mb-3">
                    <div class="bg-white">
                        <div class="card-body">
                            Slug: {{ $category->slug }} <form class="mt-2" method="post" action="{{ route('categories.restore', [$category->id]) }}">@csrf <button class="btn btn-primary" type="submit">Restore Category</button> </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
