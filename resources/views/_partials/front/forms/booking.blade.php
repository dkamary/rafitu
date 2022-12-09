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
                <input type="number" name="passager" id="passager" class="form-control rounded-pill" placeholder="Passager" value="1" required min="1" max="6">
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="my-3">
                <input type="text" name="arrival_address" id="arrival_address" class="form-control rounded-pill trajet-suggestion" data-form="#booking-form-match" data-field="arrival_label" placeholder="Adresse d'arrivée" value="" required>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-6">
            <div class="my-3">
                <input type="text" name="departure_address" id="departure_address" data-form="#booking-form-match" data-field="departure_label" class="form-control rounded-pill trajet-suggestion" placeholder="Adresse de départ" value="" required>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="my-3 input-group">
                <input type="date" name="departure_date" id="departure_date" class="form-control rounded-pill" placeholder="Date de départ" value="">
                <span class="input-group-text" id="departure_date_icon">
                    <i class="fa fa-calendar-o" aria-hidden="true"></i>
                </span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-6">
            <div class="my-3 input-group">
                <input type="time" name="time" id="departure_time" class="form-control rounded-pill" placeholder="Heure de départ" value=""  aria-label="Heure de départ" aria-describedby="departure_time_icon">
                <span class="input-group-text" id="basic-addon2">
                    <i class="fa fa-clock-o" aria-hidden="true"></i>
                </span>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="my-3">
                <button type="submit" class="btn btn-warning btn-block rounded-pill">
                    Réserver maintenant
                </button>
            </div>
        </div>
    </div>

    @csrf
</form>

@once
    @push('footer')

        <script>

            (function($, window, document){
                $(function(){

                    searchAutocomplete({
                        $,
                        selector: '#arrival_address',
                        url: "{{ route('suggestion_trajet') }}",
                        field: 'arrival_label'
                    });

                    searchAutocomplete({
                        $,
                        selector: '#departure_address',
                        url: "{{ route('suggestion_trajet') }}",
                        field: 'departure_label'
                    });

                });
            }(window.jQuery, window, window.document));
        </script>

    @endpush
@endonce
