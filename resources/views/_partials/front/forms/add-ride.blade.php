{{-- Add Ride form --}}

<form action="{{ route('ride_save') }}" id="ride-form" method="post" class="form-horizontal mb-0">
    <div id="rootwizard" class="border pt-0">
        <ul class="nav nav-tabs nav-justified">
            <li class="nav-item"><a href="#first" id="depart" data-bs-toggle="tab" class="nav-link font-bold">Départ</a></li>
            <li class="nav-item"><a href="#second" id="arrive" data-bs-toggle="tab" class="nav-link font-bold">Arrivée</a></li>
            <li class="nav-item"><a href="#third" id="itineraire" data-bs-toggle="tab" class="nav-link font-bold">Itinéraire</a></li>
            <li class="nav-item"><a href="#fourth" id="prix" data-bs-toggle="tab" class="nav-link font-bold">Prix</a></li>
        </ul>
        <div class="tab-content card-body mt-3 mb-0 b-0">
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
                            placeholder="dd/mm/aaaa hh:mm">
                    </div>
                </div>
                <div class="control-group form-group">
                    <div class="text-end">
                        <a href="#second" data-bs-toggle="tab" class="btn btn-primary  mb-0 waves-effect waves-light" onclick="document.querySelector('#arrive').click();">Continuer</a>
                    </div>
                </div>
            </div>
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
            </div>
            <div class="tab-pane fade" id="third">
                <div class="control-group form-group">
                    <div class="form-group">
                        <label class="form-label text-dark">Votre itinéraire</label>
                        <div class="mini-map" id="itinerary"></div>
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
                        <option value="0">Choisir parmis la liste</option>
                        @foreach ($vehicules as $item)
                            <option value="{{ $item->id }}">{{ $item->getName() }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="tab-pane fade" id="fourth">
                <div class="control-group form-group">
                    <div class="form-group">
                        <label class="form-label text-dark">Prix</label>
                        <input type="number" name="price" class="form-control required Title" min="1"
                            max="100" placeholder="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label text-dark">Moyen de paiement</label>
                    <select name="payment_method" class="form-control form-select required category select2">
                        <option value="0">Sélectionner le moyen de paiement</option>
                        <option value="1">Carte Bancaire</option>
                        <option value="2">Paypal</option>
                        <option value="3">Orange Money</option>
                    </select>
                </div>
                <div class="form-group row clearfix">
                    <div class="col-lg-12">
                        <div class="checkbox checkbox-info">
                            <label class="custom-control mt-4 form-checkbox">
                                <input name="consent" type="checkbox" required class="custom-control-input" />
                                <span class="custom-control-label text-dark ps-2">J'accepte les termes et
                                    conditions</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary  mb-0 waves-effect waves-light">Publier votre trajet</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @csrf
    <div id="itinerary-container" style="display: none;"></div>
</form>

@once

    @push('head')
        <style>
            .mini-map {
                width: 100%;
                height: 300px;
            }
        </style>
    @endpush
@endonce
