@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card-header">
                    Requirements for becoming a Author:
                </div>
            </div>
            <div class="col-md-12">
                <div class="bg-white">
                    <div class="card-body">
                        <ul>
                            <li>Being a member of our Discord Server</li>
                            <li>Having a good reputation in our Discord Server</li>
                            <li>Writing atleast one post in a month.</li>
                        </ul>
                        <div class="col-md-12"><a class="text-dark font-weight-bold" href="{{ route('author-form.show') }}">Click Here to Apply.</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
