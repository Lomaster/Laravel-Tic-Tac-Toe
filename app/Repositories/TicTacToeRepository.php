<?php


namespace App\Repositories;

use App\User;

class TicTacToeRepository
{
    /**
     * Get a current game of the user
     *
     * @param  User  $user
     * @return Collection
     */
    public function forUser(User $user)
    {
        $aGames = $user->tttGames()
            ->orderBy('created_at', 'asc')
            ->get();
        return $aGames;
    }
}
