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
                                <div class="card-title mt-3">{{ $post->title }}</div>
                                <div class="meta">
                                    <p>{{ str_limit($post->body, 75) }}</p>
                                    <p>
                                        Tags:
                                        @forelse ($post->tags as $tag)
                                            <span class="label label-default">{{ $tag->name }}</span>
                                        @empty
                                            <span class="label label-default"></span>
                                        @endforelse
                                    </p>
                                </div>
                                <div class="card-text">
                                    <span class="btn btn-sm btn-success">By: {{ $post->user->name }}</span>
                                    @if ($post->category)
                                        <span class="btn btn-sm btn-info">{{ $post->category->name }}</span>
                                    @endif
                                    <a href="{{ url("posts/{$post->slug}") }}" class="btn btn-secondary float-right btn-sm">
                                        Show
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
            @empty
                <div class="panel panel-default">
                    <div class="panel-heading">Not Found!!</div>
                    <div class="panel-body">
                        <p>Sorry! No post found.</p>
                    </div>
                </div>
            @endforelse
        </div>
        <div class="mx-auto mt-3 mb-2" style="width: 200px;">
            {!! $posts->appends(['search' => request()->get('search')])->links() !!}
        </div>
    </div>
@endsection
