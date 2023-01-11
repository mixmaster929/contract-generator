@include('admin.partials.text-input',['name'=>'sub_heading','label'=>__('te.sub-heading')])
@include('admin.partials.text-input',['name'=>'heading','label'=>__('te.heading')])
@include('admin.partials.text-input',['name'=>'text','label'=>__('te.text')])

@include('admin.partials.text-input',['name'=>'candidate_limit','label'=>__('te.candidate-limit'),'class'=>'number'])
@include('admin.partials.select',['name'=>'order','label'=>__('te.sort-order'),'options'=>['l'=>__('te.latest-profiles'),'r'=>__('te.random')]])

