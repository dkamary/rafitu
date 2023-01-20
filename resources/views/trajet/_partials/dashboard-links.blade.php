{{-- Lien vers le détails --}}

<div class="row">
    <div class="col-12 d-flex justify-content-center align-items-center flex-wrap">

        <a href="{{ route('dashboard_reservation_show', ['reservation' => $reservation]) }}" class="btn btn-primary btn-xs mx-2 my-2">
            <i class="fa fa-eye" aria-hidden="true"></i>&nbsp;
            Voir les détails
        </a>

        @include('trajet.forms.reservation-cancel', ['reservation' => $reservation, 'btn_classes' => 'btn btn-danger btn-xs mx-2 my-2', 'buttonOnly' => true])

        @if(!$reservation->isPaid())
            @include('_partials.front.payment.choice', ['reservation' => $reservation, 'btn_classes' => 'btn btn-orange btn-xs mx-2 my-2', 'buttonOnly' => true])
        @endif

    </div>
</div>
