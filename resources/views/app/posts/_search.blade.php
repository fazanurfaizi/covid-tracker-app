<div class="justify-content-center mx-auto">
    <div class="container">
        {!! Form::open(['method' => 'GET', 'role' => 'form', 'class' => 'form-inline ml-3']) !!}
            {!! Form::text('search', request()->get('search'), ['class' => 'form-control form-control-sm mr-3 w-75', 'placeholder' => 'Search...']) !!}
            <button type="submit" class="btn btn-sm btn-simple">
                <i class="fa fa-search" aria-hidden="true"></i>
            </button>
        {!! Form::close() !!}
    </div>
</div>
