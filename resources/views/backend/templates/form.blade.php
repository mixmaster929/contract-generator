<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ __('Name') }}</label>
    <input required class="form-control" name="name" type="text" id="name" value="{{ old('name',isset($template->name) ? $template->name : '') }}" >
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>

<button class="btn btn-block btn-primary dropdown-toggle" type="button" id="signatorydropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    {{ __('ShortCodes') }}
</button>
<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <!-- <a class="dropdown-item">{{ __('ShortCodes') }}</a> -->
    @foreach($shortcodes as $code)
    <a class="dropdown-item placeholder-link" data-code="[{{ $code->shortcodes }}]" href="javascript:;" ><strong>[{{ $code->shortcodes }}]</strong></a>
    @endforeach
</div>
<div class="form-group {{ $errors->has('content') ? 'has-error' : ''}}">
    <label for="content" class="control-label">{{ __('Content') }}</label>
    <textarea class="form-control" rows="5" name="content" type="textarea" id="content" >{{ old('content',isset($template->content) ? $template->content : '') }}</textarea>
    {!! $errors->first('content', '<p class="help-block">:message</p>') !!}
</div>

@push('css')
    <link rel="stylesheet" href="{{ asset('admin/wysiwyg/summernote/summernote-bs4.css') }}">
@endpush

@push('js')
    <script src="{{ asset('admin/wysiwyg/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('admin/wysiwyg/js/contract-template.js') }}"></script>
    <script  type="text/javascript">
        "use strict";
        $('.placeholder-link').click(function(){
            let code = $(this).attr('data-code');
            console.log(code);
                $('textarea#content').summernote('editor.saveRange');
                $('textarea#content').summernote('editor.restoreRange');
                $('textarea#content').summernote('editor.focus');
                $('textarea#content').summernote('editor.insertText',code);
            });
    </script>
@endpush
