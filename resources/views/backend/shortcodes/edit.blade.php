@extends('layouts.main')

@section('title', 'Edit Shortcode')

@section('breadcump')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('Edit Shortcode') }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('backend.shortcodes.index') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item">{{ __('Shortcodes') }}</li>
            <li class="breadcrumb-item active">{{ __('Edit') }}</li>
        </ol>
    </div>
@endsection

@section('main')
@if (session()->has('success'))
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {{ session('success') }}
        </div>
    </div>
</div>
@endif
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    {{ __('Edit Shortcode data form') }}
                </h3>
            </div>
            <div class="card-body">
                <div class="text-right mb-3">
                    <a href="{{ route('backend.shortcodes.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left mr-2"></i>
                        {{ __('Back') }}
                    </a>
                </div>
                <form action="{{ route('backend.shortcodes.update', $code) }}" method="POST">
                    @csrf
                    @method('PUT')
                    @include('backend.shortcodes._form')
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-2"></i>
                            {{ __('Update') }}
                        </button>
                        <a href="{{ route('backend.shortcodes.index') }}" class="btn btn-secondary">
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
