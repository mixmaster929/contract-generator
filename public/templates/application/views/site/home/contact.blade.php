@extends($templateLayout)

@section('page-title',__('site.contact-us'))
@section('content')

    <div class="az-dashboard-one-title">
        <div>
            <h2 class="az-dashboard-title">@lang('site.contact-us')</h2>
            <p class="az-dashboard-text">
              @if(!optionActive('contact'))
                @lang('site.get-in-touch-text')
             @else
                {{ toption('contact','info') }}
                @endif
            </p>
        </div>
    </div><!-- az-dashboard-one-title -->

<div class="row">
    <div class="col-md-7">
        @include('partials.flash_message')
        <form action="{{ route('contact.send-mail') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="name">@lang('site.name')</label>
                <input class="form-control" type="text" required name="name" value="{{ old('name') }}"/>
            </div>
            <div class="form-group">
                <label for="email">@lang('site.email')</label>
                <input class="form-control" type="text" required name="email" value="{{ old('email') }}"/>
            </div>
            <div class="form-group">
                <label for="message">@lang('site.message')</label>
                <textarea class="form-control" name="message" rows="5" required>{{ old('message') }}</textarea>
            </div>
            <div class="form-group">
                <label>@lang('site.verification')</label><br/>
                <label for="">{!! clean( captcha_img() ) !!}</label>
                <input class="form-control" type="text" name="captcha" placeholder="@lang('site.verification-hint')"/>
            </div>
            <button type="submit" class="btn btn-primary">@lang('site.submit')</button>

        </form>

    </div>
    <div class="col-md-4 offset-1 ">
        <h3>@lang('site.contact-info')</h3>
        <hr/>
        @if(!empty(setting('general_tel')))
        <h6>@lang('site.telephone')</h6>
        <p>{{ setting('general_tel') }}</p>
            @endif

        @if(!empty(setting('general_address')))
        <h6>@lang('site.address')</h6>
        <p>{{ setting('general_address') }}</p>
        @endif

        @if(!empty(setting('general_contact_email')))
            <h6>@lang('site.email')</h6>
            <p>{{ setting('general_contact_email') }}</p>
        @endif

    </div>
</div>

@endsection
