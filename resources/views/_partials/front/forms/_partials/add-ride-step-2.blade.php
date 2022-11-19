{{-- Add Ride - Step 2 --}}

<div class="tab-pane fade" id="second">
    <div class="control-group form-group">
        <div class="form-group">
            <label class="form-label text-dark">Arrivée</label>
            <input type="text" name="arrival_label" id="arrival_label"
                class="form-control required Title place" placeholder="Où voulez-vous allez?">
            <input type="hidden" name="arrival_lng" id="arrival_lng" value="">
            <input type="hidden" name="arrival_lat" id="arrival_lat" value="">
        </div>
    </div>
    <div class="control-group form-group">
        <div class="mini-map" id="arrival_map"></div>
    </div>
    <div class="control-group form-group">
        <div class="form-group">
            <label class="form-label text-dark">Date et heure d'arrivée</label>
            <input type="datetime-local" name="arrival_date" class="form-control required Title"
                placeholder="">
        </div>
    </div>
    <div class="control-group form-group">
        <div class="d-flex justify-content-between">
            <a href="#second" data-bs-toggle="tab" class="btn btn-primary  mb-0 waves-effect waves-light" onclick="document.querySelector('#arrive').click();">Revenir</a>
            <a href="#itineraire" data-bs-toggle="tab" class="btn btn-primary  mb-0 waves-effect waves-light" onclick="document.querySelector('#itineraire').click();">Continuer</a>
        </div>
    </div>
</div>
