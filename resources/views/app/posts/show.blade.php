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
            </div>
        </div>
    </div>
@endsection
