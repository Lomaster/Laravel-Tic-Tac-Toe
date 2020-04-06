@if (1 == $val)
    <div class="cell-val cell-val-x">X</div>
@elseif(2 == $val)
    <div class="cell-val cell-val-o">O</div>
@else
    <div class="cell-val cell-val-empty">
        @if (!$readOnly)
            <button type="button" data-play-id="{{ $buttonId }}" class="btn btn-primary play-button">X</button>
        @endif
    </div>
@endif
