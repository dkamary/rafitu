{{-- Add Ride form --}}

<form action="{{ route('ride_save') }}" id="ride-form" method="post" class="form-horizontal mb-0">
    <div id="rootwizard" class="border pt-0">
        <ul class="nav nav-tabs nav-justified">
            <li class="nav-item"><a href="#first" id="depart" data-bs-toggle="tab" class="nav-link font-bold">Départ</a></li>
            <li class="nav-item"><a href="#second" id="arrive" data-bs-toggle="tab" class="nav-link font-bold">Arrivée</a></li>
            <li class="nav-item"><a href="#third" id="itineraire" data-bs-toggle="tab" class="nav-link font-bold">Itinéraire</a></li>
            <li class="nav-item"><a href="#fourth" id="prix" data-bs-toggle="tab" class="nav-link font-bold">Prix</a></li>
        </ul>
        <div class="tab-content card-body mt-3 mb-0 b-0">
            @include('_partials.front.forms._partials.add-ride-step-1')

            @include('_partials.front.forms._partials.add-ride-step-2')

            @include('_partials.front.forms._partials.add-ride-step-3')

            @include('_partials.front.forms._partials.add-ride-step-4')
        </div>
    </div>
    @csrf
    <div id="itinerary-container" style="display: none;"></div>
</form>

@once

    @push('head')

        <style>
            .ride-map {
                width: 100%;
                height: 300px;
            }

            .autocomplete__container {
                display: none;
                position: absolute;
                width: 100%;
                transition: .8s;
                opacity: 0;
                height: 0px;
                box-shadow: 0px 5px 5px 0px rgba(0, 0, 0, .3);
                background-color: #ffffff;
                padding: 5px;
            }

            .autocomplete__container.show {
                display: flex;
                flex-direction: column;
                opacity: 1;
                height: auto;
                min-height: 2.5rem;
                justify-content: center;
            }
        </style>
    @endpush

    @push('footer')

        @include('_partials.front.forms._partials.scripts')

    @endpush

@endonce
