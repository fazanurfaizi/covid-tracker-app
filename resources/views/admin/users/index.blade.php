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
                                        <th scope="col" width="5%" class="text-center border">Id</th>
                                        <th scope="col" width="45%" class="text-center border">Name</th>
                                        <th scope="col" width="50%" class="text-center border">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $user)
                                        <tr>
                                            <td scope="row" class="text-center">{{ $user->id }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>
                                                <div class="btn-group d-flex">
                                                    <a class="btn btn-secondary btn-xs btn-warning w-100" onclick="updateUser({{ $user->id }})">
                                                        {{ $user->permission ? 'Admin' : 'Member' }}
                                                    </a>
                                                    <form id="user-update-{{ $user->id }}" action="{{ url("admin/users/{$user->id}/permission") }}" method="post" style="display: none;">
                                                        @csrf
                                                        @method('PUT')
                                                    </form>
                                                    <a class="btn btn-secondary btn-xs btn-danger w-100" onclick="deleteUser({{ $user->id }})">
                                                        Delete
                                                    </a>
                                                    <form id="user-delete-{{ $user->id }}" action="{{ url("admin/users/{$user->id}") }}" method="post" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </div>
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

@push('scripts')
    <script>
        function deleteUser(id) {
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
                        $(`#user-delete-${id}`).submit();
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

        function updateUser(id) {
            swal({
                title: "Are you sure?",
                text: "You will update this",
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
                        $(`#user-update-${id}`).submit();
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
