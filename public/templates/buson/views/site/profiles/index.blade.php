@extends($templateLayout)

@section('page-title',$title)
@section('inline-title',$title)
@section('content')
    <section class="about-area them-2 pb-130 pt-50">
        <div class="container">

            <div class="row">

                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-3">


                            <div id="accordion" class="accordion_ modified-accordion int_tpmb" role="tablist" aria-multiselectable="true" >

                                <div class="card">
                                    <div class="card-header" role="tab" id="headingTwo">
                                        <a class="collapsed" data-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            @lang('site.filter')
                                        </a>
                                    </div>
                                    <div id="collapseTwo" class="collapse" data-parent="#accordion" role="tabpanel" aria-labelledby="headingTwo">
                                        <div class="card-body int_pttwenty"  >
                                            <form method="get" action="{{ route('profiles') }}">

                                                <div class="form-group">
                                                    <input value="{{ request()->search }}" class="form-control" type="text" name="search" placeholder="@lang('site.search')"/>
                                                </div>
                                                @if(\App\Category::count()>0)
                                                    <div class="form-group">
                                                        <label for="category">@lang('site.category')</label>

                                                            <select    name="category" id="category" class="form-control">
                                                                <option></option>
                                                                @foreach($categories as $category)
                                                                    <option   {{ ((null !== old('category',@request()->category)) && old('category',@request()->category) == @$category->id) ? 'selected' : ''}}  value="{{ $category->id }}">{{ $category->name }}</option>
                                                                @endforeach
                                                            </select>


                                                    </div>
                                                @endif


                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label for="search" class="control-label">@lang('site.min-age')</label>
                                                        <select class="form-control" name="min_age" id="min_age">
                                                            <option></option>
                                                            @foreach(range(1,100) as $value)
                                                                <option @if(request()->min_age==$value) selected  @endif value="{{ $value }}">{{ $value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="search" class="control-label">@lang('site.max-age')</label>
                                                        <select class="form-control" name="max_age" id="max_age">
                                                            <option></option>
                                                            @foreach(range(1,100) as $value)
                                                                <option @if(request()->max_age==$value) selected  @endif value="{{ $value }}">{{ $value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="gender" class="control-label">@lang('site.gender')</label>
                                                    <select name="gender" class="form-control" id="gender" >
                                                        <option></option>
                                                        @foreach (json_decode('{"f":"'.__('site.female').'","m":"'.__('site.male').'"}', true) as $optionKey => $optionValue)
                                                            <option value="{{ $optionKey }}" {{ ((null !== old('gender',@request()->gender)) && old('gender',@request()->gender) == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
                                                        @endforeach
                                                    </select>
                                                    {!! clean( $errors->first('gender', '<p class="help-block">:message</p>') ) !!}
                                                </div>

                                                @foreach($fields as $field)

                                                    <?php

                                                    $value= request()->get('field_'.$field->id);

                                                    ?>
                                                    @if($field->type=='text' || $field->type=='textarea')
                                                        <div class="form-group {{ $errors->has('field_'.$field->id) ? ' has-error' : '' }}">
                                                            <label for="{{ 'field_'.$field->id }}">{{ $field->name }}</label>
                                                            <input placeholder="{{ $field->placeholder }}"   type="text" class="form-control" id="{{ 'field_'.$field->id }}" name="{{ 'field_'.$field->id }}" value="{{ $value }}">
                                                            @if ($errors->has('field_'.$field->id))
                                                                <span class="help-block">
                                            <strong>{{ $errors->first('field_'.$field->id) }}</strong>
                                        </span>
                                                            @endif
                                                        </div>
                                                    @elseif($field->type=='select')
                                                        <div class="form-group {{ $errors->has('field_'.$field->id) ? ' has-error' : '' }}">
                                                            <label for="{{ 'field_'.$field->id }}">{{ $field->name }}</label>
                                                            <?php
                                                            $options = nl2br($field->options);
                                                            $values = explode('<br />',$options);
                                                            $selectOptions = [''=>''];
                                                            foreach($values as $value2){
                                                                $selectOptions[$value2]=trim($value2);
                                                            }
                                                            ?>
                                                            {{ Form::select('field_'.$field->id, $selectOptions,$value,['placeholder' => $field->placeholder,'class'=>'form-control']) }}
                                                            @if ($errors->has('field_'.$field->id))
                                                                <span class="help-block">
                                                                                        <strong>{{ $errors->first('field_'.$field->id) }}</strong>
                                                                                    </span>

                                                            @endif
                                                        </div>
                                                    @elseif($field->type=='checkbox')
                                                        <div class="checkbox">
                                                            <label>
                                                                <input name="{{ 'field_'.$field->id }}" type="checkbox" value="1" @if($value==1) checked @endif> {{ $field->name }}
                                                            </label>
                                                        </div>

                                                    @elseif($field->type=='radio')
                                                        <?php
                                                        $options = nl2br($field->options);
                                                        $values = explode('<br />',$options);
                                                        $radioOptions = [];
                                                        foreach($values as $value3){
                                                            $radioOptions[$value3]=trim($value3);
                                                        }
                                                        ?>
                                                        <h5><strong>{{ $field->name }}</strong></h5>
                                                        @foreach($radioOptions as $value2)
                                                            <div class="radio">
                                                                <label>
                                                                    <input type="radio" @if($value==$value2) checked @endif  name="{{ 'field_'.$field->id }}" id="{{ 'field_'.$field->id }}-{{ $value2 }}" value="{{ $value2 }}" >
                                                                    {{ $value2 }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    @endif

                                                @endforeach

                                                <button type="submit" class="btn btn-primary btn-block filter rounded"><i class="fa fa-search"></i> @lang('site.filter')</button>
                                                <br/>
                                                <a class="btn btn-success btn-block rounded" href="{{ route('profiles') }}"><i class="fa fa-sync"></i> @lang('site.reset')</a>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div><!-- accordion -->



                        </div>
                        <div class="col-md-9">

                            <div class="row row-sm">

                                @if($candidates->count()==0)
                                    @lang('site.no-records')
                                @endif

                                @foreach($candidates as $item)
                                        <div class="col-lg-4 col-md-6 pb-30">

                                            <div class="card" ">

                                                <a href="{{ route('profile',['candidate'=>$item->candidate->id]) }}">
                                                    @if(!empty($item->candidate->picture) && file_exists($item->candidate->picture))
                                                        <img class="card-img-top"  src="{{ asset($item->candidate->picture) }}" >
                                                    @elseif($item->candidate->gender=='m')
                                                        <img   class="card-img-top"   src="{{ asset('img/man.jpg') }}">
                                                    @else
                                                        <img  class="card-img-top"   src="{{ asset('img/woman.jpg') }}">
                                                    @endif
                                                </a>


                                                <div class="card-body">
                                                    <h5 class="card-title">{{ $item->candidate->display_name }}</h5>
                                                    <p class="card-text">{{ getAge(\Illuminate\Support\Carbon::parse($item->candidate->date_of_birth)->timestamp) }}/{{ gender($item->candidate->gender) }}</p>
                                                    <a href="{{ route('profile',['candidate'=>$item->candidate->id]) }}" class="btn btn-sm  btn-success rounded"><i class="fa fa-user"></i> @lang('site.view-profile')</a>

                                                    <a href="{{ route('shortlist-candidate',['candidate'=>$item->candidate->id]) }}" class="btn btn-sm btn-primary   rounded"><i class="fa fa-plus"></i> @lang('site.shortlist')</a>
                                                </div>
                                            </div>



                                        </div>
                                @endforeach

                            </div>

                            {!! clean( $candidates->appends(request()->input())->render() ) !!}

                        </div>
                    </div>

                </div>
            </div> <!-- row -->
        </div>
    </section>




@endsection

@section('header')
    <link rel="stylesheet" href="{{ asset('css/templates/accordion.css') }}">


    @endsection
