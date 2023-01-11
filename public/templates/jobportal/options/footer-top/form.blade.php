@include('admin.partials.text-input',['name'=>'heading','label'=>__('te.heading')])
@include('admin.partials.text-input',['name'=>'text','label'=>__('te.text')])

@include('admin.partials.select',['name'=>'order_button','label'=>__t('order-button'),'options'=>array('1'=>__('site.enabled'),'0'=>__('site.disabled'))])
@include('admin.partials.select',['name'=>'profile_button','label'=>__t('profile-button'),'options'=>array('1'=>__('site.enabled'),'0'=>__('site.disabled'))])


