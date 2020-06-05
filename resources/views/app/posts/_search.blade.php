<div class="justify-content-center mx-auto">
    <div class="container">
        <form method="get" role="form" class="form-inline ml-md-4">
            <input type="text" name="search" value="{{ request()->get('search') }}" class="form-control form-control-sm mr-3 w-75" placeholder="Search" style="height: 35px;">
            <button type="submit" class="btn btn-sm btn-simple" style="height: 35px">
                <i class="fa fa-search" aria-hidden="true"></i>
            </button>
            <div class="btn-group ml-2">
                <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Select Category
                </button>
                <div class="dropdown-menu">
                    <button name="category" type="submit" class="dropdown-item" value="">All</button>
                    <div class="dropdown-divider"></div>
                    @foreach ($categories as $category)
                        <button name="category" type="submit" class="dropdown-item" value="{{ $category->slug }}">{{ $category->name }}</button>
                    @endforeach
                </div>
            </div>
        </form>
    </div>
</div>
