<nav id="sidebar" class="sidebar" data-color="white" data-active-color="danger">
    <div class="logo">
        <a href="{{ url('/') }}" class="simple-text logo-mini">
            <div class="logo-image-small">
                <img src="{{ asset('paper/img/logo-small.png') }}">
            </div>
        </a>
        <a href="{{ url('/') }}" class="simple-text logo-normal">
            {{ config('app.name', 'Covid Tracker') }}
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-bank"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.posts') }}">
                    <i class="fa fa-archive"></i>
                    <p>{{ __('Posts') }}</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.categories') }}">
                    <i class="fa fa-list"></i>
                    <p>{{ __('Categories') }}</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.tags') }}">
                    <i class="fa fa-tags"></i>
                    <p>{{ __('Tags') }}</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.users') }}">
                    <i class="fa fa-user"></i>
                    <p>{{ __('User Management') }}</p>
                </a>
            </li>
        </ul>
    </div>
</nav>
