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
                                <i class="fa fa-refresh"></i>
                                Update now
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
                                <i class="fa fa-refresh"></i> Update now
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
                                <i class="fa fa-refresh"></i> Update now
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
                                <i class="fa fa-refresh"></i> Update now
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="card ">
                        <div class="card-header ">
                            <h5 class="card-title">Email Statistics</h5>
                            <p class="card-category">Last Campaign Performance</p>
                        </div>
                        <div class="card-body ">
                            <canvas id="chartEmail"></canvas>
                        </div>
                        <div class="card-footer ">
                            <div class="legend">
                                <i class="fa fa-circle text-success"></i> Recovered
                                <i class="fa fa-circle text-warning"></i> Active Case
                                <i class="fa fa-circle text-danger"></i> Deaths
                            </div>
                            <hr>
                            <div class="stats">
                                <i class="fa fa-calendar"></i> Number of emails sent
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card ">
                        <div class="card-header ">
                            <h5 class="card-title">Covid-19 Tracker</h5>
                            <p class="card-category">Tracking new covid-19</p>
                        </div>
                        <div class="card-body">
                            <canvas id="chartHours" width="400" height="100"></canvas>
                        </div>
                        <div class="card-footer ">
                            <div class="legend">
                                <i class="fa fa-circle text-success"></i> Recovered
                                <i class="fa fa-circle text-warning"></i> Active Case
                                <i class="fa fa-circle text-danger"></i> Deaths
                            </div>
                            <hr>
                            <div class="stats">
                                <i class="fa fa-circle-thin"></i> New Updates
                            </div>
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
                                <span class="label">Posted: {{ $post->created_at->diffForHumans() }}</span>
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
            demo.initChartsPages();
        });

        getData();

        async function getData() {
            const response = await fetch('https://api.covid19api.com/summary');
            const data = await response.json();
            const { NewConfirmed, TotalConfirmed, TotalDeaths, TotalRecovered } = data.Global;
            document.getElementById('new-cases').innerHTML = turnAngka(NewConfirmed);
            document.getElementById('recovered').innerHTML = turnAngka(TotalRecovered);
            document.getElementById('deaths').innerHTML = turnAngka(TotalDeaths);
            document.getElementById('total-cases').innerHTML = turnAngka(TotalConfirmed);
        }

        function turnAngka(number) {
            var num_string = number.toString();
            var sisa = num_string.length % 3;
            var rupiah = num_string.substr(0, sisa);
            var ribuan = num_string.substr(sisa).match(/\d{3}/g);

            if(ribuan) {
                var separator = sisa ? '.' : '';
                return rupiah += separator + ribuan.join('.');
            }
        }
    </script>
@endpush
