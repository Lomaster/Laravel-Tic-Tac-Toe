@extends('layouts.app')

@section('content')

    <div class="panel-body">
    @include('common.errors')

        <form action="{{ url('tic-tac-toe') }}" method="POST" class="form-horizontal">
        {{ csrf_field() }}
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-plus"></i> Crate a new game
                    </button>
                </div>
            </div>
        </form>
    </div>

<!--    Current games -->
    @if (count($games) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                Current games
            </div>

            <div class="panel-body">
                <table class="table table-striped games-list">

                    <thead>
                    <th>Table</th>
                    <th>&nbsp;</th>
                    </thead>

                    <!-- Games table -->
                    <tbody>
                    @foreach ($games as $game)
                        <tr>
                            <!-- Game table -->
                            <td class="table-text">
                                @include('tictactoe.table', ['table' => $game->table])
                            </td>

                            <!-- Button Continue -->
                            <td>
                                <form action="{{ url('tic-tac-toe/game/'.$game->id) }}" method="GET">
                                    {{ csrf_field() }}

                                    <button type="submit" id="continue-game-{{ $game->id }}" class="btn btn-primary">
                                        <i class="fa fa-btn fa-trash"></i>Continue
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

@endsection
