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
                        <h5 class="card-title">Categories</h5>
                        <p class="card-category">
                            <a class="btn btn-app" href="{{ route('admin.categories.create') }}">Create New Category</a>
                        </p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" style="width: 90%">
                                <thead>
                                    <tr>
                                        <th scope="col" width="5%" class="text-center border">Id</th>
                                        <th scope="col" width="30%" class="text-center border">Name</th>
                                        <th scope="col" width="25%" class="text-center border">Post Count</th>
                                        <th scope="col" width="30%" class="text-center border">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($categories as $category)
                                        <tr>
                                            <td scope="row" class="text-center">{{ $category->id }}</td>
                                            <td class="text-center">{{ $category->name }}</td>
                                            <td class="text-center">{{ $category->posts_count }}</td>
                                            <td>
                                                <div class="btn-group d-flex">
                                                    <a href="{{ url("admin/categories/{$category->id}/edit") }}" class="btn btn-secondary btn-xs btn-info w-100">
                                                    Edit
                                                    </a>
                                                    <a href="{{ url("admin/categories/{$category->id}") }}" data-method="DELETE" data-token="{{ csrf_token() }}" data-name="{{ $category->name }}" data-confirm="@lang('admin.confirm.title') | @lang('admin.confirm.text.delete')" data-message="@lang('admin.delete.success')" data-button='@lang('admin.confirm.button.yes') | @lang('admin.confirm.button.cancel')' data-callback="@lang('admin.delete.callback') | @lang('admin.delete.canceled')" data-canceled="@lang('admin.confirm.canceled')" class="btn btn-secondary btn-xs btn-danger w-100" id="deleteBtn">
                                                        Delete
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5">
                                                <h5 class="text-center">No Category available.</h5>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        {!! $categories->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
