<div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
    <label for="name" class="col-md-offset-2 control-label">Name</label>
    <div class="col-md-offset-2">
        {!! Form::text('name', old('name'), ['class' => 'form-control', 'required']) !!}
        <span class="help-block">
            <strong>{{ $errors->first('name') }}</strong>
        </span>
    </div>
</div>
