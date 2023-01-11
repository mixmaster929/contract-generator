@include('admin.partials.text-input',['name'=>'heading','label'=>__('te.heading')])
@include('admin.partials.textarea',['name'=>'text','label'=>__('te.text')])
<div class="mb-5">
    <div class="card">
        <div class="card-header">
            {{ __t('google-map') }}
        </div>
        <div class="card-body">
            @include('admin.partials.select',['name'=>'google_map','label'=>__t('google-map'),'options'=>array('1'=>__('site.enabled'),'0'=>__('site.disabled'))])
            @include('admin.partials.text-input',['name'=>'map_address','label'=>__t('map-address')])
        </div>
    </div>

</div>

<div class="card mb-5">
 <div class="card-header">
     @lang('te.social')
</div>
<div class="card-body">
    @foreach(['facebook','twitter','instagram','youtube','linkedin'] as $value)
        @include('admin.partials.text-input',['name'=>'social_'.$value,'label'=>ucfirst($value)])
    @endforeach
</div>
</div>





