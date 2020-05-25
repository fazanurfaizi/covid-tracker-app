@extends('layouts.admin')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Edit a Category</h5>
                        <p class="card-category">
                            <a class="btn btn-app" href="{{ route('admin.categories') }}">
                                <i class="fa fa-arrow-left mr-2"></i>
                                Back
                            </a>
                        </p>
                    </div>
                    <div class="card-body">
                        <div class="panel-body">
                            {!! Form::model($category, [
                                'method' => 'PUT',
                                'url' => "admin/categories/{$category->id}",
                                'class' => 'form-horizontal',
                                'role' => 'form'
                            ]) !!}
                                @include('admin.categories._form')
                                <div class="form-group">
                                    <div class="col-mmd-8 col-md-offset-2">
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
    </div>
@endsection
