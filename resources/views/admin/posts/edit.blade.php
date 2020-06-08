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
                        <form action="{{ url("admin/posts/{$post->id}") }}" method="post" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                                <label for="title" class="col-md-2 control-label">Title</label>
                                <div class="col-md-12">
                                    <input type="text" name="title" value="{{ $post->title }}" class="form-control">
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
                                <label for="body" class="col-md-2 control-label">Body</label>
                                <div class="col-md-12">
                                    <textarea name="body" id="text-editor" class="form-control">
                                        {{ $post->body }}
                                    </textarea>
                                    <span class="help-block">
                                        <strong>{{ $errors->first('body') }}</strong>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
                                <label for="category_id" class="col-md-2 control-label">Category</label>
                                <div class="col-md-12">
                                    {!! Form::select('category_id', $categories, $post->category_id, ['class' => 'form-control']) !!}
                                    <span class="help-block">
                                        <strong>{{ $errors->first('category_id') }}</strong>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('tags') ? ' has-error' : '' }}">
                                <label for="tags" class="col-md-2 control-label">Tags</label>
                                <div class="col-md-12">
                                    {!! Form::select('tags[]', $tags, $post->tags->pluck('name')->all(), ['class' => 'form-control select2-tags', 'multiple']) !!}
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
                                    <img src="{{ isset($post->image) ? $post->imageUrl : asset('images/placeholder.png') }}" alt="Image" id="image-preview" width="100%" height="384" class="mt-2">
                                </div>
                                <div class="clearfix"></div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-2">
                                    <button type="submit" class="btn btn-primary">
                                        Update
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
