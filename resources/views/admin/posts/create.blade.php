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
                            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                                <label for="title" class="col-md-2 control-label">Title</label>
                                <div class="col-md-12">
                                    <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
                                <label for="body" class="col-md-2 control-label">Body</label>
                                <div class="col-md-12">
                                    <textarea name="body" id="text-editor" cols="100" rows="50">
                                        {{ old('body') }}
                                    </textarea>
                                    <span class="help-block">
                                        <strong>{{ $errors->first('body') }}</strong>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
                                <label for="category_id" class="col-md-2 control-label">Category</label>
                                <div class="col-md-12">
                                    {!! Form::select('category_id', $categories, old('category_id'), ['class' => 'form-control']) !!}
                                    <span class="help-block">
                                        <strong>{{ $errors->first('category_id') }}</strong>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('tags') ? ' has-error' : '' }}">
                                <label for="tags" class="col-md-2 control-label">Tags</label>
                                <div class="col-md-12">
                                    {!! Form::select('tags[]', $tags, null, ['class' => 'form-control select2-tags', 'multiple']) !!}
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tags') }}</strong>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="image" class="col-md-2 control-label">Gambar</label>
                                <div class="col-md-6">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="image" name="image" value="{{ old('image') }}">
                                        <label class="custom-file-label" for="image">{{ isset($post) ? $post->image : null }}</label>
                                    </div>
                                    <img src="{{ asset('images/placeholder.png') }}" alt="Image" id="image-preview" width="100%" height="384" class="mt-2">
                                </div>
                                <div class="clearfix"></div>
                            </div>

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
