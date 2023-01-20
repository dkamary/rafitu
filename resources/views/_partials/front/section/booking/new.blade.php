{{-- New booking section --}}

<div class="row booking booking-new p-5">
    <div class="col-12 col-sm-12 col-lg-4 align-items-center d-flex">
        <div class="title-container d-flex flex-column justify-content-center text-md-center text-start">
            <h2 class="order-2">Faites votre réservation</h2>
            <h3 class="order-1">A la recherche d'un covoiturage ?</h3>
            <h4 class="order-3">Nous vous proposons le trajet parfait parmi notre large choix de covoiturage à petits prix.</h4>
        </div>
    </div>
    <div class="col-12 col-sm-12 col-lg-8 px-0 px-md-6">
        @include('_partials.front.forms.booking')
    </div>
</div>

@once

    @push('head')
    <style id="booking-new-additional-style">
        @media screen and (max-width: 576px) {
            .booking.booking-new .title-container h2 {
                font-size: 48px;
                text-align: center;
            }

            .booking.booking-new .title-container h3 {
                font-size: 16px;
                text-align: center;
                margin-bottom: 1rem;
            }

            .booking.booking-new .title-container h4 {
                font-size: 16px;
                text-align: center;
            }
        }
    </style>
    @endpush

@endonce
