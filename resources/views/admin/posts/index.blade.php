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
                                                    <a class="btn btn-secondary btn-xs btn-warning w-100" onclick='updatePost({{ $post->id }}, "{{ $label }}")'>
                                                        {{ $label }}
                                                    </a>
                                                    <a href="{{ url("admin/posts/{$post->id}/edit") }}" class="btn btn-secondary btn-xs btn-info w-100">
                                                        Edit
                                                    </a>
                                                    <a class="btn btn-secondary btn-xs btn-danger w-100" onclick="deletePost({{ $post->id }})">
                                                        Delete
                                                    </a>
                                                    <form id="post-update-{{ $post->id }}" action="{{ url("admin/posts/{$post->id}/publish") }}" method="post" style="display: none;">
                                                        @csrf
                                                        @method('PUT')
                                                    </form>
                                                    <form id="post-delete-{{ $post->id }}" action="{{ url("admin/posts/{$post->id}") }}" method="post" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
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

@push('scripts')
    <script>
        function deletePost(id) {
            swal({
                title: "Are you sure?",
                text: "You will delete this",
                icon: 'warning',
                buttons: [
                    "No, Cancel it!",
                    "Yes, I am sure!"
                ],
                dangerMode: true
            }).then(function(confirm) {
                if(confirm) {
                    swal({
                        title: "Delete Successfully",
                        message: "You canceled to delete this",
                        icon: 'success',
                        time: 200
                    }).then(function() {
                        $(`#post-delete-${id}`).submit();
                    })
                } else {
                    swal(
                        "Canceled",
                        "You canceled to delete this",
                        "error"
                    );
                }
            })
        }

        function updatePost(id, status) {
            swal({
                title: "Are you sure?",
                text: `You will ${status} this`,
                icon: 'warning',
                buttons: [
                    "No, Cancel it!",
                    "Yes, I am sure!"
                ],
                dangerMode: true
            }).then(function(confirm) {
                if(confirm) {
                    swal({
                        title: "Update Successfully",
                        message: "You canceled to update this",
                        icon: 'success',
                        time: 200
                    }).then(function() {
                        $(`#post-update-${id}`).submit();
                    })
                } else {
                    swal(
                        "Canceled",
                        "You canceled to update this",
                        "error"
                    );
                }
            })
        }
    </script>
@endpush
