{{-- Add ride - Step 1 --}}

@php
    $tomorrow = date('Y-m-d', strtotime('tomorrow'));
@endphp

<div class="tab-pane fade" id="first">
    <div class="control-group form-group">
        <div class="form-group">
            <label class="form-label text-dark">Départ</label>
            <input type="text" name="departure_label" id="departure_label"
                class="form-control required Title place" placeholder="D'où partez-vous?">
            <input type="hidden" name="departure_lng" id="departure_lng" value="">
            <input type="hidden" name="departure_lat" id="departure_lat" value="">
        </div>
    </div>
    <div class="control-group form-group">
        <label class="form-label text-dark">Définir l'emplacement</label>
        <div class="mini-map" id="departure_map"></div>
    </div>
    <div class="control-group form-group">
        <div class="form-group">
            <label class="form-label text-dark">Date et heure de départ</label>
            <input type="datetime-local" name="departure_date" class="form-control required Title"
            value="{{ $tomorrow }}"
                placeholder="dd/mm/aaaa hh:mm">
        </div>
    </div>
    <div class="control-group form-group">
        <div class="text-end">
            <a href="#second" data-bs-toggle="tab" class="btn btn-primary  mb-0 waves-effect waves-light" onclick="document.querySelector('#arrive').click();">Continuer</a>
        </div>
    </div>
</div>
