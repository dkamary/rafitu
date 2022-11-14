{{-- New booking section --}}

<div class="row booking booking-new p-5">
    <div class="col-12 col-md-4 align-items-center d-flex px-6">
        <div class="title-container d-flex flex-column justify-content-center">
            <h2 class="order-2">Faites votre réservation</h2>
            <h3 class="order-1">A la recherche d'un covoiturage ?</h3>
            <h4 class="order-3">Nous vous proposons le trajet parfait parmi notre large choix de covoiturage à petits prix.</h4>
        </div>
    </div>
    <div class="col-12 col-md-8 px-6">
        @include('_partials.front.forms.booking')
    </div>
</div>
