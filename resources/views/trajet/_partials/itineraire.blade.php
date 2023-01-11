{{-- Itinéraire --}}

<div class="col-12 my-3">
    <h6 class="fs-5 fw-bold">{{ $title ?? 'Itinéraire' }}</h6>
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
        <script defer>
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

    @endpush
@endonce
