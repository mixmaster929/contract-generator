
<div class="row">
    <div class="col-md-6">
        @include('admin.partials.color-picker',['name'=>'nav_bg','label'=>__('te.navigation-background')])

        @include('admin.partials.color-picker',['name'=>'nav_text_color','label'=>__('te.navigation-text-color')])

    </div>
    <div class="col-md-6">
        @include('admin.partials.color-picker',['name'=>'footer_bg','label'=>__('te.footer-background')])

        @include('admin.partials.color-picker',['name'=>'footer_text_color','label'=>__('te.footer-text-color')])


    </div>
</div>





