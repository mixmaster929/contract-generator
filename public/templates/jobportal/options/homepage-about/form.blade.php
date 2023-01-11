@include('admin.partials.text-input',['name'=>'heading','label'=>__('te.heading')])
@include('admin.partials.rte',['name'=>'text','label'=>__('te.text')])
<div class="row">
    <div class="col-md-6">@include('admin.partials.image-input',['name'=>'image_1','label'=>__('te.image').' 1'])</div>
    <div class="col-md-6">@include('admin.partials.image-input',['name'=>'image_2','label'=>__('te.image').' 2'])</div>
</div>
<div class="row">
    <div class="col-md-6">@include('admin.partials.image-input',['name'=>'image_3','label'=>__('te.image').' 3'])</div>
    <div class="col-md-6">@include('admin.partials.image-input',['name'=>'image_4','label'=>__('te.image').' 4'])</div>
</div>




