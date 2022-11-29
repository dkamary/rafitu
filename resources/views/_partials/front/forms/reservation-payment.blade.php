{{-- Paiement réservation --}}

<form class="form" action="{{ route('pay_reservation') }}" method="post">
    <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">
    <input type="hidden" name="user_id" value="{{ $user ? $user->id : 0 }}">
    <div class="row">
        <div class="col-12 d-flex justify-content-center align-items-center">
            <button type="submit" class="btn btn-primary">
                Procéder au paiement
            </button>
        </div>
    </div>
    @csrf
</form>
