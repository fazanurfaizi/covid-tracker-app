@extends('layouts.admin')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Tags</h5>
                        <p class="card-category">
                            <a class="btn btn-app" href="{{ route('admin.tags.create') }}">Create New Tag</a>
                        </p>
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
                                    @forelse ($tags as $tag)
                                        <tr>
                                            <td scope="row">{{ $tag->id }}</td>
                                            <td>{{ $tag->name }}</td>
                                            <td>
                                                <a href="{{ url("admin/tags/{$tag->id}/edit") }}" class="btn btn-xs- btn-info">
                                                    Edit
                                                </a>
                                                <a href="{{ url("admin/tags/{$tag->id}") }}" data-method="DELETE" data-token="{{ csrf_token() }}" data-name="{{ $tag->name }}" class="btn btn-xs btn-danger">
                                                    Delete
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2">No Tag available.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        {!! $tags->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
