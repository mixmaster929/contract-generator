@extends($templateLayout)

@section('page-title',$title)
@section('inline-title',$title)
@section('crumb')
    <li>{{ $title }}</li>
@endsection
@section('content')


    <section class="job-category style2 section">
        <div class="container">
            <a href="javascript:" data-toggle="modal" data-target="#login"  class="blue-button mb-2 btn btn-lg "><i class="lni lni-sort-alpha-asc"></i> @lang('site.filter')</a>

            <div class="cat-head">
                @if($candidates->count()==0)
                    @lang('site.no-records')
                @endif
                <div class="row">

                                     @foreach($candidates as $item)
                        <div class="col-lg-3 col-md-6 col-12">
                            <a href="{{ route('profile',['candidate'=>$item->candidate->id]) }}" class="single-cat wow fadeInUp" data-wow-delay=".2s">
                                <div class="top-side">
                                    @if(!empty($item->candidate->picture) && file_exists($item->candidate->picture))
                                        <img  class=" img-fluid"    src="{{ asset($item->candidate->picture) }}" >
                                    @elseif($item->candidate->gender=='m')
                                        <img class="img-fluid" src="{{ asset('img/man.jpg') }}">
                                    @else
                                        <img class="img-fluid" src="{{ asset('img/woman.jpg') }}">
                                    @endif
                                </div>
                                <div class="bottom-side">
                                    <span class="available-job">{{ getAge(\Illuminate\Support\Carbon::parse($item->candidate->date_of_birth)->timestamp) }}/{{ gender($item->candidate->gender) }}</span>
                                    <h3>{{ $item->candidate->display_name }}</h3>

                                </div>

                            </a>
                        </div>
                    @endforeach
                </div>

                    <div class="pagination center">
                        {!! $candidates->appends(request()->input())->links('jobportal.views.partials.paginator')  !!}
                    </div>
            </div>
        </div>
    </section>

    <!-- Login Modal -->
    <div class="modal fade form-modal" id="login" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog max-width-px-840 position-relative">
            <button type="button"
                    class="circle-32 btn-reset bg-white pos-abs-tr mt-md-n6 mr-lg-n6 focus-reset z-index-supper"
                    data-dismiss="modal"><i class="lni lni-close"></i></button>
            <div class="login-modal-main">
                <div class="row no-gutters">
                    <div class="col-12">
                        <div class="row">
                            <div class="heading">
                                <h3>@lang('site.filter')</h3>
                            </div>

                            <form method="get" action="{{ route('profiles') }}">
                                <div class="form-group">
                                    <input value="{{ request()->search }}" class="form-control" type="text" name="search" placeholder="@lang('site.search')"/>
                                </div>
                                <div class="form-group">
                                    <label for="category" class="label">@lang('site.category')</label>
                                    <div class="position-relative">
                                        <select    name="category" id="category" class="form-control">
                                            <option></option>
                                            @foreach($categories as $category)
                                                <option   {{ ((null !== old('category',@request()->category)) && old('category',@request()->category) == @$category->id) ? 'selected' : ''}}  value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>



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
                                <div class="form-group mb-8 button">
                                    <button class="btn ">@lang('site.filter')
                                    </button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Login Modal -->




@endsection

