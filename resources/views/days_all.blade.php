@extends('layouts.app')

@section('title', 'Prikaz svih dane')

@section('content')
    <section id="days-all">
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
        <div class="search-wrap">
            <form action="{{ route('days.all') }}" method="post" class="search-form">
                {{ csrf_field() }}
                <div class="row">
                    <div class="form-group col-3">
                        <label>Dani sa energijom manjom od:</label>
                        <input type="number" name="energy_less" class="form-control" step="1" min="0" max="10" value="{{ old('energy_less') }}">
                    </div>
                    <div class="form-group col-3">
                        <label>Dani sa energijom većom od:</label>
                        <input type="number" name="energy_greater" class="form-control" step="1" min="0" max="10" value="{{ old('energy_greater') }}">
                    </div>
                    <div class="form-group col-3">
                        <label>Dani pre datuma:</label>
                        <input type="date" name="date_before" class="form-control" value="{{ old('date_before') }}">
                    </div>
                    <div class="form-group col-3">
                        <label>Dani posle datuma:</label>
                        <input type="date" name="date_after" class="form-control" value="{{ old('date_after') }}">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-3">
                        <label>Dani sa manjim trajanjem sna od:</label>
                        <input type="number" name="sleep_duration_less" step="0.01" min="0" max="24" class="form-control" value="{{ old('sleep_duration_less') }}">
                    </div>
                    <div class="form-group col-3">
                        <label>Dani sa većim trajanjem sna od:</label>
                        <input type="number" name="sleep_duration_greater" step="0.01" min="0" max="24" class="form-control" value="{{ old('sleep_duration_greater') }}">
                    </div>
                    <div class="form-group col-3">
                        <label>Dani sa aktivnošću kraćom od:</label>
                        <input type="number" name="activity_duration_less" step="0.01" min="0" max="24" class="form-control" value="{{ old('activity_duration_less') }}">
                    </div>
                    <div class="form-group col-3">
                        <label>Dani sa aktivnošću dužom od:</label>
                        <input type="number" name="activity_duration_greater" step="0.01" min="0" max="24" class="form-control" value="{{ old('activity_duration_greater') }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn-custom btn-blue"><i class="fas fa-search"></i>Pretraži</button>
                        <a href="{{ route('days.all') }}" class="btn-custom btn-blue"><i class="fas fa-sync-alt"></i>Osveži pretragu</a>
                    </div>
                </div>
            </form>
            <ul class="days-list">
                <li>Broj nađenih dana: {{ $days->count() }}</li>
                @if($days->count() > 0)
                    @foreach($days as $day)
                        <li>
                            <a href="{{ route('days.show', ['id' => $day->id]) }}">
                                <div class="date">{{ date('d.m.Y', strtotime($day->date)) }}</div>
                                <div class="title"><i class="fas fa-cloud-moon"></i>San</div>
                                <p>
                                    Zaspao si i u {{ date('H:i', strtotime($day->sleepSession->start)) }},a probudio se u {{ date('H:i', strtotime($day->sleepSession->end)) }}. što je ukupno {{ $day->sleepSession->sleepDuration() }} sati sna.
                                </p>
                                <div class="title"><i class="fas fa-pizza-slice"></i>Klopa</div>
                                <p>
                                    Imao si 
                                        <span class="@if($day->meals->count() === 0) clr-red @endif">{{ $day->meals->count() }}</span>
                                    obroka.
                                </p>
                                <div class="title"><i class="fas fa-dumbbell"></i>Aktivnost</div>
                                <p>
                                    @if($day->activitySessions->count() > 0)
                                        Aktivnosti: 
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
        </div>
    </section>
@endsection


