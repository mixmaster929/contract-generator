@include('admin.partials.text-input',['name'=>'candidate_limit','label'=>__('te.candidate-limit'),'class'=>'number'])
@include('admin.partials.select',['name'=>'order','label'=>__('te.sort-order'),'options'=>['l'=>__('te.latest-profiles'),'r'=>__('te.random')]])

