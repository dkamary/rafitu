{{-- Réservations --}}

<div class="card pt-4">
    <a href="{{ route('dashboard_reservations') }}" class="d-flex">
        <img src="{{ asset('images/checklist.png') }}" class="card-img-top w-90 mx-auto" alt="...">
    </a>
    <div class="card-body text-white bg-orange mt-4">
        <p class="card-text">
            Vous avez {{ $unpaids }} réservation(s) à régler
        </p>
    </div>
</div>
