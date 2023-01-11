@extends('layouts.main')

@section('title', 'Forms')

@section('breadcump')
<div class="col-sm-6">
    <h1 class="m-0">{{ __('Add Form') }}</h1>
</div>
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('Home') }}</a></li>
        <li class="breadcrumb-item">{{ __('Forms') }}</li>
        <li class="breadcrumb-item active">{{ __('Add') }}</li>
    </ol>
</div>
@endsection

@section('main')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <!-- <h3 class="card-title">
                    {{ __('Add user data form') }}
                </h3> -->
            </div>
            <div class="card-body">
                <div class="text-right mb-3">
                    <a href="{{ route('backend.templates.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left mr-2"></i>
                        {{ __('Back') }}
                    </a>
                </div>
                <!-- <div class="alert alert-info">{{ __('By default, the password will be the same as the email') }}</div> -->
                <form action="{{ route('backend.templates.store') }}" method="POST">
                    @csrf
                    <!-- wysiwyg editor -->

                    @include ('backend.forms.form')
                    <!-- end of wysiwyg editor -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-2"></i>
                            {{ __('Save') }}
                        </button>
                        <a href="{{ route('backend.templates.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times mr-2"></i>
                            {{ __('Cancel') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection