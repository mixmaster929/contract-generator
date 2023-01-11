@extends('layouts.main')

@section('title', 'Templates')

@section('breadcump')
<div class="col-sm-6">
    <h1 class="m-0">{{ __('Templates') }}</h1>
</div>
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('backend.templates.index') }}">{{ __('Home') }}</a></li>
        <li class="breadcrumb-item active">{{ __('Templates') }}</li>
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
                    {{ __('Templates Data') }}
                </h3>
            </div>
            <div class="card-body">
                @can('tambah pengguna')
                <div class="text-right mb-3">
                    <a href="{{ route('backend.templates.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus-circle mr-2"></i>
                        {{ __('Add') }}
                    </a>
                </div>
                @endcan
                <div class="table-responsive">
                <table class="table table-striped table-bordered table-sm" cellspacing="0" width="100%" id="example">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Contents') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse ($templates as $template)
                            <tr>
                                <td>{{ $template->id }}</td>
                                <td>{{ $template->name }}</td>
                                <td>{{ $template->content }}</td>
                                <td>
                                    <a href="{{ route('backend.templates.edit', $template) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit mr-2"></i>
                                        {{ __('Edit') }}
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted"><i>{{ __('Empty Data') }}</i>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection