@extends('layouts.admin')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert" id="alert-success">
                            {{ $message }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="card-header">
                        <h5 class="card-title">User Management</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" style="width: 90%">
                                <thead>
                                    <tr>
                                        <th scope="col" width="5%">Id</th>
                                        <th scope="col" width="45%">Name</th>
                                        <th scope="col" width="50%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $user)
                                        <tr>
                                            <td scope="row">{{ $user->id }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>
                                                @php
                                                    if($user->permission == 'Yes') {
                                                        $label = 'Admin';
                                                    } else {
                                                        $label = 'Member';
                                                    }
                                                @endphp
                                                <a href="{{ url("admin/users/{$user->id}/permission") }}" data-method="PUT" data-token="{{ csrf_token() }}" data-name="{{ $user->name }}" data-confirm="@lang('admin.confirm.title') | @lang('admin.confirm.text.update')" data-message="@lang('admin.update.success')" data-button='@lang('admin.confirm.button.yes') | @lang('admin.confirm.button.cancel')' data-callback="@lang('admin.update.callback') | @lang('admin.update.canceled')" data-canceled="@lang('admin.confirm.canceled')" class="btn btn-xs btn-warning">
                                                    {{ $label }}
                                                </a>
                                                <a href="{{ url("admin/users/{$user->id}") }}" data-method="DELETE" data-token="{{ csrf_token() }}" data-name="{{ $user->name }}" data-confirm="@lang('admin.confirm.title') | @lang('admin.confirm.text.delete')" data-message="@lang('admin.delete.success')" data-button='@lang('admin.confirm.button.yes') | @lang('admin.confirm.button.cancel')' data-callback="@lang('admin.delete.callback') | @lang('admin.delete.canceled')" data-canceled="@lang('admin.confirm.canceled')" class="btn btn-xs btn-danger" id="deleteBtn">
                                                    Delete
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5">
                                                <h5 class="text-center">No User available.</h5>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        {!! $users->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
