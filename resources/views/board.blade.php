@extends('layouts.app')

@section('app-content')
    <div class="container text-center mt-5">
        <div class="row">
            <div class="col-12">
                <div class="card bg-white text-secondary">
                    <div class="card-body">
                        <form action="{{route('guess-number', ['gameId' => $gameId])}}" method="post">
                            {{ csrf_field() }}
                            @foreach($players as $player)
                                <label for="">{{$player->name}}</label>
                                <div class="form-group">
                                    <input class="form-group" type="text" name="{{$player->id}}">
                                </div>
                                @if (null !== $playerMessages)
                                    <span class="text-monospace">{{$playerMessages[$player->id]}}</span>
                                @endif
                            @endforeach
                            <button class="btn btn-primary" type="submit">Waag een gok</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
