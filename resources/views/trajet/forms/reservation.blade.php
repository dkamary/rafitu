{{-- Réservation de trajet --}}

@php
    $user = Auth::user();
    $seatsAvailable = $ride->getSeatsAvailable();
    $dateDepart = $ride->getDateDeparture();
    $now = new \DateTime();
    $diff = $now->diff($dateDepart);
@endphp

@if($diff->invert == 0)
    @if($seatsAvailable < 1) <p class="text-center">
        <strong class='text-center text-danger'>Il n'y a plus de place disponible pour ce trajet</strong>
        </p>
        @else
        <form class="form" action="{{ route('reservation_submit') }}" method="post">
            @csrf
            <input type="hidden" name="ride_id" value="{{ $ride->id }}">
            <input type="hidden" name="user_id" value="{{ $user ? $user->id : 0 }}">
            <input type="hidden" name="price" id="price" value="{{ $ride->price }}">
            <input type="hidden" name="is_paid" value="0">
            <div class="row mt-4 mb-3">
                <label class="col-6 d-flex justify-content-end align-items-center">
                    Passager(s):
                </label>
                <div class="col-2">
                    <input class="form-control" type="number" name="passenger" id="passenger" min="1"
                        max="{{ $seatsAvailable }}" value="1"
                        placeholder="Il y a {{ $seatsAvailable }} place{{ $seatsAvailable > 1 ? 's' : '' }} de disponible"
                        required>
                </div>
                <div class="col-12 d-flex justify-content-center align-items-center fs-4 pt-2">
                    <span id="amount" class="fw-bold">{{ $ride->price }}</span>
                    <span id="currency">F CFA</span>
                </div>
            </div>
            <div class="row my-4">
                <div class="col-12 d-flex justify-content-center align-items-center">
                    <button type="submit" class="btn btn-primary d-inline-flex justify-content-center align-items-center px-5">
                        <i class="fa fa-check-circle fa-2x" aria-hidden="true"></i>&nbsp;
                        <span style="font-size: 1.2rem;">Réserver</span>
                    </button>
                </div>
            </div>
        </form>
    @endif
@else
    <p class="text-center">
        <strong class='text-danger'>
            Vous ne pouvez plus faire de réservation car la date de départ est déjà passée
        </strong>
    </p>
@endif


@once
    @push('footer')
        <script>
            window.addEventListener("DOMContentLoaded", event => {
                const passenger = document.querySelector("#passenger");
                if (passenger) {
                    passenger.addEventListener("click", e => {
                        const amount = {{ $ride->price }} * parseInt(passenger.value);
                        document.querySelector('#amount').innerHTML = amount;
                    });
                }
            });
        </script>
    @endpush
@endonce
