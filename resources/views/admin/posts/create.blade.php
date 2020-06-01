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
                        {!! Form::open(['url' => 'admin/posts', 'class' => 'form-horizontal', 'role' => 'form', 'file' => true, 'enctype'=>'multipart/form-data']) !!}
                            @include('admin.posts._form')
                            <div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
                                <label for="image" class="col-md-2 control-label">Image</label>
                                <div class="col-md-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="image" name="image" value="{{ old('image') }}">
                                        <label class="custom-file-label" for="image"></label>
                                    </div>
                                    <img src="{{ asset('images/placeholder.png') }}" alt="Image" id="image-preview" width="512" class="mx-auto">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-2">
                                    <button type="submit" class="btn btn-primary">
                                        Create
                                    </button>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
