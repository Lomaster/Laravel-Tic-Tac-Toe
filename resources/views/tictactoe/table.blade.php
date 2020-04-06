<style type="text/css">
    .game-table {
        width: 200px;
        height: 200px;
    }
    .game-table tr:nth-child(2) {
        border: 2px #1d643b solid;
        border-left: 0;
        border-right: 0;
    }
    .game-table td:nth-child(2) {
        border: 2px #1d643b solid;
        border-top: 0;
        border-bottom: 0;
    }
    .cell-val {
        font-size: 12pt;
        font-weight: 200;
    }
    .cell-val-x {
        color: blueviolet;
    }
    .cell-val-o {
        color: darkgreen;
    }
</style>
<script>
    $(document).ready(function () {
        $('.play-button').on('click', function () {
            let id = $(this).data('play-id');
            $('#playerTurn').val(id);
            $('#gameTable').submit();
        });
    });
</script>
<div class="panel-body">
    <form id="gameTable" action="{{ url('tic-tac-toe/game/turn/'.$game->id) }}" method="POST">
        <input type="hidden" name="playerTurn" id="playerTurn" value="">
    {{ csrf_field() }}
    <table class="table table-striped game-table">
        <tbody>
        @foreach (json_decode($table) as $ir => $row)
            <tr>
                @foreach ($row as $ic => $column)
                <td class="table-text">
                    @include('tictactoe.cell', ['val' => $column, 'readOnly' => $readOnly, 'buttonId' => $ir . '_' . $ic])
                </td>
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>
    </form>
</div>
