@extends('layouts.app')

@section('app-content')
    <div class="container">
        <div style="border-top: solid purple 1px" class="mt-3">
            <form action="{{route('game.start')}}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="">Hoeveel spelers spelen er mee</label>
                    <input class="form-control" type="number" min="3" name="numberOfPlayers">
                </div>
                <div class="form-group">
                    <label for="">Hoeveel rondes willen jullie spelen</label>
                    <input class="form-control" type="number" min="3" name="numberOfRounds">
                </div>
                <button class="btn btn-primary" type="submit">Spelers aanmaken</button>
            </form>
        </div>
    </div>
@endsection
