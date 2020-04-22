@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Edit Category') }} @can('delete', $category)<form class="mt-3 text-left" action="{{ route('categories.destroy', [$category->slug]) }}" method="post">@csrf <button type="submit" class="btn-danger btn">@method('DELETE') Delete Category</button></form>@endcan</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('categories.update', $category->slug) }}">
                            @method('PATCH')
                            @include('category.extras.form')
                            <div class="form-group row mb-0">
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
