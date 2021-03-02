@extends('layouts.app')

@section('title', 'Edit meal')

@section('content')
    <section class="form-section bg-green" id="meals-create">
        <div class="middle">
            <form action="{{ route('meals.update', ['id' => $meal->id]) }}" method="post">
                {{ csrf_field() }}
                <div class="title title-lg">{{ date('d.m.Y', strtotime($meal->day->date)) }}</div>
                <div class="form-group">
                    <label for="name">Naziv:</label>
                    <input type="text" name="name" class="form-control" placeholder="Naziv" value="{{ $meal->name }}" required>
                </div>
                <div class="form-group">
                    <label for="time">Vreme:</label>
                    <input type="time" name="time" class="form-control" value="{{ date('H:m', strtotime($meal->time)) }}" placeholder="Vreme">
                </div>
                <button type="submit" class="btn-custom btn-blue-inverse"><i class="far fa-save"></i>Sačuvaj obrok</button>
            </form>
        </div>
    </section>
@endsection

