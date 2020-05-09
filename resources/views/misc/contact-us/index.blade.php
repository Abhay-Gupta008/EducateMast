@extends('layouts.app')
@section('content')
    <div class="contact-clean">
        <form method="post">
            @csrf
            <h2 class="text-center">Contact us</h2>
            <div class="form-group"><textarea class="form-control" style="resize: none;" name="message" placeholder="Message"></textarea></div>
            <div class="form-group"><button class="btn btn-primary" type="submit">send </button></div>
        </form>
    </div>
@endsection
