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
                        <h5 class="card-title">Posts</h5>
                        <p class="card-category">
                            <a class="btn btn-app" href="{{ route('admin.posts.create') }}">Create New Post</a>
                        </p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive mb-3">
                            <table class="table table-bordered" style="width: 98%">
                                <thead>
                                    <tr>
                                        <th scope="col" width="5%">Id</th>
                                        <th scope="col" width="25%">Title</th>
                                        <th scope="col" width="15%">Tag List</th>
                                        <th scope="col" width="15%">Category</th>
                                        <th scope="col" width="30%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($posts as $post)
                                        <tr>
                                            <td scope="row">{{ $post->id }}</td>
                                            <td>{{ $post->title }}</td>
                                            <td>{!! implode(", ", $post->tagList) !!}</td>
                                            <td>{{ $post->category->name ?? '' }}</td>
                                            <td>
                                                <div class="btn-group d-flex">
                                                    @php
                                                        if($post->published == 'Yes') {
                                                            $label = 'Draft';
                                                        } else {
                                                            $label = 'Publish';
                                                        }
                                                    @endphp
                                                    <a href="{{ url("admin/posts/{$post->id}/publish") }}" data-method="PUT" data-token="{{ csrf_token() }}" data-name="{{ $post->name }}" data-confirm="@lang('admin.confirm.title') | @lang('admin.confirm.text.update')" data-message="@lang('admin.update.success')" data-button='@lang('admin.confirm.button.yes') | @lang('admin.confirm.button.cancel')' data-callback="@lang('admin.update.callback') | @lang('admin.update.canceled')" data-canceled="@lang('admin.confirm.canceled')" class="btn btn-secondary btn-xs btn-warning w-100">
                                                        {{ $label }}
                                                    </a>
                                                    <a href="{{ url("admin/posts/{$post->id}/edit") }}" class="btn btn-secondary btn-xs btn-info w-100 ">
                                                        Edit
                                                    </a>
                                                    <a href="{{ url("admin/posts/{$post->id}") }}" data-method="DELETE" data-token="{{ csrf_token() }}" data-name="{{ $post->name }}" data-confirm="@lang('admin.confirm.title') | @lang('admin.confirm.text.delete')" data-message="@lang('admin.delete.success')" data-button='@lang('admin.confirm.button.yes') | @lang('admin.confirm.button.cancel')' data-callback="@lang('admin.delete.callback') | @lang('admin.delete.canceled')" data-canceled="@lang('admin.confirm.canceled')" class="btn btn-secondary btn-xs btn-danger w-100">
                                                        Delete
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5">
                                                <h5 class="text-center">No Post available.</h5>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        {!! $posts->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
