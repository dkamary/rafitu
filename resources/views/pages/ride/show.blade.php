{{-- Afficher les détails d'un trajet --}}

@extends('_layouts.front')

@php
    $status = $ride->getStatus();
    $rideOptions = [
        'ride' => $ride,
        'loop' => json_decode('{"even": "false"}'),
        'showPrice' => false,
        'showDetails' => false,
        'showDate' => false,
        'showIcon' => false,
        'showDriver' => false,
    ];
    $driver = $ride->getDriver();
    $user = Auth::user();
    $seatsAvailable = $ride->getSeatsAvailable();
    $dateDepart = $ride->getDateDeparture();
    $now = new \DateTime();
    $diff = $now->diff($dateDepart);

@endphp

@section('meta_title')
    Détails Trajet
@endsection

@section('hero')
    @include('_partials.front.section.breadcrumbs', ['page_title' => 'Détails Trajet'])
@endsection

@section('main')
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-12 mx-auto bg-white my-5 py-3">
                <div class="row">
                    <div class="col-12 text-center">
                        <h2>{{ DateManager::dateFr($dateDepart) }}</h2>
                    </div>
                </div>
                <div class="row border-top border-bottom mt-3 py-3">
                    <div class="col-12 text-center text-info fs-5">
                        @if($status)
                            {{ $status->label }}
                        @else
                            Planifié
                        @endif
                    </div>
                </div>
                <div class="row py-3">
                    <div class="col-12">
                        @include('pages._partials.ride.element', $rideOptions)
                    </div>
                    <div class="col-12 my-3">
                        {{-- <a href="#" id="show-map" class="btn btn-secondary btn-xs">Voir l'itinéraire</a> --}}
                        <h6>Itinéraire</h6>
                        <div class="row">
                            <div class="col-12 my-4 show" id="ride-itinerary-map"
                                data-start_lat="{{ $ride->departure_position_lat }}"
                                data-start_lng="{{ $ride->departure_position_long }}"
                                data-start="{{ $ride->departure_position_lat }}, {{ $ride->departure_position_long }}"

                                data-end_lat="{{ $ride->arrival_position_lat }}"
                                data-end_lng="{{ $ride->arrival_position_long }}"
                                data-end="{{ $ride->arrival_position_lat }}, {{ $ride->arrival_position_long }}"
                            >
                                {{--  --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row border-top border-bottom mt-3 py-3">
                    <div class="col-12 d-flex justify-content-between">
                        <span>Prix</span>
                        <h3><strong>{{ $ride->price }}</strong> F CFA / Passager</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 py-5">
                        @include('pages._partials.ride.driver', ['ride' => $ride])
                    </div>
                </div>


                <div class="row my-3 py-5 d-flex justify-content-between">
                    @if ($ride->woman_only == 1)
                    <div class="col">
                        <span class="text-info fw-bold">
                            <img src="{{ asset('assets/images/icons/woman-group.svg') }}" alt="" class="indicator-icon"> &nbsp;
                            Pour femme uniquement
                        </span>
                    </div>
                    @endif

                    <div class="col">
                        <span class="text-info fw-bold">
                            @if ($ride->smokers == 1)
                                <img src="{{ asset('assets/images/icons/smoking-area-icon.svg') }}" alt="Fumeurs" class="indicator-icon">&nbsp;
                                Fumeurs autorisés
                            @else
                                <img src="{{ asset('assets/images/icons/no-smoking-area-icon.svg') }}" alt="Non-fumeurs" class="indicator-icon">&nbsp;
                                Non fumeurs
                            @endif
                        </span>
                    </div>

                    <div class="col">
                        <span class="text-info fw-bold">
                            @if ($ride->animals == 1)
                                <img src="{{ asset('assets/images/icons/pets-allowed-icon.svg') }}" alt="Animaux autorisés" class="indicator-icon">&nbsp;
                                Animaux autorisés
                            @else
                                <img src="{{ asset('assets/images/icons/no-pets-allowed-icon.svg') }}" alt="Animaux non autorisés" class="indicator-icon">&nbsp;
                                Animaux non autorisés
                            @endif
                        </span>
                    </div>

                </div>

                <div class="row border-top mt-3 py-3">
                    <div class="col-12">
                        @if ($ride->driver_id == $user->id || $ride->owner_id == $user->id)
                            <p class="text-warning text-center fw-bold fs-6 mt-4">
                                Vous ne pouvez-pas réserver un trajet dont vous êtes le propriétaire / chauffeur!
                            </p>
                        @elseif($diff->invert == 0)
                            @if($seatsAvailable < 1)
                                <p class="text-center">
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
                                    <label class="col-12 col-md-3 d-flex align-items-end">
                                        Passager(s):
                                    </label>
                                    <div class="col-6 col-md-2">
                                        <input class="form-control" type="number" name="passenger" id="passenger" min="1" max="{{ $seatsAvailable }}" value="1" placeholder="Il y a {{ $seatsAvailable }} place{{ $seatsAvailable > 1 ? 's' : '' }} de disponible" required>
                                    </div>
                                    <div class="col-6 col-md-3 d-flex justify-content-start align-items-center fs-4">
                                        <span id="amount" class="fw-bold">{{ $ride->price }}</span>
                                        <span id="currency">F CFA</span>
                                    </div>
                                </div>
                                <div class="row my-4">
                                    <div class="col-12 d-flex justify-content-center align-items-center">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-check-circle fa-2x" aria-hidden="true"></i>&nbsp;
                                            Réserver
                                        </button>
                                    </div>
                                </div>
                            </form>
                            @endif
                        @else
                        <p class="text-center">
                            <strong class='text-danger'>Vous ne pouvez plus faire de réservation car la date de départ est déjà passée</strong>
                        </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@once
    @push("head")
        <style>
            #ride-itinerary-map {
                transition: 1s;
                width: 100%;
                height: 0px;
                opacity: 0;
            }

            #ride-itinerary-map.show {
                opacity: 1;
                height: 500px;
            }

            #show-map {
                transition: 1s;
                opacity: 1;
                overflow: hidden;
            }

            #show-map.hide {
                opacity: 0;
                height: 0;
            }
        </style>
    @endpush

    @push('footer')
        <script defer id="ride-show-script">
            function displayItineraryMap() {
                console.warn("Ride Show Handle Map!");

                const map = document.querySelector('#ride-itinerary-map');
                if(!map) {
                    console.debug("Il n'y a pas de map #ride-itinerary-map dans cette page");
                    return;
                }

                let currentLat = 0.0;
                let currentLng = 0.0;
                if (navigator.geolocation) {
                    console.debug("Geolocation disponible!");

                    navigator.geolocation.getCurrentPosition(
                        (position) => {
                            currentLat = position.coords.latitude;
                            currentLng = position.coords.longitude;
                        },
                        () => {
                            console.debug("Error geolocation!");
                        }
                    );
                } else {
                    console.console.warn("Geolocation non disponible!!!");
                }

                console.debug("Displaying Itinerary Map");
                const mapDefaultOptions = {
                    center: {
                        lat: currentLat,
                        lng: currentLng
                    },
                    zoom: 14,
                };
                const mapRide = new google.maps.Map(map, mapDefaultOptions);

                const start = map.dataset.start;
                const end = map.dataset.end;

                console.debug({start, end});

                console.debug("Render Initinerary");
                let directionService = new google.maps.DirectionsService();
                let directionRenderer = new google.maps.DirectionsRenderer();
                directionRenderer.setMap(mapRide);
                const request = {
                    origin: start,
                    destination: end,
                    travelMode: 'DRIVING'
                };
                console.debug(request);
                directionService.route(request, (response, status) => {
                    if (status == 'OK') {
                        directionRenderer.setDirections(response);
                        console.debug(response);
                    }
                });

                console.debug("Define Bounds");
                let bounds = new google.maps.LatLngBounds();
                console.debug({
                    start: 'lat: ' + parseFloat(map.dataset.start_lat) + ', lng: ' + parseFloat(map.dataset.start_lng),
                    end: 'lat: ' + parseFloat(map.dataset.end_lat) + ', lng: ' + parseFloat(map.dataset.end_lng)
                });
                bounds.extend({ lat: parseFloat(map.dataset.start_lat), lng: parseFloat(map.dataset.start_lng) });
                bounds.extend({ lat: parseFloat(map.dataset.end_lat), lng: parseFloat(map.dataset.end_lng) });
                mapRide.fitBounds(bounds);
                mapRide.setZoom(16);

                console.debug("Everything is done!");
            }
        </script>
        <script defer async src="https://maps.googleapis.com/maps/api/js?key={{ Config::get('google.maps.api.key') }}&libraries=places&callback=displayItineraryMap"></script>

        <script>
            window.addEventListener("DOMContentLoaded", event => {
                document.querySelector('#messenger').addEventListener("click", e => {
                    e.preventDefault();
                    alert("Fonctionalité de messagerie bientôt disponible!");
                });

                /*const passager = document.querySelector("#passenger");
                if(passager) {
                    passager.addEventListener("change", e => {
                        e.preventDefault();
                        calcul({
                            count: passager.value,
                            price: {{ $ride->price }}
                        });
                    });
                }*/

                const calcul = ({ count, price }) => {
                    console.debug("Calcul montant");

                    const value = parseFloat(count) * parseFloat(price);

                    console.debug({ value });

                    document.querySelector('#amount').innerHTML = value;
                };
            });
        </script>
    @endpush
@endonce
