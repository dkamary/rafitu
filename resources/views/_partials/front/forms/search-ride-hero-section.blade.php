{{-- Search ride hero section --}}

@php
    $now = new \DateTime();
@endphp

    <form id="form-search-ride-hero" action="{{ route('ride_search') }}" method="GET"
        class="form row g-0 form-search-ride-hero">
        <div class="form-group  col-xl-3 col-lg-3 col-md-12 mb-0 bg-white ">
            <input type="text" class="form-control input-lg br-te-md-0 br-be-md-0 border-end-0 place-suggestion"
                name="origin" id="search_origin" placeholder="Départ" data-form="#form-search-ride-hero">
            <span><img src="{{ asset('assets/images/icons/marker-icon.svg') }}" alt="" class="location-gps"></span>
            <input type="hidden" name="origin_lat" id="search_origin_lat">
            <input type="hidden" name="origin_lng" id="search_origin_lng">
        </div>
        <div class="form-group  col-xl-3 col-lg-3 col-md-12 mb-0 bg-white">
            <input type="text" class="form-control input-lg br-md-0 border-end-0 place-suggestion" name="destination"
                id="search_destination" placeholder="Destination" data-form="#form-search-ride-hero">
            <span><img src="{{ asset('assets/images/icons/marker-icon.svg') }}" alt="" class="location-gps"></span>
            <input type="hidden" name="destination_lat" id="search_destination_lat">
            <input type="hidden" name="destination_lng" id="search_destination_lng">
        </div>
        <div class="form-group col-xl-3 col-lg-3 col-md-10 col-sm-8 col-12 select2-lg  mb-0 bg-white">
            <input type="date" class="form-control input-lg br-md-0 border-end-0" name="search_date" id="search_date"
                placeholder="Aujourd'hui" min="{{ $now->format('d/m/Y') }}">
            <span>
                <img src="{{ asset('assets/images/icons/calendar-color-icon.svg') }}" alt="" class="location-gps" onclick="document.querySelector('#search_date').click();">
            </span>
        </div>
        <div class="form-group col-xl-1 col-lg-1 col-md-2 col-sm-4 col-12 select2-lg  mb-0 bg-white">
            {{-- <span><i class="fa fa-user location-gps me-1"></i></span> --}}
            <input type="number" class="form-control input-lg br-md-0 border-end-0" name="search_count" id="search_count"
                placeholder="1" value="1" min="1" max="7">
        </div>
        <div class="col-xl-2 col-lg-2 col-md-12 mb-0">
            <button type="submit" class="btn btn-lg btn-block btn-primary br-ts-md-0 br-bs-md-0">
                <span>
                    <i class="fa fa-search" aria-hidden="true"></i>
                    {{-- <img src="{{ asset('assets/images/icons/search-location.svg') }}" alt="" style="height: 1.5rem; width: auto;"> --}}
                </span>
            </button>
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

@endonce
