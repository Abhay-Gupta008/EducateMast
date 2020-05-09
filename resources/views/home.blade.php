@extends('layouts.app')

@section('content')
<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in! Currently this dashboard servers no purpose, but this would be changed soon!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
