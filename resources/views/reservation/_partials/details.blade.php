{{-- détails réservation --}}

<div class="row my-4">
    <div class="col">
        Place(s) réservé(s) {{ $ride->passenger }} &times; <em>{{ $ride->price }}F CFA</em> &equals; <strong>{{ $ride->passenger * $ride->price }}F CFA</strong>
    </div>
</div>
