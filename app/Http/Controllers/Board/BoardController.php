<?php

namespace App\Http\Controllers\Board;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BoardController extends Controller
{
    public function displayBoard(Request $request): view
    {
        $gameId = $request->session()->pull('game_id');
        $game = Game::query()->where(['id' => $gameId])->first();
        $players = $game->players;
        $playerMessages = $request->session()->pull('player_messages');
        return view('board', ['players' => $players, 'gameId' => $gameId, 'playerMessages' => $playerMessages ]);
    }

    public function guessNumber(int $gameId, Request $request)
    {
        $game = Game::query()->where(['id' => $gameId])->first();
        $luckNumber = $game->the_number_for_winners;
        $numbersGuessed = $request->except('_token');
        $playerMessage = [];
        $winner = null;
        foreach ($numbersGuessed as $playerId => $numberGuessed) {
            if ($numberGuessed > $luckNumber) {
                $playerMessage[$playerId] = 'lower';
                continue;
            }
            if ($numberGuessed < $luckNumber) {
                $playerMessage[$playerId] = 'higher';
                continue;
            }
            $winner = $playerId;
        }

        if (null === $winner) {
            return redirect()->route('board')->with(
                [
                    'game_id' => $gameId,
                    'player_messages'  => $playerMessage
                ]);
        }
        return redirect()->route('winner-screen')->with([
            'player_id' => $winner
        ]);
    }

    public function displayWinner(Request $request)
    {
        $playerId = $request->session()->pull('player_id');
        $player = Player::query()->where(['id' => $playerId])->first();
        if (null === $player) {
            return redirect()->route('start-screen');
        }
        return view('winner-screen', ['player' => $player]);
    }
}
