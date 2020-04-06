<?php

namespace App\Http\Controllers;

use App\Games\TicTacToeGame;
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
    protected $oGame;

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
        $this->oGame = new TicTacToeGame();
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
        $result = $request->user()->tttGames()->create([
            'gameTable' => json_encode([[0,0,0],[0,0,0],[0,0,0]]),
            'winner' => 0,
            'player1Name' => $request->user()->name,
            'player2Name' => "Computer",
            'turn' => 1, //rand(1, 2)
        ]);

        return redirect('/tic-tac-toe/game/' . $result->id);
    }

    /**
     * Process player's turn
     *
     * @param  Request  $request
     * @return Response
     */
    public function playerTurn(Request $request, TicTacToe $game)
    {
        $aTable = json_decode($game->getAttribute('gameTable'), true);
        if (!($iWinner = $this->oGame->haveWinner($aTable))) {
            $sTurn = $request->input('playerTurn');
            $aTable = $this->oGame->processHumanTurn($aTable, $sTurn);
            if (!($iWinner = $this->oGame->haveWinner($aTable))) {
                $aTable = $this->oGame->processBotTurn($aTable);
                $iWinner = $this->oGame->haveWinner($aTable);
            }
            if ($iWinner) {
                $game->winner = $iWinner;
            }
            $game->gameTable = json_encode($aTable);
//        $game->turn = 1;
            $game->save();

        }

        return redirect('/tic-tac-toe/game/' . $game->id);
    }

    /**
     * Show created game
     *
     * @param  Request  $request
     * @return Response
     */
    public function continueGame(Request $request, TicTacToe $game)
    {
        $readOnly = 0;
        if ($game->winner) {
            $readOnly = 1;
        }

        return view('tictactoe.game', ['game' => $game, 'readOnly' => $readOnly]);
    }

}
