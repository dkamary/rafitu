{{-- Annulation de réservation --}}

@php
    $buttonOnly = $buttonOnly ?? false;
@endphp

<form action="{{ route('reservation_cancel') }}" method="post">

    @if($buttonOnly)

        <button type="submit" class="{{ $btn_classes ?? 'btn btn-danger' }}">
            <i class="fa fa-times" aria-hidden="true"></i>&nbsp;
            {{ $btn_text ?? 'Annuler' }}
        </button>

    @else

        <div class="row">
            <div class="col-12 text-center">
                <button type="submit" class="{{ $btn_classes ?? 'btn btn-danger' }}">
                    <i class="fa fa-times" aria-hidden="true"></i>&nbsp;
                    {{ $btn_text ?? 'Annuler' }}
                </button>
            </div>
        </div>
    @endif

    <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">
    @csrf
</form>
