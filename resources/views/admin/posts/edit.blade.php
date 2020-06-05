@extends('layouts.admin')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                       <h5 class="card-title">Edit a Post</h5>
                        <p class="card-category">
                            <a class="btn btn-app" href="{{ route('admin.posts') }}">
                                <i class="fa fa-arrow-left mr-2"></i>
                                Back
                            </a>
                        </p>
                    </div>
                    <div class="panel-body">
                        {!! Form::model($post, [
                            'method' => 'PUT',
                            'url' => "admin/posts/{$post->id}",
                            'class' => 'form-horizontal',
                            'file' => true,
                            'enctype'=>'multipart/form-data'
                        ])!!}
                            @include('admin.posts._form')
                            <div class="form-group">
                                <div class="row">
                                    <label for="image" class="col-md-3">Gambar</label>
                                    <div class="col-md-6">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="image" name="image" value="{{ old('image') }}">
                                            <label class="custom-file-label" for="image">{{ $post->image }}</label>
                                        </div>
                                        <img src="{{ $post->imageUrl }}" alt="Image" id="image-preview" width="100%" height="512" class="mt-2">
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-2">
                                    <button type="submit" class="btn btn-primary">
                                        Update
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
