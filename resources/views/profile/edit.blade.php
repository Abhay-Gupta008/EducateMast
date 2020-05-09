@extends('layouts.app')
@section('content')
    <div class="container mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card-header">
                    Edit Profile
                </div>
            </div>
            <div class="col-md-12">
                <div class="bg-light">
                    <div class="card-body">
                        <form method="post" action="{{ route('profiles.update', $profile->user->username) }}" enctype="multipart/form-data">
                            @csrf
                            @method("PATCH")
                            <div class="form-group row">
                                <label for="name" class="col-md-1 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-11">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $profile->user->name }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="bio" class="col-md-1 col-form-label text-md-right">{{ __('Bio') }}</label>

                                <div class="col-md-11">
                                    <input id="bio" type="text" class="form-control @error('bio') is-invalid @enderror" name="bio" value="{{ old('bio') ?? $profile->bio }}" required autocomplete="bio">

                                    @error('bio')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="image" class="col-md-1 col-form-label text-md-right">{{ __('Image') }}</label>

                                <div class="col-md-11">
                                    <input id="image" type="file" class="@error('image') is-invalid @enderror" name="image">

                                    @error('image')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-7 offset-md-1">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="receive_emails" id="receive_emails" {{ old('remember') || $profile->receive_emails ? 'checked' : '' }}>

                                        <label class="form-check-label" for="receive_emails">
                                            Receive Emails
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Edit Profile') }}
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
