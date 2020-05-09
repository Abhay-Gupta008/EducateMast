@extends('layouts.app')
@section('content')
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>Username</th>
                <th>Name</th>
                <th>Email</th>
                <th>Email Verified</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>@if($user->email_verified_at == NULL)False @else {{ $user->email_verified_at }}@endif</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">{{ $users->links() }}</div>
    </div>
@endsection
