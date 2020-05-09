@extends('layouts.app')
@section('content')
    <div class="container mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card-header">Author Form. <a class="text-dark" href="{{ route('author-form.index') }}">Check out the requirements.</a></div>
            </div>
            <div class="col-md-12">
                <div class="bg-light">
                    <div class="card-body">
                        @if($showForm)
                            <form method="POST" action="{{ route('author-form.store') }}">
                                @csrf

                                <div class="form-group row">
                                    <label for="discord_username" class="col-md-2 col-form-label text-md-right">{{ __('Discord Username') }}</label>

                                    <div class="col-md-10">
                                        <input id="discord_username" type="text" class="form-control @error('discord_username') is-invalid @enderror" name="discord_username" value="{{ old('discord_username') }}" required autocomplete="discord_username" autofocus>

                                        @error('discord_username')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="reason" class="col-md-2 col-form-label text-md-right">{{ __('Why should we choose you?') }}</label>

                                    <div class="col-md-10">
                                        <textarea style="resize: none" rows="6" class="form-control @error('reason') is-invalid @enderror" name="reason" id="reason">{{ old('reason') }}</textarea>

                                        @error('reason')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Apply Form') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                            @elseif($showForm == false && $alreadyStaff == false)
                            <div class="col-md-12">You can't apply anymore. You have applied already.</div>
                        @endif

                        @if ($alreadyStaff)
                            <div class="col-md-12">You are already a member of the staff team!</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
