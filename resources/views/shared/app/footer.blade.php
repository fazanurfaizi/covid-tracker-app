<footer class="page-footer deep-purple center-on-small-only pt-0 bg-dark text-white">
    <div class="container">
        <div class="row pt-5 mb-3 text-center d-flex justify-content-center">
            @auth
                <div class="col-md-3 mb-3">
                    <h6 class="title font-bold">
                        <a class="text-white" href="{{ route('home') }}">Home</a>
                    </h6>
                </div>
                <div class="col-md-3 mb-3">
                    <h6 class="title font-bold">
                        <a class="text-white" href="{{ route('posts') }}">Posts</a>
                    </h6>
                </div>
                <div class="col-md-3 mb-3">
                    <h6 class="title font-bold">
                        <a class="text-white" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                    </h6>
                </div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @endauth
            @guest
                <div class="col-md-2 mb-3">
                    <h6 class="title font-bold"><a class="text-white" href="{{ route('home') }}">Home</a></h6>
                </div>
                <div class="col-md-2 mb-3">
                    <h6 class="title font-bold"><a class="text-white" href="{{ route('posts') }}">Posts</a></h6>
                </div>
                <div class="col-md-2 mb-3">
                    <h6 class="title font-bold"><a class="text-white" href="{{ route('login') }}">Login</a></h6>
                </div>
                <div class="col-md-2 mb-3">
                    <h6 class="title font-bold"><a class="text-white" href="{{ route('register') }}">Register</a></h6>
                </div>
            @endguest
        </div>
        <hr style="margin: 0 15%;border-color: inherit;">
        <div class="row d-flex text-center justify-content-center mb-md-0">
            <div class="col-md-8 col-8 mt-4 mb-2">
                <blockquote style="line-height: 1.7rem" class="blockquote text-center">
                    <p class="mb-0">
                        The world needs huge positive energy to fight against the negative forces. Go to the center of your inner begin and generate that positive energy for the welfare of the humanity.
                    </p>
                    <div class="blockquote-footer">Amit Ray, World Peace: The Voice of a Mountain Bird</div>
                </blockquote>
            </div>
        </div>
        <div class="row py-3">
            <div class="col-md-12">
                <div class="mb-2 text-center">
                    <a href="#" class="icons-sm text-white fb-ic"><i class="fa fa-facebook fa-lg white-text mr-md-4"> </i></a>
                    <a href="#" class="icons-sm text-white tw-ic"><i class="fa fa-twitter fa-lg white-text mx-md-4"> </i></a>
                    <a href="#" class="icons-sm text-white gplus-ic"><i class="fa fa-google-plus fa-lg white-text mx-md-4"> </i></a>
                    <a href="#" class="icons-sm text-white li-ic"><i class="fa fa-linkedin fa-lg white-text mx-md-4"> </i></a>
                    <a href="#" class="icons-sm text-white ins-ic"><i class="fa fa-instagram fa-lg white-text mx-md-4"> </i></a>
                    <a href="#" class="icons-sm text-white pin-ic"><i class="fa fa-pinterest fa-lg white-text ml-md-4"> </i></a>
                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="container-fluid text-center pb-3">
            © {{ date('Y') }} Copyright:
            <a class="text-white" href="#">
                {{ config('app.name', 'Covid Tracker') }}
            </a>
        </div>
    </div>
</footer>

</body>
</html>
