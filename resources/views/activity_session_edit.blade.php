@extends('layouts.app')

@section('title', 'Create activity')

@section('content')
    <section class="form-section bg-red" id="activities-create">
        <div class="middle">
            <form action="{{ route('activities.sessions.update', ['id' => $activitySession->id]) }}" method="post">
                {{ csrf_field() }}
                <div class="title title-lg">{{ date('d.m.Y', strtotime($activitySession->day->date)) }}</div>
                <div class="form-group">
                    <label for="name">Naziv:</label>
                    <select name="activity_id" class="form-control" required>
                        <option>-- Izaberi aktivnost --</option>
                        @if($activities)
                            @foreach($activities as $activity)
                                <option value="{{ $activity->id }}" 
                                    @if($activity->id === $activitySession->activity_id)
                                        selected
                                    @endif
                                >
                                    {{ $activity->name }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="form-group">
                    <label for="duration">Trajanje:</label>
                    <input type="number" name="duration_hrs" step=".01" value="{{ $activitySession->duration_hrs }}" class="form-control">
                </div>
                <button type="submit" class="btn-custom btn-blue-inverse"><i class="far fa-save"></i>Sačuvaj aktivnost</button>
            </form>
        </div>
    </section>
@endsection


