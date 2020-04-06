@if(1 == $game->winner)
    <h4>{{$game->player1Name}} won!</h4>
@elseif(2 == $game->winner)
    <h4>{{$game->player2Name}} won!</h4>
@else
    <h4>{{$game->player1Name}} VS {{$game->player2Name}}</h4>
@endif
