@extends('layouts.admin')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                       <h5 class="card-title">Create a New Post</h5>
                        <p class="card-category">
                            <a class="btn btn-app" href="{{ route('admin.posts') }}">
                                <i class="fa fa-arrow-left mr-2"></i>
                                Back
                            </a>
                        </p>
                    </div>
                    <div class="panel-body">
                        <form action="{{ url('admin/posts') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
                            @csrf
                            @include('admin.posts._form')
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-2">
                                    <button type="submit" class="btn btn-primary">
                                        Create
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
