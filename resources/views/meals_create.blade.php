@extends('layouts.app')

@section('title', 'Create meal')

@section('content')
    <section class="form-section bg-green" id="meals-create">
        <div class="middle">
            <form action="{{ route('meals.store') }}" method="post">
                {{ csrf_field() }}
                <div class="title title-lg">{{ date('d.m.Y', strtotime($day->created_at)) }}</div>
                <input type="hidden" name="day_id" value="{{ $day->id }}">
                <div class="form-group">
                    <label for="name">Naziv:</label>
                    <input type="text" name="name" class="form-control" placeholder="Naziv" required>
                </div>
                <div class="form-group">
                    <label for="time">Vreme:</label>
                    <input type="time" name="time" class="form-control" placeholder="Vreme" value="">
                </div>
                <button type="submit" class="btn-custom btn-blue-inverse"><i class="far fa-save"></i>Sačuvaj obrok</button>
            </form>
        </div>
    </section>
@endsection

