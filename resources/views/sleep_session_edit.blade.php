@extends('layouts.app')

@section('title', 'Promeni san')

@section('content')
    <section class="form-section bg-blue" id="meals-create">
        <div class="middle">
            <div class="title title-lg">{{ date('d.m.Y', strtotime($sleepSession->day->date)) }}</div>
            <form action="{{ route('sleep.update', ['id' => $sleepSession->id]) }}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="start">Zaspao si:</label>
                    <input type="datetime-local" name="start" id="start" class="form-control" @if(isset($sleepSession->start)) value="{{  date('Y-m-d\TH:i:s', strtotime($sleepSession->start)) }}" @else value="{{ date('Y-m-d\TH:i:s', strtotime($defaultStart)) }}" @endif placeholder="Sleep session start">
                </div>
                <div class="form-group">
                    <label for="end">Probudio si se:</label>
                    <input type="datetime-local" name="end" id="end" class="form-control" @if(isset($sleepSession->end)) value="{{ date('Y-m-d\TH:i:s', strtotime($sleepSession->end)) }}" @else value="{{ date('Y-m-d\TH:i:s', strtotime($defaultEnd)) }}" @endif placeholder="Sleep session end">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn-custom btn-blue-inverse"><i class="fas fa-save"></i>Sačuvaj</button>
                </div>
            </form>
        </div>
    </section>
@endsection
