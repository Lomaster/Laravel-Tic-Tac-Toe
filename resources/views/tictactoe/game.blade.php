@extends('layouts.app')

@section('content')
    <div class="panel-body">
    @include('common.errors')
        <div class="panel panel-default">
            @include('tictactoe.table', ['table' => $game->table])
        </div>
        <form action="{{ url('tic-tac-toe') }}" method="GET" class="form-horizontal">
            {{ csrf_field() }}
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-plus"></i> Back to main
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
