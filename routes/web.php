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
});

Auth::routes();
//Default installer route
Route::get('/home', 'HomeController@index')->name('home');

//Quick intermediate start
Route::get('/tasks', 'TaskController@index');
Route::post('/task', 'TaskController@store');
Route::delete('/task/{task}', 'TaskController@destroy');

//Tic-tac-toe game
Route::get('/tic-tac-toe', 'TicTacToeController@selectGame');
Route::post('/tic-tac-toe', 'TicTacToeController@createGame');
Route::get('/tic-tac-toe/game/{game}', 'TicTacToeController@continueGame');
Route::post('/tic-tac-toe/game/turn/{game}', 'TicTacToeController@playerTurn');
