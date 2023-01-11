<div class="row">
    @for($i=1;$i <= 9; $i++)
        <div class="col-md-4">

                    @include('admin.partials.image-input',['name'=>'file'.$i,'label'=>__('te.image')])

        </div>
    @endfor

</div>

