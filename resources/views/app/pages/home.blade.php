@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="content">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5 col-md-4">
                                    <div class="icon-big text-center icon-warning">
                                        <i class="fa fa-ambulance text-warning"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-md-8">
                                    <div class="numbers">
                                        <p class="card-category">New Cases</p>
                                        <p class="card-title" id="new-cases"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <hr>
                            <div class="stats">
                                <i class="fa fa-refresh" style="cursor: pointer" onclick="location.reload()">
                                    Update now
                                </i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5 col-md-4">
                                    <div class="icon-big text-center icon-warning">
                                        <i class="fa fa-user text-success"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-md-8">
                                    <div class="numbers">
                                        <p class="card-category">Recovered</p>
                                        <p class="card-title" id="recovered"><p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <hr>
                            <div class="stats">
                                <i class="fa fa-refresh" style="cursor: pointer" onclick="location.reload()">
                                    Update now
                                </i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5 col-md-4">
                                    <div class="icon-big text-center icon-warning">
                                        <i class="fa fa-warning text-danger"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-md-8">
                                    <div class="numbers">
                                        <p class="card-category">Deaths</p>
                                        <p class="card-title" id="deaths"><p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <hr>
                            <div class="stats">
                                <i class="fa fa-refresh" style="cursor: pointer" onclick="location.reload()">
                                    Update now
                                </i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5 col-md-4">
                                    <div class="icon-big text-center icon-warning">
                                        <i class="fa fa-calendar-plus-o text-primary"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-md-8">
                                    <div class="numbers">
                                        <p class="card-category">Total Cases</p>
                                        <p class="card-title" id="total-cases"><p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <hr>
                            <div class="stats">
                                <i class="fa fa-refresh" style="cursor: pointer" onclick="location.reload()">
                                    Update now
                                </i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="card ">
                        <div class="card-header ">
                            <h5 class="card-title">Covid-19 Statistics</h5>
                        </div>
                        <div class="card-body ">
                            <canvas id="covidPie" width="400" height="320"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card ">
                        <div class="card-header ">
                            <h5 class="card-title">Covid-19 Tracker</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="covidChart" width="400" height="150"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                @forelse ($posts as $post)
                    <div class="col-sm-4 col-md-4 col-lg-4 mt-4">
                        <div class="card">
                            <div class="card-body">
                                @if ($post->image)
                                    <img class="img-thumbnail rounded mx-auto d-block" style="min-height: 200px; max-height: 200px" src="{{ $post->imageUrl }}" alt="{{ $post->title }}">
                                @else
                                    <img class="img-thumbnail rounded mx-auto d-block" src="{{ asset('images/placeholder.png') }}" alt="{{ $post->title }}">
                                @endif
                                <div class="container">
                                    <h6 class="card-title mt-3">{{ str_limit($post->title, 30) }}</h6>
                                    <div class="meta">
                                        <p>
                                            @forelse ($post->tags as $tag)
                                                <a href="{{ url("tags/{$tag->slug}/posts") }}">#{{ $tag->name }}</a>
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
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ url("posts/{$post->slug}") }}" class="btn btn-secondary float-right btn-sm">
                                    Show
                                </a>
                                <span class="label">{{ $post->created_at->format('d M Y') }}</span>
                                <span class="label">&minus; {{ $post->comments_count }} Comments</span>
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
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            charts.initChartsPages();
            setCovid();
        });
    </script>
@endpush
