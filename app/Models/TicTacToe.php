<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicTacToe extends Model
{
    protected $table = 'tic_tac_toe';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'gameTable', 'winner', 'turn', 'player1Name', 'player2Name',
    ];


}
