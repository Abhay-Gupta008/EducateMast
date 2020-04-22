@csrf

<div class="form-group row">
    <label for="title" class="col-md-1 col-form-label text-md-right">{{ __('Title') }}</label>

    <div class="col-md-11">
        <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') ?? $post->title }}" required autocomplete="title" autofocus>

        @error('title')
        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="body" class="col-md-1 col-form-label text-md-right">{{ __('Body') }}</label>

    <div class="col-md-11">
        <textarea style="resize: none" rows="9" id="body" type="text" class="form-control @error('body') is-invalid @enderror" name="body" required autocomplete="body">{{ old('body') ?? $post->body }}</textarea>

        @error('body')
        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="slug" class="col-md-1 col-form-label text-md-right">{{ __('Slug') }}</label>

    <div class="col-md-11">
        <input id="slug" type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" value="{{ old('slug') ?? $post->slug }}" required autocomplete="slug">

        @error('slug')
        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
        @enderror
    </div>
</div>
    <div class="form-group row">
        <label for="category" class="col-md-1 col-form-label text-md-right">{{ __('Category') }}</label>

        <div class="col-md-11">
            <select class="form-control @error('category') is-invalid @enderror" id="category" name="category">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @if($post->category == $category) selected @endif >{{ $category->name }}</option>
                @endforeach
            </select>

            @error('category')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>


