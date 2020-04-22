@csrf
<div class="form-group row">
    <label for="name" class="col-md-1 col-form-label text-md-right">{{ __('Name') }}</label>

    <div class="col-md-11">
        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $category->name }}" required autocomplete="name" autofocus>

        @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="slug" class="col-md-1 col-form-label text-md-right">{{ __('Slug') }}</label>

    <div class="col-md-11">
        <input id="slug" type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" value="{{ old('slug') ?? $category->slug }}" required autocomplete="slug">

        @error('slug')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
