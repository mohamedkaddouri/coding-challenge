@extends('layouts.app')

@section('app-content')
    <div class="container">
        <div style="border-top: solid purple 1px" class="mt-3">
            <form action="{{route('game.add-players-to-game', ['gameId' => $gameId])}}" method="post">
                {{ csrf_field() }}
                @for($i = 0; $i < $numberOfPlayers; ++$i)
                    <div class="form-group">
                        <label for="">{{ "Naam van player " . $i+1 }}</label>
                        <input class="form-control" type="text" name="player_name_{{$i}}">
                    </div>
                @endfor
                <button class="btn btn-primary" type="submit">Start het spel</button>
            </form>
        </div>
    </div>
@endsection
