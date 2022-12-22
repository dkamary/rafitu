{{-- détails réservation --}}

<div class="row my-4">
    <div class="col fs-5">
        Place(s) réservé(s) {{ $reservation->passenger }} &times; <em>{{ $reservation->price }}F CFA</em> &equals; <strong>{{ $reservation->passenger * $reservation->price }}F CFA</strong>
    </div>
</div>
