@extends('layouts.app')

@section('content')
    @include('app.posts._search')
    <div class="container">
        <div class="row">
            @forelse ($posts as $post)
                <div class="col-sm-6 col-md-4 col-lg-4 mt-4">
                    <div class="card">
                        <div class="card-body">
                            @if ($post->image)
                                <img class="img-thumbnail rounded mx-auto d-block" style="min-height: 200px; max-height: 200px" src="{{ $post->imageUrl }}" alt="{{ $post->title }}">
                            @else
                                <img class="img-thumbnail rounded mx-auto d-block" src="{{ asset('images/placeholder.png') }}" alt="{{ $post->title }}">
                            @endif
                            <div class="container">
                                <h6 class="card-title mt-3 text-dark">{{ str_limit($post->title, 30) }}</h6>
                                <div class="meta">
                                    @forelse ($post->tags as $tag)
                                        <a href="{{ url("tags/{$tag->slug}/posts") }}">#{{ $tag->name }}</a>
                                    @empty
                                        <span class="label label-default"></span>
                                    @endforelse
                                </div>
                                <div class="card-text">
                                    <span class="btn btn-sm btn-success">By: {{ $post->user->name }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="container">
                                @if ($post->category)
                                    <form method="get" role="form" style="display: none;" id="category-post-{{ $post->id }}">
                                        <input type="hidden" name="category" value="{{ $post->category->slug }}">
                                    </form>
                                    <span class="btn btn-sm btn-info" onclick='event.preventDefault(); document.getElementById("category-post-{{ $post->id }}").submit();'>
                                        {{ $post->category->name }}
                                    </span>
                                @endif
                                <a href="{{ url("posts/{$post->slug}") }}" class="btn btn-secondary float-right btn-sm">
                                    Show
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
            <div id="no-post-container">
                <div id="error-box">
                    <div class="dot"></div>
                    <div class="dot two"></div>
                    <div class="face2">
                        <div class="eye"></div>
                        <div class="eye right"></div>
                        <div class="mouth sad"></div>
                    </div>
                    <div class="shadow move"></div>
                    <div class="post-pesan">
                        <h1 class="teks-besar alert">Sorry!</h1>
                        <p class="teks-pesan">No post found</p>
                    </div>
                    <button class="button-box">
                        <h1 class="teks-besar red">new search!</h1>
                    </button>
                </div>
            </div>
            @endforelse
        </div>
        <div class="mx-auto mt-3 mb-2" style="width: 200px;">
            {!! $posts->appends(['search' => request()->get('search'), 'category' => request()->get('category')])->links() !!}
        </div>
    </div>
@endsection
