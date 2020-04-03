<?php

namespace App\Http\Controllers;

use App\Models\TicTacToe;
use App\Repositories\TicTacToeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class TicTacToeController extends Controller
{
    /**
     * TaskRepository.
     *
     * @var TicTacToeRepository
     */
    protected $games;

    /**
     * Создание нового экземпляра контроллера.
     *
     * @param  TicTacToeRepository  $tasks
     * @return void
     */
    public function __construct(TicTacToeRepository $games)
    {
        $this->middleware('auth');

        $this->games = $games;
    }

    /**
     * Показать список всех задач пользователя.
     *
     * @param  Request  $request
     * @return Response
     */
    public function selectGame(Request $request)
    {
        $games = $request->user()->tttGames()->get();

        return view('tictactoe.index', ['games' => $games,]);
    }

    /**
     * Create game
     *
     * @param  Request  $request
     * @return Response
     */
    public function createGame(Request $request)
    {
        $result = $request->user()->tttGames()->insertGetId([
            'table' => json_encode([[0,0,0],[0,0,0],[0,0,0]]),
            'winner' => 0,
        ]);

        return redirect('/tic-tac-toe/game/' . $result->id);
    }

    /**
     * Create game
     *
     * @param  Request  $request
     * @return Response
     */
    public function continueGame(Request $request, TicTacToe $game)
    {

        return view('tictactoe.game', ['game' => $game]);
    }

}
