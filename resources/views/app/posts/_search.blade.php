<div class="justify-content-center mx-auto">
    <div class="container">
        {!! Form::open(['method' => 'GET', 'role' => 'form', 'class' => 'form-inline ml-3']) !!}
            {!! Form::text('search', request()->get('search'), [
                'class' => 'form-control form-control-sm mr-3 w-75',
                'placeholder' => 'Search...',
                'style' => 'height: 35px'
            ])
            !!}
            <button type="submit" class="btn btn-sm btn-simple" style="height: 35px">
                <i class="fa fa-search" aria-hidden="true"></i>
            </button>
        {!! Form::close() !!}
        <button class="btn btn-md btn-simple ml-3" onclick="showCategories()">
            Category
        </button>
        {!! Form::open(['method' => 'GET', 'role' => 'form']) !!}
            <div style="display: none;" id="myCategories">
                <div class="list-group d-inline ml-3" role="tablist">
                    <button name="category" type="submit" class="btn btn-outline-dark" value="">All</button>
                    @foreach ($categories as $category)
                        <button name="category" type="submit" class="btn btn-outline-dark" value="{{ $category->name }}">{{ $category->name }}</button>
                    @endforeach
                </div>
            </div>
        {!! Form::close() !!}
    </div>
</div>

<script>
    function showCategories() {
        var x = document.getElementById("myCategories");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }
</script>
