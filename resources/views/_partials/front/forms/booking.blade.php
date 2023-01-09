{{-- Booking Form --}}

<form id="booking-form-match" action="{{ route('ride_match') }}" class="form booking-form" method="POST">

    <div class="row">
        <div class="col-12 col-md-6">
            <div class="my-3">
                <input type="text" name="fullname" id="fullname" class="form-control rounded-pill" placeholder="Votre nom" value="" >
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="my-3">
                <input type="email" name="email" id="email" class="form-control rounded-pill" placeholder="Adresse e-mail" value="" >
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-6">
            <div class="my-3">
                <input type="text" name="departure_address" id="departure_address" data-form="#booking-form-match" data-field="departure_label" class="form-control rounded-pill trajet-suggestion" placeholder="Adresse de départ" value="" required>
                <input type="hidden" name="origin_lat" id="booking_origin_lat">
                <input type="hidden" name="origin_lng" id="booking_origin_lng">
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="my-3">
                <input type="text" name="arrival_address" id="arrival_address" class="form-control rounded-pill trajet-suggestion" data-form="#booking-form-match" data-field="arrival_label" placeholder="Adresse d'arrivée" value="" required>
                <input type="hidden" name="destination_lat" id="booking_destination_lat">
                <input type="hidden" name="destination_lng" id="booking_destination_lng">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-6">
            <div class="my-3 input-group">
                <input type="date" name="departure_date" id="departure_date" class="form-control rounded-pill" placeholder="Date de départ" value="">
                <span class="input-group-text" id="departure_date_icon">
                    {{-- <i class="fa fa-calendar-o" aria-hidden="true"></i> --}}
                    <img src="{{ asset('assets/images/icons/calendar-color-icon.svg') }}" alt="" style="height: 1.5rem; width: auto;">
                </span>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="my-3 input-group">
                <input type="time" name="time" id="departure_time" class="form-control rounded-pill" placeholder="Heure de départ" value=""  aria-label="Heure de départ" aria-describedby="departure_time_icon">
                <span class="input-group-text" id="basic-addon2">
                    {{-- <i class="fa fa-clock-o" aria-hidden="true"></i> --}}
                    <img src="{{ asset('assets/images/icons/pending-clock-icon.svg') }}" alt="" style="height: 1.5rem; width: auto; cursor: pointer;" onclick="document.querySelector('#departure_time').showPicker();">
                </span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-6">
            <div class="my-3">
                <input type="number" name="passager" id="passager" class="form-control rounded-pill" placeholder="Passager" value="1" required min="1" max="6">
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="my-3">
                <button type="submit" class="btn btn-orange btn-block rounded-pill fw-bold text-uppercase">
                    Réserver maintenant
                </button>
            </div>
        </div>
    </div>

    @csrf
</form>

@once

    @push('head')

        <style id="booking-styles">
            #departure_date_icon {
                cursor: pointer;
            }
        </style>

    @endpush

    @push('footer')

        <script>

            window.addEventListener("DOMContentLoaded", event => {

                autocompleteCity({
                    selector: "#arrival_address",
                    // src: "{{ route('suggestion_trajet') }}",
                    src: "google",
                    field: "arrival_label",
                    onClick: ({ element, input }) => {
                        const selected = element;
                        const arrivalLat = document.querySelector('#booking_destination_lat');
                        const arrivalLng = document.querySelector("#booking_destination_lng");

                        console.debug({ selected });

                        console.debug({
                            msg: "arrival position changed",
                            lat: selected.latitude,
                            lng: selected.longitude
                        });

                        arrivalLat.value = selected.latitude;
                        arrivalLng.value = selected.longitude;

                        console.debug({
                            lat: arrivalLat.value,
                            lng: arrivalLng.value
                        })

                    }
                });

                autocompleteCity({
                    selector: "#departure_address",
                    // src: "{{ route('suggestion_trajet') }}",
                    src: "google",
                    field: "departure_label",
                    onClick: ({ element, input }) => {
                        const selected = element;
                        const departureLat = document.querySelector('#booking_origin_lat');
                        const departureLng = document.querySelector("#booking_origin_lng");

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

                const calendar = document.querySelector('#departure_date_icon');
                if(calendar) {
                    calendar.addEventListener('click', e => {
                        e.preventDefault();
                        const input = document.querySelector('#booking-form-match #departure_date');
                        if(input) {
                            input.showPicker();
                            console.debug("'#booking-form-match #departure_date' clicked!");
                        } else {
                            console.warn("Unable to select `#booking-form-match #departure_date`!");
                        }
                    })
                } else {
                    console.warn("Unable to select `#departure_date_icon`!");
                }

            });

        </script>

    @endpush
@endonce
