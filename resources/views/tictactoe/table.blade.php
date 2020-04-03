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
<div class="panel-body">
    <table class="table table-striped game-table">
        <tbody>
        @foreach (json_decode($table) as $row)
            <tr>
                @foreach ($row as $column)
                <td class="table-text">
                    @include('tictactoe.cell', ['val' => $column])
                </td>
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
