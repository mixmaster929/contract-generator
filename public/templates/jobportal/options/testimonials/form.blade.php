@include('admin.partials.text-input',['name'=>'sub_heading','label'=>__('te.sub-heading')])
@include('admin.partials.text-input',['name'=>'heading','label'=>__('te.heading')])
@include('admin.partials.image-input',['name'=>'image','label'=>__t('image')])
@for($i=1;$i <= 6; $i++)

    <div class="card">
        <div class="card-header">
            {{ __t('testimonial') }} {{ $i }}
        </div>
        <div class="card-body">
            @include('admin.partials.text-input',['name'=>'name'.$i,'label'=>__('site.name')])
            @include('admin.partials.text-input',['name'=>'role'.$i,'label'=>__('site.role')])
            @include('admin.partials.image-input',['name'=>'image'.$i,'label'=>__('te.image').' '.$i])
            @include('admin.partials.textarea',['name'=>'text'.$i,'label'=>__('te.text')])
        </div>
    </div>


@endfor
