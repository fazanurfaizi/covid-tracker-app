<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
    <label for="title" class="col-md-2 control-label">Title</label>
    <div class="col-md-12">
        {!! Form::text('title', old('title'), ['class' => 'form-control', 'required']) !!}
        <span class="help-block">
            <strong>{{ $errors->first('title') }}</strong>
        </span>
    </div>
</div>

<div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
    <label for="body" class="col-md-2 control-label">Body</label>
    <div class="col-md-12">
        {!! Form::textarea('body', old('body'), [
            'class' => 'form-control', 'id' => 'text-editor'
        ]) !!}
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

@php
    if(isset($post)) {
        $tag = $post->tags->pluck('name')->all();
    } else {
        $tag = null;
    }
@endphp

<div class="form-group {{ $errors->has('tags') ? ' has-error' : '' }}">
    <label for="tags" class="col-md-2 control-label">Tags</label>
    <div class="col-md-12">
        {!! Form::select('tags[]', $tags, $tag, ['class' => 'form-control select2-tags', 'multiple']) !!}
        <span class="help-block">
            <strong>{{ $errors->first('tags') }}</strong>
        </span>
    </div>
</div>

@push('scripts')
    <script src="{{ asset('plugins/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('text-editor', {
            fullPage: true,
            allowedContent: true,
            extraPlugins: [
                'autogrow',
            ],
        });
    </script>
@endpush
