@extends('layouts.admin')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
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
                                        <th scope="col" width="5%">Id</th>
                                        <th scope="col" width="30%">Name</th>
                                        <th scope="col" width="25%">Post Count</th>
                                        <th scope="col" width="30%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($categories as $category)
                                        <tr>
                                            <td scope="row">{{ $category->id }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->post_count }}</td>
                                            <td>
                                                <a href="{{ url("admin/categories/{$category->id}/edit") }}" class="btn btn-xs- btn-info">
                                                    Edit
                                                </a>
                                                <a href="{{ url("admin/categories/{$category->id}") }}" data-method="DELETE" data-token="{{ csrf_token() }}" data-category="{{ $category->name }}" class="btn btn-xs btn-danger">
                                                    Delete
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2">No Category available.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {!! $categories->links('vendor.pagination.custom') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
