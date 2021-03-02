@extends('layouts.app')

@section('title', 'Create activity')

@section('content')
    <section class="form-section bg-red" id="activities-create">
        <div class="middle">
            <form action="{{ route('activities.sessions.store') }}" method="post">
                {{ csrf_field() }}
                <div class="title title-lg">{{ date('d.m.Y', strtotime($day->date)) }}</div>
                <input type="hidden" name="day_id" value="{{ $day->id }}">
                <div class="form-group">
                    <label for="name">Naziv:</label>
                    <select name="activity_id" class="form-control" required>
                        <option>-- Odaberi aktivnost --</option>
                        @if($activities)
                            @foreach($activities as $activity)
                                <option value="{{ $activity->id }}">{{ $activity->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="form-group">
                    <label for="duration">Trajanje (sati):</label>
                    <input type="number" name="duration_hrs" step=".01" value="1.30" class="form-control">
                </div>
                <button type="submit" class="btn-custom btn-blue-inverse"><i class="far fa-save"></i>Sačuvaj aktivnost</button>
            </form>
        </div>
    </section>
@endsection


