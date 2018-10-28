<div class="modal fade" id="{{$id}}">
    <div class="modal-dialog">
        <div class="modal-content">
            @if (isset($header))
            <div class="modal-header">
                <h4 class="modal-title">{{ $header }}</h4>
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            @endif

            <div class="modal-body">
                {{ $slot }}
            </div>

            @if (isset($footer))
            <div class="modal-footer">
                {{ $footer }}
            </div>
            @endif
        </div>
    </div>
</div>
