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
                                        <i class="nc-icon nc-ambulance text-warning"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-md-8">
                                    <div class="numbers">
                                        <p class="card-category">Active Cases</p>
                                        <p class="card-title" id="active-cases"></p>
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
                                        <i class="nc-icon nc-user-run text-success"></i>
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
                                        <i class="nc-icon nc-sound-wave text-danger"></i>
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
                                        <i class="nc-icon nc-favourite-28 text-primary"></i>
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
                <div class="col-md-12">
                    <div class="card card-chart">
                        <div class="card-header">
                            <h5 class="card-title">NASDAQ: AAPL</h5>
                            <p class="card-category">Line Chart with Points</p>
                        </div>
                        <div class="card-body">
                            <canvas id="speedChart" width="400" height="100"></canvas>
                        </div>
                        <div class="card-footer">
                            <div class="chart-legend">
                                <i class="fa fa-circle text-info"></i> Tesla Model S
                                <i class="fa fa-circle text-warning"></i> BMW 5 Series
                            </div>
                            <hr />
                            <div class="card-stats">
                                <i class="fa fa-check"></i> Data information certified
                            </div>
                        </div>
                    </div>
                </div>
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

        async function getCountry() {
            var continent = await new dgContinentsCountries({
                continentVal: document.getElementById("continent").val,
                countryVal: document.getElementById("country").val,
                continent: document.getElementById("continent"),
                country: document.getElementById("country"),
                change: true
            });
        }

        async function getData() {
            const response = await fetch('https://api.covid19api.com/summary');
            const data = await response.json();
            const { NewConfirmed, TotalConfirmed, TotalDeaths, TotalRecovered } = data.Global;
        }
    </script>
@endpush
