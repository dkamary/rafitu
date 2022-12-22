{{-- Page de détails d'un point géographique --}}

@extends('_layouts.front')

@php
    $title = $title ?? 'Détails sur l\'adresse';
@endphp

@section('meta_title')
    {{ $title }}
@endsection

@section('hero')
    @include('_partials.front.section.breadcrumbs', ['page_title' => $title])
@endsection

@section('main')
<div class="container-fluid" id="map"
    data-start_lat="{{ $ride->departure_position_lat }}"
    data-start_lng="{{ $ride->departure_position_long }}"
    data-start="{{ $ride->departure_position_lat }}, {{ $ride->departure_position_long }}"

    data-end_lat="{{ $ride->arrival_position_lat }}"
    data-end_lng="{{ $ride->arrival_position_long }}"
    data-end="{{ $ride->arrival_position_lat }}, {{ $ride->arrival_position_long }}"
>
    {{-- Map content --}}
</div>

<div class="container">
    <div class="row my-5">
        <div class="col-12 text-center">
            <a href="{{ route('ride_show', ['ride' => $ride]) }}" class="btn btn-primary">
                <i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;
                Revenir au détails du trajet
            </a>
        </div>
    </div>
</div>
@endsection

@once
    @push('head')
        <style id="point-details-style">
            #map {
                width: 100%;
                height: 90vh;
                background: asset('images/loader-1.svg')
                background-size: 2rem;
            }
        </style>
    @endpush
@endonce

@once
    @push('footer')
    <script defer>
        function displayItineraryMap() {
            console.warn("Ride Show Handle Map!");

            const map = document.querySelector('#map');
            if(!map) {
                console.debug("Il n'y a pas de map #map dans cette page");
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
                    lat: {{ $centerLat }},
                    lng: {{ $centerLng }}
                },
                zoom: 22,
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

            console.debug("Everything is done!");

            setTimeout(() => {
                mapRide.panTo({
                    lat: {{ $centerLat }},
                    lng: {{ $centerLng }}
                });
                mapRide.setCenter({
                    lat: {{ $centerLat }},
                    lng: {{ $centerLng }}
                });
                mapRide.setZoom(19);
                console.debug("Zoom and Center set!");
            }, 1000);
        }
    </script>
    <script defer async src="https://maps.googleapis.com/maps/api/js?key={{ Config::get('google.maps.api.key') }}&libraries=places&callback=displayItineraryMap"></script>

    @endpush
@endonce
