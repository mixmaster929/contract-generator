@for($i=1;$i <= 10; $i++)

<div class="card">
    <div class="card-header">
        @lang('te.image') {{ $i }}
    </div>
    <div class="card-body">
        @include('admin.partials.image-input',['name'=>'file'.$i,'label'=>__('te.image')])
        <div class="row">
            <div class="col-md-6">
                @include('admin.partials.text-input',['name'=>'slide_heading'.$i,'label'=>__('te.slide-heading')])
            </div>
            <div class="col-md-6">
                @include('admin.partials.color-picker',['name'=>'heading_font_color'.$i,'label'=>__t('heading-color')])
            </div>
        </div>


        <div class="row">
            <div class="col-md-6">
                @include('admin.partials.textarea',['name'=>'slide_text'.$i,'label'=>__('te.slide-text')])
            </div>
            <div class="col-md-6">
                @include('admin.partials.color-picker',['name'=>'text_font_color'.$i,'label'=>__t('text-color')])
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <h4>{{ __t('button') }} 1</h4>
                @include('admin.partials.text-input',['name'=>'button_1_text_'.$i,'label'=>__t('button-text')])
                @include('admin.partials.text-input',['name'=>'url_1_'.$i,'label'=>__t('link')])
            </div>
            <div class="col-md-6">
                <h4>{{ __t('button') }} 2</h4>
                @include('admin.partials.text-input',['name'=>'button_2_text_'.$i,'label'=>__t('button-text')])
                @include('admin.partials.text-input',['name'=>'url_2_'.$i,'label'=>__t('link')])
            </div>
        </div>


    </div>
</div>
<hr/>
<br/>

@endfor
