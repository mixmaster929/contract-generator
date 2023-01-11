<!-- <div class="form-group">
    <label>{{ __('Name') }}</label>
    <textarea rows="4" cols="50" name="name" class="form-control @error('name') is-invalid @enderror" autofocus>
       {{ old('content',$code->name) }} 
    </textarea>
    
    @error('name')
    <small class="invalid-feedback" role="alert">
        {{ $message }}
    </small>
    @enderror
</div> -->
<div class="form-group">
    <label>{{ __('Shortcode') }}</label>
    <input type="text" name="shortcodes" class="form-control @error('shortcodes') is-invalid @enderror"
        value="{{ old('shortcodes', $code->shortcodes) }}">
    @error('shortcodes')
    <small class="invalid-feedback" role="alert">
        {{ $message }}
    </small>
    @enderror
</div>