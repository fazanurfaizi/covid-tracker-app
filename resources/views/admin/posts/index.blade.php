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
                    <form method="get" role="form" class="form-inline ml-3">
                        <input type="text" name="search" value="{{ request()->get('title') }}" class="form-control form-control-sm mr-3 w-75" placeholder="Search" style="height: 35px;">
                        <button type="submit" class="btn btn-sm btn-simple" style="height: 35px">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                    </form>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered mb-3" style="width: 98%">
                                <thead>
                                    <tr>
                                        <th scope="col" width="5%" class="text-center border">Id</th>
                                        <th scope="col" width="25%" class="text-center border">Title</th>
                                        <th scope="col" width="15%" class="text-center border">Tag List</th>
                                        <th scope="col" width="15%" class="text-center border">Category</th>
                                        <th scope="col" width="30%" class="text-center border">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($posts as $post)
                                        <tr>
                                            <td scope="row" class="text-center">{{ $post->id }}</td>
                                            <td class="text-left">{{ $post->title }}</td>
                                            <td class="text-center">{!! implode(", ", $post->tagList) !!}</td>
                                            <td class="text-center">{{ $post->category->name ?? '' }}</td>
                                            <td>
                                                <div class="btn-group d-flex">
                                                    @php
                                                        if($post->published) {
                                                            $label = 'Draft';
                                                        } else {
                                                            $label = 'Publish';
                                                        }
                                                    @endphp
                                                    <a href="{{ url("admin/posts/{$post->id}/publish") }}" data-method="PUT" data-token="{{ csrf_token() }}" data-name="{{ $post->name }}" data-confirm="@lang('admin.confirm.title') | @lang('admin.confirm.text.update')" data-message="@lang('admin.update.success')" data-button='@lang('admin.confirm.button.yes') | @lang('admin.confirm.button.cancel')' data-callback="@lang('admin.update.callback') | @lang('admin.update.canceled')" data-canceled="@lang('admin.confirm.canceled')" class="btn btn-secondary btn-xs btn-warning w-100">
                                                        {{ $label }}
                                                    </a>
                                                    <a href="{{ url("admin/posts/{$post->id}/edit") }}" class="btn btn-secondary btn-xs btn-info w-100">
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
                        {!! $posts->appends(['search' => request()->get('search')])->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
