{{-- Add Ride - Step 3 --}}

<div class="tab-pane fade" id="third">
    <div class="control-group form-group">
        <div class="form-group">
            <label class="form-label text-dark">Votre itinéraire</label>
            <div class="mini-map" id="itinerary_map"></div>
        </div>
    </div>
    <div class="control-group form-group">
        <div class="form-group">
            <label class="form-label text-dark">Distance: <span id="distance_display">0.0 Km</span> </label>
            <input type="hidden" name="distance" id="distance" value="0">
        </div>
    </div>
    <div class="control-group form-group">
        <div class="form-group">
            <label class="form-label text-dark">Durée: <span id="duration_display">0.0 Km</span> </label>
            <input type="hidden" name="duration" id="duration" value="0">
        </div>
    </div>
    <div class="control-group form-group">
        <div class="form-group">
            <label class="form-label text-dark">Passager</label>
            <input type="number" name="seats_available" class="form-control Title" min="1"
                value="1"
                max="7" placeholder="">
        </div>
    </div>
    <div class="control-group form-group">
        <div class="form-group">
            <label class="form-label text-dark">Femme seulement</label>
            <input type="checkbox" name="woman_only" class="">
        </div>
    </div>
    <div class="form-group">
        <label class="form-label text-dark">Votre véhicule</label>
        <select name="vehicule_id" class="form-control form-select required category select2">
            <option value="0">Choisir parmi la liste</option>
            @foreach ($vehicules as $item)
                <option value="{{ $item->id }}">{{ $item->getName() }}</option>
            @endforeach
        </select>
    </div>
    <div class="control-group form-group">
        <div class="d-flex justify-content-between">
            <a href="#itineraire" data-bs-toggle="tab" class="btn btn-secondary bg-dark  mb-0 waves-effect waves-light" onclick="document.querySelector('#itineraire').click();">
                <i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;
                Revenir
            </a>
            <a href="#prix" data-bs-toggle="tab" class="btn btn-primary  mb-0 waves-effect waves-light" onclick="document.querySelector('#prix').click();">
                <i class="fa fa-arrow-right" aria-hidden="true"></i>&nbsp;
                Continuer
            </a>
        </div>
    </div>
</div>
