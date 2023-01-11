@extends('layouts.main')

@section('title', 'Shortcodes')

@section('breadcump')
<div class="col-sm-6">
    <h1 class="m-0">{{ __('Shortcodes') }}</h1>
</div>
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('backend.shortcodes.index') }}">{{ __('Home') }}</a></li>
        <li class="breadcrumb-item active">{{ __('Shortcodes') }}</li>
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
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    {{ __('Shortcodes Data') }}
                </h3>
            </div>
            <div class="card-body">
                @can('tambah pengguna')
                <div class="text-right mb-3">
                    <a href="{{ route('backend.shortcodes.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus-circle mr-2"></i>
                        {{ __('Add') }}
                    </a>
                </div>
                @endcan
                <div class="table-responsive">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection