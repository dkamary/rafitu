{{-- Search ride --}}

@php
    $origin = Request::get('origin');
    $origin_lat = Request::get('origin_lat');
    $origin_lng = Request::get('origin_lng');
    $destination = Request::get('destination');
    $destination_lat = Request::get('destination_lat');
    $destination_lng = Request::get('destination_lng');
    $search_date = Request::get('search_date');
    $search_count = Request::get('search_count');
    $withIcons = $withIcons ?? false;
@endphp

<form class="form form-search-ride-hero" action="{{ route('ride_search') }}" method="get">
    <div class="row mb-3">
        <div @class(['col-12', 'pin-icon' => $withIcons])>
            <label for="search_origin" class="form-label">Départ</label>
            <input type="search" name="origin" id="search_origin" class="form-control"
            value="{{ $origin }}"
                placeholder="Votre lieu de départ">
            <input type="hidden" name="origin_lat" id="search_origin_lat" value="{{ $origin_lat }}">
            <input type="hidden" name="origin_lng" id="search_origin_lng" value="{{ $origin_lng }}">
        </div>
    </div>
    <div class="row mb-3">
        <div @class(['col-12', 'pin-icon' => $withIcons])>
            <label for="search_destination" class="form-label">Arrivée</label>
            <input type="search" name="destination" id="search_destination" class="form-control"
            value="{{ $destination }}"
                placeholder="Votre lieu d'arrivée">
            <input type="hidden" name="destination_lat" id="search_destination_lat" value="{{ $destination_lat }}">
            <input type="hidden" name="destination_lng" id="search_destination_lng" value="{{ $destination_lng }}">
        </div>
    </div>
    <div class="row mb-3">
        <div @class(['col-6', 'calendar-icon' => $withIcons])>
            <label for="search_date" class="form-label">Date</label>
            <input type="date" name="search_date" id="search_date" value="{{ $search_date }}" placeholder="Date de départ" class="form-control">
        </div>
        <div @class(['col-6', 'user-icon' => $withIcons])>
            <label for="search_count" class="form-label">Passager</label>
            <input type="number" name="search_count" id="search_count" value="{{ $search_count }}" placeholder="Passager" min="1" max="7" class="form-control">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block" id="btn-search">
                <div class="d-flex justify-content-center align-items-center">
                    <i class="fa fa-search fa-2x" aria-hidden="true"></i>&nbsp;
                    Rechercher
                </div>
            </button>
        </div>
    </div>
    @csrf
</form>


@once

    @prepend('footer')

    <script id="hero-search-script">

        function initMap() {
            console.debug("Search Ride Hero Section script")

            autocompleteCity({
                selector: '#search_origin',
                src: 'google',
                onClick: ({ element, input }) => {
                    const selected = element;
                    const departureLat = document.querySelector('#search_origin_lat');
                    const departureLng = document.querySelector("#search_origin_lng");

                    console.debug({ selected });

                    console.debug({
                        msg: "departure position changed",
                        lat: selected.latitude,
                        lng: selected.longitude
                    });

                    departureLat.value = selected.latitude;
                    departureLng.value = selected.longitude;

                }
            });

            autocompleteCity({
                selector: '#search_destination',
                src: 'google',
                onClick: ({ element, input }) => {
                    const selected = element;
                    const arrivalLat = document.querySelector('#search_destination_lat');
                    const arrivalLng = document.querySelector("#search_destination_lng");

                    console.debug({ selected });

                    console.debug({
                        msg: "arrival position changed",
                        lat: selected.latitude,
                        lng: selected.longitude
                    });

                    arrivalLat.value = selected.latitude;
                    arrivalLng.value = selected.longitude;

                }
            });
        }

        window.initMap = initMap;

    </script>

    @endprepend

    @push('footer')

    <script defer async
        src="https://maps.googleapis.com/maps/api/js?key={{ Config::get('google.maps.api.key') }}&libraries=places&callback=initMap">
    </script>

    @endpush

    @push('head')

        <style id="search-styles">
            .pin-icon, .calendar-icon, .user-icon {
                position: relative;
            }

            .pin-icon::after,
            .calendar-icon::after,
            .user-icon::after {
                display: block;
                width: 1.5rem;
                height: 1.5rem;
                position: absolute;
                right: 5%;
                top: 52%;
                /* transform: translateY(-50%); */
                content: '';
                background-size: contain;
                background-repeat: no-repeat;
                background-position: center;
            }

            #search_origin::before {
                content: 'XXX';
                display: block;
                background: red;
            }

            .pin-icon::after {
                right: 2%;
                background-image: url({{ asset('assets/images/icons/marker-icon.svg') }});
            }

            .calendar-icon::after {
                background-image: url({{ asset('assets/images/icons/calendar-color-icon.svg') }});
            }

            .user-icon::after {
                background-image: url({{ asset('assets/images/icons/user-group.svg') }});
                right: 14%;
            }

        </style>

    @endpush
@endonce
