{{-- Annulation de réservation --}}

@php
    $buttonOnly = $buttonOnly ?? false;
    $formCancelId = uniqid();
    $ride = $reservation->getRide();
@endphp

<form action="{{ route('reservation_cancel') }}" method="post" id="reservation-cancel-{{ $formCancelId }}">

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

@push('footer')
    <script>
        window.addEventListener('DOMContentLoaded', event => {
            const form = document.querySelector('#reservation-cancel-{{ $formCancelId }}');
            if(!form) {
                console.error("Unable to select #reservation-cancel-{{ $formCancelId }}");
                return;
            }

            const btn = form.querySelector('button[type="submit"]');
            if(!btn) {
                console.error("Unable to select the submit button!");
                return;
            }

            btn.addEventListener("click", e => {
                if(confirm("Voulez-vous annuler votre réservation `{{ $ride->departure_label }}` ?")) {
                    return true;
                } else {
                    e.preventDefault();
                    return false;
                }
            })
        });
    </script>
@endpush
