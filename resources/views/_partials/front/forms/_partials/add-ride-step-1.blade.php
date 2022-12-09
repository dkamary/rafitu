{{-- Add ride - Step 1 --}}

@php
    $tomorrow = date('d/m/Y 08:00', strtotime('tomorrow'));
@endphp

<div class="tab-pane fade" id="first">
    <div class="control-group form-group">
        <div class="form-group position-relative">
            <label class="form-label text-dark">Départ</label>
            <input type="text" name="departure_label" id="departure_label" required data-form="#ride-form" required
                class="form-control required" placeholder="D'où partez-vous?">
            <input type="hidden" name="departure_lng" id="departure_lng" value="">
            <input type="hidden" name="departure_lat" id="departure_lat" value="">
        </div>
    </div>
    <div class="control-group form-group">
        <label class="form-label text-dark">Définir l'emplacement</label>
        <div class="ride-map" id="departure_map"></div>
    </div>
    <div class="control-group form-group">
        <div class="form-group">
            <label class="form-label text-dark">Date et heure de départ</label>
            <input type="datetime-local" name="departure_date" id="departure_date" class="form-control required Title"
            value="{{ $tomorrow }}" required
                placeholder="dd/mm/aaaa hh:mm">
        </div>
    </div>
    <div class="control-group form-group">
        <div class="text-end">
            <a href="#" id="next-2" class="btn btn-primary  mb-0 waves-effect waves-light">
                Continuer&nbsp;
                <i class="fa fa-arrow-right" aria-hidden="true"></i>
            </a>
        </div>
    </div>
</div>

@once

    @push('head')
        {{--  --}}

    @endpush

    @push('footer')
        <script id="step-1-script">

            (function($, window, document){
                $(function(){
                    console.debug("Step 1");

                    const btnDepart = document.querySelector('#depart');
                    if(btnDepart) {
                        btnDepart.click();
                        console.info('btnDepart click!');
                    }

                    $(document)
                    .on("click", "#next-2", e => {
                        e.preventDefault();
                        const $departureLabel = $("#departure_label");
                        const $departureLng = $("#departure_lng");
                        const $departureLat = $("#departure_lat");
                        const $departureDate = $("#departure_date");

                        if($departureLabel.val().trim().length == 0) {
                            alert("Veuillez renseigner la destination s'il vous plaît");
                            $departureLat
                                .addClass("border")
                                .addClass("border-danger");
                            return;
                        } else if($departureLabel.hasClass("border")) {
                            $departureLabel
                                .removeClass("border")
                                .removeClass("border-danger");
                        }
                        console.info("Le nom du point départ a été défini");

                        const position = {
                            lat: parseFloat($departureLat.val()),
                            lng: parseFloat($departureLng.val())
                        };

                        if(isNaN(position.lat) || position.lat == 0 || isNaN(position.lng) || position.lat == 0) {
                            alert("Veuillez sélectionner le nom d'un endroit en suggestion ou marquer le point de départ sur la carte");
                            return;
                        }

                        console.info("Les coordonnées géographiques ont été définies!");
                        console.info(position);

                        const dateParsed = Date.parse($departureDate.val());
                        console.debug({ dateParsed });
                        if(isNaN(dateParsed)) {
                            alert("Veuillez sélectionner une date valide");
                            return;
                        }

                        console.info("La date est bien définie!");
                        console.info({ date: $departureDate.val() });

                        document.querySelector("#arrive").click();
                    })
                    ;

                    // $.datetimepicker.setLocale('fr');
                    // datetimepickerFactory(document.querySelector('#departure_date'), );
                });
            }(window.jQuery, window, window.document));

        </script>
    @endpush
@endonce
