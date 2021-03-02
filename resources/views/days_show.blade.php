@extends('layouts.app')

@section('title', 'Day: ' . date('m/d/Y', strtotime($day->created_at)))

@section('content')
    <section id="days-show">
        <div class="v-block bg-blue">
            <div class="title title-md"><i class="fas fa-cloud-moon"></i>San</div>  
            <div class="data-blocks">
                <a href="{{ route('sleep.edit', ['id' => $day->sleepSession->id]) }}" class="btn-custom btn-light"><i class="fas fa-edit"></i>Promeni</a>
                <div class="data-block">
                    <div class="data-left">Zaspao si:</div>
                    <div class="data-right">
                        @if(isset($day->sleepSession->start))
                            {{ date('d.m.Y H:i', strtotime($day->sleepSession->start)) }}
                        @else
                            Nije uneto
                        @endif
                    </div>
                </div>
                <div class="data-block">
                    <div class="data-left">Probudio si se:</div>
                    <div class="data-right">
                        @if(isset($day->sleepSession->end))
                            {{ date('d.m.Y H:i', strtotime($day->sleepSession->end)) }}
                        @else
                            Nije uneto
                        @endif
                    </div>
                </div>
                <div class="data-block">
                    <div class="data-left">Ukupno sna:</div>
                    <div class="data-right">
                        @if(isset($day->sleepSession->start) && isset($day->sleepSession->end))
                            {{ $day->sleepSession->sleepDuration() }} sati
                        @else
                            Ne mož' se izračuna
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="v-block bg-green">
            <div class="title title-md"><i class="fas fa-pizza-slice"></i>Klopa</div>
            <div class="data-blocks">
                <a href="{{ route('meals.create', ['dayId' => $day->id]) }}" class="btn-custom btn-light"><i class="fas fa-plus-circle"></i>Dodaj</a>
                @if($day->meals->count() > 0)    
                    @foreach($day->meals as $meal)
                        <div class="data-block with-action">
                            <div class="data-left">{{ $meal->name }} u {{ date('H:i', strtotime($meal->time)) }}</div>
                            <div class="data-right">
                                <a href="{{ route('meals.edit', ['id' => $meal->id]) }}" class="btn-custom btn-yellow"><i class="fas fa-edit"></i></a>
                                <a href="{{ route('meals.destroy', ['dayId' => $day->id, 'id' => $meal->id]) }}" class="btn-custom btn-red"><i class="fas fa-trash"></i></a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="data-block">
                        Ili ništa nisi jeo danas ili nisi zapisao.
                    </div>
                @endif
            </div>
        </div>
        <div class="v-block bg-red">
            <div class="title title-md"><i class="fas fa-dumbbell"></i>Aktivnost</div>
            <div class="data-blocks">
                <a href="{{ route('activities.sessions.create', ['dayId' => $day->id]) }}" class="btn-custom btn-light"><i class="fas fa-plus-circle"></i>Dodaj</a>
                @if($day->activitySessions->count() > 0)    
                    @foreach($day->activitySessions as $activitySession)
                        <div class="data-block with-action">
                            <div class="data-left">{{ $activitySession->activity->name }}, {{ $activitySession->duration_hrs }} sata</div>
                            <div class="data-right">
                                <a href="{{ route('activities.sessions.edit', ['id' => $activitySession->id]) }}" class="btn-custom btn-yellow"><i class="fas fa-edit"></i></a>
                                <a href="{{ route('activities.sessions.destroy', ['dayId' => $activitySession->day->id, 'id' => $activitySession->id]) }}" class="btn-custom btn-red"><i class="fas fa-trash"></i></a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="data-block">
                        Ili ništa nisi vežbao danas ili nisi zapisao.
                    </div>
                @endif
            </div>
        </div>
        <div class="h-block">
            <form action="{{ route('days.update', ['id' => $day->id]) }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="energy_level" value="{{ $day->energy_level }}">
                Nivo energije: 
                <div class="energy-level">
                    @for($i = 1;$i <= 10;$i++)
                        <span class="level @if($i <= $day->energy_level) selected @endif" data-level="{{ $i }}"></span>
                    @endfor                
                </div>
                <button type="submit" class="btn-custom btn-blue-inverse"><i class="far fa-save"></i>Sačuvaj energiju</button>
            </form>
        </div>
    </section>

    <script type="text/javascript">
        var activeLevel = @json($day->energy_level);

        $('.level').on('click', function() {
            $(this).addClass('selected');
            $(this).prevAll().addClass('selected');
            $(this).nextAll().removeClass('selected');

            value = $(this).data('level');
            var inputElement = $('input[name=energy_level]');
            inputElement.val(value);
        })
    </script>
@endsection
