@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1>{{ $post->title }}</h1>
                {{-- Author --}}
                <p class="lead">
                    by {{ $post->user->name }}
                </p>
                {{-- Author --}}
                <hr>
                <p>Posted on {{ $post->created_at->diffForHumans() }}</p>
                <hr>
                {{-- Content --}}
                <p>{{ $post->body }}</p>
                {{-- Content --}}
                <hr>
                    <p class="mt-3">
                        <like
                            :likes-count="{{ $post->likes_count }}"
                            :liked="{{ json_encode($post->isLiked()) }}"
                            :item-id="{{ $post->id }}"
                            item-type="posts"
                            :logged-in="{{ json_encode(Auth::check()) }}"
                        />
                    </p>

                <div class="row" id="post-comments">
                    <div class="col-12">
                        <div class="comments">
                            {{-- Comments Form --}}
                            <div class="card my-4">
                                <div class="card-body">
                                    @includeWhen(Auth::user(), 'app.comments._form')
                                </div>
                            </div>
                            {{-- Comments Form --}}
                            @include('app.comments.index', ['comments' => $post->comments, 'post_id' => $post->id])
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        {{-- Related Posts --}}
        <h4 class="text-center">Related Posts</h4>
        <div class="text-center">
            @forelse ($post->tags as $tag)
                <a href="{{ url("tags/{$tag->slug}/posts") }}" class="btn btn-sm">
                    {{ $tag->name }}
                </a>
            @empty
                <span class="label label-default"></span>
            @endforelse
        </div>
        <div class="mx-auto">
            <div class="row">
                @forelse ($relatedPosts as $relate)
                    <div class="col-sm-6 col-md-4 col-lg-4 mt-4">
                        <div class="card">
                            <div class="card-block">
                                @if ($relate->image)
                                <img class="img-thumbnail rounded mx-auto d-block" style="min-height: 200px; max-height: 200px" src="{{ $post->imageUrl }}" alt="{{ $post->title }}">
                                @else
                                    <img class="img-thumbnail rounded mx-auto d-block" src="{{ asset('images/placeholder.png') }}" alt="{{ $post->title }}">
                                @endif
                                <div class="container">
                                    <h5 class="card-title mt-3">{{ str_limit(preg_replace('/(<.*?>)|(&.*?;)/', '', $relate->title), 20) }}</h5>
                                    <div class="meta">
                                        <p>{{ str_limit(preg_replace('/(<.*?>)|(&.*?;)/', '', $relate->body), 75) }}</p>
                                        <p>
                                            Tags:
                                            @forelse ($relate->tags as $tag)
                                                <span class="label label-default">{{ $tag->name }}</span>
                                            @empty
                                                <span class="label label-default"></span>
                                            @endforelse
                                        </p>
                                    </div>
                                    <div class="card-text">
                                        <span class="btn btn-sm btn-success">By: {{ $relate->user->name }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                @if ($relate->category)
                                    <span class="btn btn-sm btn-info">{{ $relate->category->name }}</span>
                                @endif
                                <a href="{{ url("posts/{$relate->slug}") }}" class="btn btn-secondary float-right btn-sm">
                                    Show
                                </a>
                            </div>
                        </div>
                    </div>
                @empty

                @endforelse
            </div>
        </div>
    </div>
@endsection
