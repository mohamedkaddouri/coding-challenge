<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('start-screen');

Route::post('/game', [\App\Http\Controllers\Game\GameController::class, 'startGame'])->name('game.start');
Route::get('/set-up-game-players', [\App\Http\Controllers\Game\GameController::class, 'setUpGamePlayers'])
    ->name('setup-game-players');
Route::post('/add-players-to-game/{gameId}', [\App\Http\Controllers\Game\GameController::class, 'addPlayersToGame'])
    ->name('game.add-players-to-game');

Route::get('/board', [\App\Http\Controllers\Board\BoardController::class, 'displayBoard'])->name('board');
Route::post('/board/guess-number/{gameId}', [\App\Http\Controllers\Board\BoardController::class, 'guessNumber'])->name('guess-number');
Route::get('/winner-screen', [\App\Http\Controllers\Board\BoardController::class, 'displayWinner'])->name('winner-screen');
