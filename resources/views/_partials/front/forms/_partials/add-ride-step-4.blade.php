{{-- Add Ride - Step 4 --}}

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
                    <input class="form-check-input" type="radio" name="recurrence" id="recurrence-yes" value="yes" onclick="document.querySelector('#weekdays').classList.remove('d-none');">
                    <label class="form-check-label" for="recurrence-yes">
                        Oui
                    </label>
                </div>

            </div>
            <div class="col-12 col-sm-4 col-md-2">

                <div class="form-check">
                    <input class="form-check-input" type="radio" name="recurrence" id="recurrence-no" value="no" onclick="document.querySelector('#weekdays').classList.add('d-none');">
                    <label class="form-check-label" for="recurrence-no">
                        Non
                    </label>
                </div>

            </div>
        </div>
    </div>

    <div class="control-group form-group d-none" id="weekdays">
        <div class="row mt-3">
            <div class="col-12">
                Quels sont les jours de la semaine où vous faites le trajet ?
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
        <div class="d-flex justify-content-between">
            <a href="#itineraire" data-bs-toggle="tab" class="btn btn-secondary bg-dark  mb-0 waves-effect waves-light" onclick="document.querySelector('#itineraire').click();">
                <i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;
                Revenir
            </a>
            <button type="submit" class="btn btn-primary  mb-0 waves-effect waves-light">
                <i class="fa fa-arrow-check" aria-hidden="true"></i>&nbsp;
                Publier votre trajet
            </button>
        </div>
    </div>

</div>
