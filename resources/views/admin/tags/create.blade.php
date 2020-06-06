@extends('layouts.admin')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Create a New Tag</h5>
                        <p class="card-category">
                            <a class="btn btn-app" href="{{ route('admin.tags') }}">
                                <i class="fa fa-arrow-left mr-2"></i>
                                Back
                            </a>
                        </p>
                    </div>
                    <div class="card-body">
                        <div class="panel-body">
                            <form action="{{ url('admin/tags') }}" method="post" class="form-horizontal">
                                @csrf
                                @method('POST')
                                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="name" class="col-md-offset-2 control-label">Name</label>
                                    <div class="col-md-offset-2">
                                        <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-offset-2">
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
    </div>
@endsection
