@if (is_array($successes) && count($successes) > 0)
<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <ul>
        @foreach ($successes as $success)
        <li>{{ $success }}</li>
        @endforeach
    </ul>
</div>
@endif
