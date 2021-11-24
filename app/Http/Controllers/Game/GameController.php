<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\GameSession;
use App\Models\Player;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

//use Illuminate\Http\Client\Request;

class GameController extends Controller
{
    private const SESSION_GAME_NAME = 'GAME_SESSION';
    public function startGame(Request $request): RedirectResponse
    {
        $game = new Game();
        $game->status = 'started';
        $game->the_number_for_winners = random_int(1, 100);
        $game->save();

        $gameSession = new GameSession();
        $gameSession->game_id = $game->id;
        $gameSession->save();

        $numberOfPlayers = (int) $request->get('numberOfPlayers');
        return redirect()->route('setup-game-players')->with(
            [
                'game_session_id' => $gameSession->id,
                'number_of_players' => $numberOfPlayers
            ]);
    }

    public function setUpGamePlayers(Request $request)
    {
        $gameSession = GameSession::query()->where(['id' => $request->session()->pull('game_session_id')])->first();
        $game = $gameSession->game;
        $numberOfPlayers = $request->session()->pull('number_of_players');
        return view('game-setup', ['numberOfPlayers' => $numberOfPlayers, 'gameId' => $game->id]);
    }

    public function addPlayersToGame(int $gameId, Request $request): RedirectResponse
    {
        $game = Game::query()->where(['id' => $gameId])->first();

        $playerNames = $request->except('_token');
        foreach ($playerNames as $playerName) {
            $player = new Player();
            $player->name = $playerName;
            $player->game_id = $game->id;
            $player->save();
        }
        return redirect()->route('board')->with([
            'game_id' => $game->id
        ]);
    }
}
