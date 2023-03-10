@extends('layouts.main')

@section('title', 'Users')

@section('breadcump')
<div class="col-sm-6">
    <h1 class="m-0">{{ __('Users') }}</h1>
</div>
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('backend.shortcodes.index') }}">{{ __('Home') }}</a></li>
        <li class="breadcrumb-item active">{{ __('Users') }}</li>
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
                    {{ __('User Data') }}
                </h3>
            </div>
            <div class="card-body">
                @can('tambah pengguna')
                <div class="text-right mb-3">
                    <a href="{{ route('backend.users.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus-circle mr-2"></i>
                        {{ __('Add User') }}
                    </a>
                </div>
                @endcan
                <div class="table-responsive">

                    <table class="table table-striped table-bordered table-sm" cellspacing="0" width="100%" id="example">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Email') }}</th>
                                <!-- <th>{{ __('No.hp') }}</th> -->
                                <th>{{ __('Role') }}</th>
                                <!-- <th>{{ __('Gambar') }}</th> -->
                                <th>{{ __('Created Date') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <!-- <td>{{ $user->phone_number }}</td> -->
                                <td>
                                    @foreach ($user->roles as $user_role)
                                    <span class="badge badge-danger">{{ $user_role->name }}</span>
                                    @endforeach
                                </td>
                                <!-- <td>
                                    <a href="{{ asset('storage') . "/" . $user->image }}" target="_blank">
                                        <img src="{{ asset('storage') . "/" . $user->image }}" alt="img" width="50" class="img-thumbnail">
                                    </a>
                                </td> -->
                                <td>{{ $user->created_at->diffForHumans() }}</td>
                                <td>
                                    @if (in_array("Super Admin", $user->roles->pluck('name')->toArray()))
                                    {{-- <span class="text-center text-muted"><i>{{ __('Pengguna default') }}</i></span>
                                    --}}
                                    @else
                                    @can('ubah pengguna')
                                    <a href="{{ route('backend.users.edit', $user) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit mr-2"></i>
                                        {{ __('Edit') }}
                                    </a>
                                    @endcan
                                    @endif
                                    @can('lihat pengguna')
                                    <a href="{{ route('backend.users.show', $user) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye mr-2"></i>
                                        {{ __('Detail') }}
                                    </a>
                                    @endcan
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted"><i>{{ __('Data pengguna kosong') }}</i>
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

@push('js')
<script type="text/javascript">
    $(document).ready(function () {
        $('#example').DataTable();
        $('.dataTables_length').addClass('bs-select');
    });
</script>
@endpush

