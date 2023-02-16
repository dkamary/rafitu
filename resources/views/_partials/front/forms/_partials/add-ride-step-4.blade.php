{{-- Add Ride - Step 4 --}}

@php
    $week1 = new \DateTime('now');
    $week1->modify('+7 days');

    $month1 = new \DateTime('now');
    $month1->modify('+1 month');

    $month3 = new \DateTime('now');
    $month3->modify('+3 months');

    $month6 = new \DateTime('now');
    $month6->modify('+6 months');

    $month12 = new \DateTime('now');
    $month12->modify('+12 months');
@endphp

<div class="tab-pane fade" id="fourth">

    <div class="control-group form-group">
        <div class="form-group">
            <label class="form-label text-dark">Prix par passager</label>
            <input type="number" name="price" class="form-control required Title" min="1" required max="100000" placeholder="">
        </div>
    </div>

    <div class="control-group form-group">
        <div class="form-group">
            <label for="" class="form-label text-dark">Faites-vous ce trajet souvent?</label>
            <div class="col-12 col-sm-4 col-md-2">

                <div class="form-check">
                    <input class="form-check-input" type="radio" name="recurrence" id="recurrence-yes" value="yes">
                    <label class="form-check-label" for="recurrence-yes">
                        Oui
                    </label>
                </div>

            </div>
            <div class="col-12 col-sm-4 col-md-2">

                <div class="form-check">
                    <input class="form-check-input" type="radio" name="recurrence" id="recurrence-no" value="no">
                    <label class="form-check-label" for="recurrence-no">
                        Non
                    </label>
                </div>

            </div>
        </div>
    </div>

    <div class="control-group form-group d-none" id="weekdays">
        <div class="row mt-3">
            <div class="col-12 mb-3">
                Quels sont les jours de la semaine où vous faites ce trajet ?
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                    <input type="checkbox" class="btn-check" name="lundi-check" id="lundi-check" autocomplete="off">
                    <label class="btn btn-outline-secondary" for="lundi-check">Lundi</label>

                    <input type="checkbox" class="btn-check" name="mardi-check" id="mardi-check" autocomplete="off">
                    <label class="btn btn-outline-secondary" for="mardi-check">Mardi</label>

                    <input type="checkbox" class="btn-check" name="mercredi-check" id="mercredi-check" autocomplete="off">
                    <label class="btn btn-outline-secondary" for="mercredi-check">Mercredi</label>

                    <input type="checkbox" class="btn-check" name="jeudi-check" id="jeudi-check" autocomplete="off">
                    <label class="btn btn-outline-secondary" for="jeudi-check">Jeudi</label>

                    <input type="checkbox" class="btn-check" name="vendredi-check" id="vendredi-check" autocomplete="off">
                    <label class="btn btn-outline-secondary" for="vendredi-check">Vendredi</label>

                    <input type="checkbox" class="btn-check" name="samedi-check" id="samedi-check" autocomplete="off">
                    <label class="btn btn-outline-secondary" for="samedi-check">Samedi</label>

                    <input type="checkbox" class="btn-check" name="dimanche-check" id="dimanche-check" autocomplete="off">
                    <label class="btn btn-outline-secondary" for="dimanche-check">Dimanche</label>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                Quand est-ce que vous allez arrêter de faire ce trajet?
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12 col-md-6">
                <input type="date" class="form-control" name="date-end" id="date-end" value="" min="{{ date('Y-m-d') }}" value="{{ $week1->format('Y-m-d') }}" autocomplete="off">
            </div>
        </div>
    </div>

    <div class="form-group row clearfix">
        <div class="col-lg-12">
            <div class="checkbox checkbox-info">
                <label class="custom-control mt-4 form-checkbox">
                    <input name="consent" type="checkbox" required class="custom-control-input" />
                    <span class="custom-control-label text-dark ps-2">J'accepte les termes et conditions</span>
                </label>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="d-flex flex-wrap justify-content-between step-4-buttons">
            <a href="#itineraire" data-bs-toggle="tab" class="btn btn-secondary bg-dark  mb-0 waves-effect waves-light my-2" onclick="document.querySelector('#itineraire').click();">
                <i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;
                Revenir
            </a>
            <button type="submit" class="btn btn-primary  mb-0 waves-effect waves-light my-2">
                <i class="fa fa-arrow-check" aria-hidden="true"></i>&nbsp;
                Publier votre trajet
            </button>
        </div>
    </div>

</div>


@once
    @push('header')
        <style>
            @media screen and (max-width: 576px) {
                .step-4-buttons .btn {
                    width: 100%;
                    max-width: 100%;
                }
            }
        </style>
    @endpush

    @push('footer')
        <script id="step-4-scripts">
            window.addEventListener("DOMContentLoaded", event => {
                const weekdays = document.querySelector('#weekdays');
                const dateEnd = document.querySelector("#date-end");

                const recurrenceYes = document.querySelector("#recurrence-yes");
                if(recurrenceYes) {
                    recurrenceYes.addEventListener("click", e => {
                        weekdays.classList.remove('d-none');
                        dateEnd.required = true;
                    });
                }

                const recurrenceNo = document.querySelector("#recurrence-no");
                if(recurrenceNo) {
                    recurrenceNo.addEventListener("click", e => {
                        weekdays.classList.add('d-none');
                        dateEnd.required = false;
                    });
                }
            });
        </script>
    @endpush
@endonce
