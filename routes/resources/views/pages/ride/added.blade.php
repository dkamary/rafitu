{{-- Add Ride --}}

@extends('_layouts.front')

@section('meta_title')
    Votre trajet est publié
@endsection

@section('hero')
    @include('_partials.front.section.breadcrumbs', ['page_title' => 'Votre trajet est publié'])
@endsection

@section('main')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card mt-4">
                    <div class="card-body h-100">
                        <div class="border-0">
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab-51">
                                    <div id="profile-log-switch">
                                        <div class="media-heading">
                                            <h5><strong>Information sur votre trajet</strong></h5>
                                        </div>
                                        <div class="table-responsive ">
                                            <table class="table row table-borderless mt-3">
                                                <tbody class="col-lg-12 col-xl-6 p-0">
                                                    <tr>
                                                        <td><strong>Départ :</strong></td>
                                                        <td class="txt-rafitu">{{ $ride->departure_label }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Date et heure de départ :</strong></td>
                                                        <td class="txt-rafitu">{{ $ride->getDepartureDate() }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Arrivée :</strong></td>
                                                        <td class="txt-rafitu">{{ $ride->arrival_label }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Date et heure d'arrivée :</strong></td>
                                                        <td class="txt-rafitu">
                                                            @if($ride->hasArrivalDate())
                                                            {{  $ride->getArrivalDate() }}
                                                            @else
                                                            <em class="text-dark-50">Non définie</em>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="row profie-img mt-5">
                                            <div class="col-md-12 text-justify">
                                                <div class="media-heading">
                                                    <h5><strong>Détails</strong></h5>
                                                </div>
                                                <table class="table row table-borderless mt-3">
                                                    <tbody class="col-lg-12 col-xl-6 p-0">
                                                        <tr>
                                                            <td><strong>Tarif :</strong></td>
                                                            <td class="txt-rafitu">{{ $ride->price }}F CFA</td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Nombre de sièges disponible:</strong></td>
                                                            <td class="txt-rafitu">{{ $ride->seats_available }}</td>
                                                        </tr>
                                                        @if($ride->woman_only)
                                                        <tr>
                                                            <td colspan="2">
                                                                <strong class="text-info">Trajet pour femme uniquement</strong>
                                                            </td>
                                                        </tr>
                                                        @endif
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                        <div class="row mt-5">
                                            <div class="col-12">
                                                <div class="media-heading">
                                                    <h5><strong>Itinéraire</strong></h5>
                                                </div>
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
                                        <div class="row mt-5">
                                            <div class="col-12 text-center">

                                                <a href="{{ route('ride_add') }}" class="btn btn-primary">
                                                    Ajouter un autre trajet
                                                </a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
    <script defer async>
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
    <script defer async
        src="https://maps.googleapis.com/maps/api/js?key={{ Config::get('google.maps.api.key') }}&libraries=places&callback=displayItineraryMap">
    </script>
    @endpush
@endonce
