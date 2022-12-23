{{-- Réservations --}}

<div class="card pt-4">
    <a href="{{ route('dashboard_reservations') }}" class="d-flex">
        <img src="{{ asset('images/booking-calendar.png') }}" class="card-img-top w-90 mx-auto" alt="...">
    </a>
    <div class="card-body mt-4 text-white bg-secondary">
        <p class="card-text">
            Vous avez fait {{ $reservations }} réservation(s)
        </p>
    </div>
</div>
