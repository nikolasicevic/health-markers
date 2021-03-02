@extends('layouts.app')

@section('title', 'Početna')

@section('content')
    <!-- Showing chart with the data for the last 7 days -->
    <section id="charts">
        <nav>
            <ul>
                @foreach($chartData as $key => $data)
                    <li><a href="#" class="stats-btn @if($loop->first) active @endif" data-type="{{ $key }}">Poslednjih {{ $data['day_count'] }} dana</a></li>
                @endforeach
            </ul>
        </nav>
        <div class="stats-wrap">
            @foreach($chartData as $key => $data)
                <div class="stats @if($loop->first) stats-show @endif" id="{{ $key }}">
                    <div class="data-blocks data-blocks-sm">
                        <div class="data-block">
                            <div class="data-left">Prosečno trajanje sna:</div>
                            <div class="data-right">{{ $data['avgs']['avg_sleep_duration'] }} sati</div>
                        </div>
                        <div class="data-block">
                            <div class="data-left">Prosečno vreme spavanja:</div>
                            <div class="data-right">{{ $data['avgs']['avg_sleep_start'] }}</div>
                        </div>
                        <div class="data-block">
                            <div class="data-left">Prosečno vreme buđenja:</div>
                            <div class="data-right">{{ $data['avgs']['avg_sleep_end'] }}</div>
                        </div>
                        <div class="data-block">
                            <div class="data-left">Prosečan broj obroka:</div>
                            <div class="data-right">{{ $data['avgs']['avg_meal_number'] }}</div>
                        </div>
                        <div class="data-block">
                            <div class="data-left">Prosečno trajanje aktivnosti:</div>
                            <div class="data-right">{{ $data['avgs']['avg_activity_duration'] }} sati</div>
                        </div>
                        <div class="data-block">
                            <div class="data-left">Prosečan nivo energije:</div>
                            <div class="data-right">{{ $data['avgs']['avg_energy_level'] }}</div>
                        </div>
                    </div>
                    <div class="chart-wrap">
                        <canvas id="{{ $key }}Chart"></canvas>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <section id="days">
        <ul class="days-list">
            @if($days->count() > 0)
                @foreach($days as $day)
                    <li>
                        <a href="{{ route('days.show', ['id' => $day->id]) }}">
                            <div class="date">{{ date('d.m.Y', strtotime($day->date)) }}</div>
                            <div class="title"><i class="fas fa-cloud-moon"></i>San</div>
                            <p>
                                Zaspao si i u {{ date('H:i', strtotime($day->sleepSession->start)) }},a probudio se u {{ date('H:i', strtotime($day->sleepSession->end)) }}. što je ukupno {{ $day->sleepSession->sleepDuration() }} sati sna.
                            </p>
                            <div class="title"><i class="fas fa-pizza-slice"></i>Obroci</div>
                            <p>
                                Imao si <span class="@if($day->meals->count() === 0) clr-red @endif">{{ $day->meals->count() }}</span> obroka.
                            </p>
                            <div class="title"><i class="fas fa-dumbbell"></i>Aktivnost</div>
                            <p>
                                @if($day->activitySessions->count() > 0)
                                    Od aktivnosti si imao
                                    @foreach($day->activitySessions as $activitySession)
                                        @if($loop->last)
                                            and
                                            <strong>{{ $activitySession->activity->name }}</strong>
                                        @else
                                            <strong>{{ $activitySession->activity->name }},</strong>
                                        @endif
                                    @endforeach

                                    što je ukupno {{ round($day->activitySessions->sum('duration_hrs'), 2) }} sati.
                                @else
                                    <span class="clr-red">Izgleda da ništa nisi vežbao.</span>
                                @endif
                            </p>
                            <div class="title"><i class="fas fa-heartbeat"></i>Energia</div>
                            <div class="energy-level">
                                @if(isset($day->energy_level))
                                    @for($i=1; $i <= 10; $i++)
                                        <span class="level @if($i <= $day->energy_level) selected @endif"></span>
                                    @endfor
                                @else
                                    <span class="clr-red">Nisi un'o energije u ovaj dan.</span>
                                @endif
                            </div>
                        </a>
                    </li>
                @endforeach
            @endif
        </ul>
    </section>
    <script type="text/javascript">
        // Dataset for weekly chart
        var weeklyDateData = @json($chartData['weekly']['chart_values']['date_array']);
        var weeklySleepData = @json($chartData['weekly']['chart_values']['sleep_session_array']);
        var weeklyMealData = @json($chartData['weekly']['chart_values']['meal_number_array']);
        var weeklyActivityData = @json($chartData['weekly']['chart_values']['activity_duration_array']);
        var weeklyEnergyLevelData = @json($chartData['weekly']['chart_values']['energy_level_array']);

        // Dataset for monthly chart
        var monthlyDateData = @json($chartData['monthly']['chart_values']['date_array']);
        var monthlySleepData = @json($chartData['monthly']['chart_values']['sleep_session_array']);
        var monthlyMealData = @json($chartData['monthly']['chart_values']['meal_number_array']);
        var monthlyActivityData = @json($chartData['monthly']['chart_values']['activity_duration_array']);
        var monthlyEnergyLevelData = @json($chartData['monthly']['chart_values']['energy_level_array']);

        // Dataset for quarterly chart
        var quarterlyDateData = @json($chartData['quarterly']['chart_values']['date_array']);
        var quarterlySleepData = @json($chartData['quarterly']['chart_values']['sleep_session_array']);
        var quarterlyMealData = @json($chartData['quarterly']['chart_values']['meal_number_array']);
        var quarterlyActivityData = @json($chartData['quarterly']['chart_values']['activity_duration_array']);
        var quarterlyEnergyLevelData = @json($chartData['quarterly']['chart_values']['energy_level_array']);

        var weeklyLineChartData = {
            labels: weeklyDateData,
            datasets: [{
                label: "San",
                borderColor: '#0881D1',
                backgorundColor: '#0881D1',
                fill: false,
                data: weeklySleepData,
            }, {
                label: "Obroci",
                borderColor: '#4CCF6F',
                backgorundColor: '#4CCF6F',
                fill: false,
                data: weeklyMealData,
            }, {
                label: "Aktivnosti",
                borderColor: '#FF5B64',
                backgorundColor: '#FF5B64',
                fill: false,
                data: weeklyActivityData,
            }, {
                label: "Nivo energije",
                borderColor: '#E6E367',
                backgorundColor: '#E6E367',
                fill: false,
                data: weeklyEnergyLevelData,
            }]
        };

        var monthlyLineChartData = {
            labels: monthlyDateData,
            datasets: [{
                label: "San",
                borderColor: '#0881D1',
                backgorundColor: '#0881D1',
                fill: false,
                data: monthlySleepData,
            }, {
                label: "Obroci",
                borderColor: '#4CCF6F',
                backgorundColor: '#4CCF6F',
                fill: false,
                data: monthlyMealData,
            }, {
                label: "Aktivnosti",
                borderColor: '#FF5B64',
                backgorundColor: '#FF5B64',
                fill: false,
                data: monthlyActivityData,
            }, {
                label: "Nivo energije",
                borderColor: '#E6E367',
                backgorundColor: '#E6E367',
                fill: false,
                data: monthlyEnergyLevelData,
            }]
        };

        var quarterlyLineChartData = {
            labels: quarterlyDateData,
            datasets: [{
                label: "San",
                borderColor: '#0881D1',
                backgorundColor: '#0881D1',
                fill: false,
                data: quarterlySleepData,
            }, {
                label: "Obroci",
                borderColor: '#4CCF6F',
                backgorundColor: '#4CCF6F',
                fill: false,
                data: quarterlyMealData,
            }, {
                label: "Aktivnosti",
                borderColor: '#FF5B64',
                backgorundColor: '#FF5B64',
                fill: false,
                data: quarterlyActivityData,
            }, {
                label: "Nivo energije",
                borderColor: '#E6E367',
                backgorundColor: '#E6E367',
                fill: false,
                data: quarterlyEnergyLevelData,
            }]
        };

        window.onload = function() {
            var ctxWeekly = document.getElementById('weeklyChart').getContext('2d');
            var ctxMonthly = document.getElementById('monthlyChart').getContext('2d');
            var ctxQuarterly = document.getElementById('quarterlyChart').getContext('2d');
            window.myLine = Chart.Line(ctxWeekly, {
                data: weeklyLineChartData,
                options: {
                    responsive: true,
                    hoverMode: 'index',
                    stacked: false,
                    title: {
                        display: true,
                        text: "San, obroci, aktivnosti i nivo energije u poslednjih 7 dana"
                    },
                    scales: {
                        yAxes: [{
                            type: 'linear',
                            display: true,
                            position: 'left',
                        }],
                    }
                }
            });

            window.myLine = Chart.Line(ctxMonthly, {
                data: monthlyLineChartData,
                options: {
                    responsive: true,
                    hoverMode: 'index',
                    stacked: false,
                    title: {
                        display: true,
                        text: "San, obroci, aktivnosti i nivo energije u poslednjih 30 dana"
                    },
                    scales: {
                        yAxes: [{
                            type: 'linear',
                            display: true,
                            position: 'left',
                        }],
                    }
                }
            });

            window.myLine = Chart.Line(ctxQuarterly, {
                data: quarterlyLineChartData,
                options: {
                    responsive: true,
                    hoverMode: 'index',
                    stacked: false,
                    title: {
                        display: true,
                        text: "San, obroci, aktivnosti i nivo energije u poslednjih 90 dana"
                    },
                    scales: {
                        yAxes: [{
                            type: 'linear',
                            display: true,
                            position: 'left',
                        }],
                    }
                }
            });
        }
    </script>
@endsection
