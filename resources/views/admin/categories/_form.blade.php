<div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
    {!! Form::label('name', 'Name', ['class' => 'col-md-offset-2 control-label']) !!}
    <div class="col-md-offset-2">
        {!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
        <span class="help-block">
            <strong>{{ $errors->first('name') }}</strong>
        </span>
    </div>
</div>
