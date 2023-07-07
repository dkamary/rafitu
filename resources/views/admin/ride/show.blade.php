{{-- Admin Ride list --}}

@extends('_layouts.back')

@section('meta_title')
    Trajet n°{{ $ride->id }}
@endsection

@section('main')
    @include('_partials.back.section.breadcrumbs', ['page_title' => 'Trajet n°' . $ride->id])

    @include('_partials.back.notifications.flash-message')

    <div class="row bg-white py-5">
        <div class="col-12 col-md-9 mx-auto">
            <form action="{{ route('admin_ride_save') }}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{ $ride->id }}">

                <div class="card border border-black">
                    <div class="card-header bg-black">
                        <h4 class="card-title fw-bold text-white">Informations</h4>
                    </div>
                    <div class="card-body">

                        <div class="row mb-3">
                            <label for="owner_id" class="col-12 col-sm-4 col-md-3">Propriétaire</label>
                            <div class="col-12 col-sm-8 col-md-9">
                                <select class="form-select" name="owner_id" id="owner_id">
                                    @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ $ride->owner_id == $user->id ? 'selected' : '' }}>{{ $user->firstname .' ' . $user->lastname }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="driver_id" class="col-12 col-sm-4 col-md-3">Chauffeur</label>
                            <div class="col-12 col-sm-8 col-md-9">
                                <select class="form-select" name="driver_id" id="driver_id">
                                    @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ $ride->driver_id == $user->id ? 'selected' : '' }}>{{ $user->firstname .' ' . $user->lastname }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="vehicle_id" class="col-12 col-sm-4 col-md-3">Voiture</label>
                            <div class="col-12 col-sm-8 col-md-9">
                                <select class="form-select" name="vehicle_id" id="vehicle_id">
                                    @foreach ($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}" {{ $ride->vehicle_id == $vehicle->id ? 'selected' : '' }}>{{ $vehicle->brand .' ' .$vehicle->model }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border border-primary">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title fw-bold">Départ</h3>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <label for="departure_label" class="col-12 col-sm-4 col-md-3">Adresse de départ</label>
                            <div class="col-12 col-sm-8 col-md-9">
                                <input type="text" class="form-control" name="departure_label" id="departure_label" value="{{ $ride->departure_label }}" placeholder="Saisir une adresse" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="departure_position_long" class="col-12 col-sm-4 col-md-3">Départ longitude</label>
                            <div class="col-12 col-sm-8 col-md-9">
                                <input type="text" class="form-control" name="departure_position_long" id="departure_position_long" value="{{ $ride->departure_position_long }}" placeholder="Saisir une nombre" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="departure_position_lat" class="col-12 col-sm-4 col-md-3">Départ latitude</label>
                            <div class="col-12 col-sm-8 col-md-9">
                                <input type="text" class="form-control" name="departure_position_lat" id="departure_position_lat" value="{{ $ride->departure_position_lat }}" placeholder="Saisir un nombre" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="departure_date" class="col-12 col-sm-4 col-md-3">Date de départ</label>
                            <div class="col-12 col-sm-8 col-md-9">
                                <input type="datetime-local" class="form-control" name="departure_date" id="departure_date" value="{{ $ride->getDepartureDate('Y-m-d\TH:i') }}" placeholder="dd/mm/aaaa H:i" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border border-info">
                    <div class="card-header bg-info text-white">
                        <h3 class="card-title fw-bold">Arrivée</h3>
                    </div>
                    <div class="card-body">

                        <div class="row mb-3">
                            <label for="arrival_label" class="col-12 col-sm-4 col-md-3">Adresse d'arrivée</label>
                            <div class="col-12 col-sm-8 col-md-9">
                                <input type="text" class="form-control" name="arrival_label" id="arrival_label" value="{{ $ride->arrival_label }}" placeholder="Saisir une adresse" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="arrival_position_long" class="col-12 col-sm-4 col-md-3">Arrivée longitude</label>
                            <div class="col-12 col-sm-8 col-md-9">
                                <input type="text" class="form-control" name="arrival_position_long" id="arrival_position_long" value="{{ $ride->arrival_position_long }}" placeholder="Saisir une nombre" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="arrival_position_lat" class="col-12 col-sm-4 col-md-3">Arrivée latitude</label>
                            <div class="col-12 col-sm-8 col-md-9">
                                <input type="text" class="form-control" name="arrival_position_lat" id="arrival_position_lat" value="{{ $ride->arrival_position_lat }}" placeholder="Saisir une nombre" required>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="arrival_date" class="col-12 col-sm-4 col-md-3">Date d'arrivée</label>
                            <div class="col-12 col-sm-8 col-md-9">
                                <input type="datetime-local" class="form-control" name="arrival_date" id="arrival_date"  value="{{ $ride->getArrivalDate('Y-m-d\TH:i') }}" placeholder="dd/mm/aaaa H:i" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border border-dark">
                    <div class="card-header bg-dark text-white">
                        <h3 class="card-title fw-bold">Places</h3>
                    </div>
                    <div class="card-body">

                        <div class="row mb-3">
                            <label for="price" class="col-12 col-sm-4 col-md-3">Tarif</label>
                            <div class="col-12 col-sm-8 col-md-9">
                                <div class="input-group mb-3">
                                    <input type="number" class="form-control" name="price" id="price" value="{{ $ride->price }}" placeholder="Saisir une valeur" aria-label="Saisir une valeur" aria-describedby="price-addon" required min="100" step="1">
                                    <span class="input-group-text" id="price-addon">F CFA / passager</span>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="seats_available" class="col-12 col-sm-4 col-md-3">Sièges disponibles</label>
                            <div class="col-12 col-sm-8 col-md-9">
                                <input type="number" class="form-control" name="seats_available" id="seats_available" value="{{ $ride->seats_available }}" placeholder="Saisir une nombre" min="1" max="20" step="1" required>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card border border-warning">
                    <div class="card-header bg-warning text-white">
                        <h3 class="card-title fw-bold">Détails</h3>
                    </div>
                    <div class="card-body">

                        <div class="row mb-3">
                            <label for="distance" class="col-12 col-sm-4 col-md-3">Distance</label>
                            <div class="col-12 col-sm-8 col-md-9">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="distance" id="distance" value="{{ $ride->distance }}" placeholder="Saisir une valeur" aria-label="Saisir une valeur" aria-describedby="distance-addon">
                                    <span class="input-group-text" id="distance-addon">mètres</span>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="duration" class="col-12 col-sm-4 col-md-3">Durée</label>
                            <div class="col-12 col-sm-8 col-md-9">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="duration" id="duration" value="{{ $ride->duration }}" placeholder="Saisir une valeur" aria-label="Saisir une valeur" aria-describedby="duration-addon">
                                    <span class="input-group-text" id="duration-addon">secondes</span>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="duration" class="col-12 col-sm-4 col-md-3">Statut</label>
                            <div class="col-12 col-sm-8 col-md-9">
                                <select class="form-select" name="ride_status_id" id="ride_status_id">
                                    <option value="1" {{ $ride->ride_status_id == 1 ? 'selected' : '' }}>Planifié</option>
                                    <option value="2" {{ $ride->ride_status_id == 2 ? 'selected' : '' }}>Encours</option>
                                    <option value="3" {{ $ride->ride_status_id == 3 ? 'selected' : '' }}>Arrivé</option>
                                    <option value="4" {{ $ride->ride_status_id == 4 ? 'selected' : '' }}>Annulé</option>
                                    <option value="5" {{ $ride->ride_status_id == 5 ? 'selected' : '' }}>A valider</option>
                                </select>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card border border-secondary">
                    <div class="card-header bg-secondary text-white">
                        <h3 class="card-title fw-bold">Préférences</h3>
                    </div>
                    <div class="card-body">

                        <div class="row mb-3">
                            <label for="woman_only" class="col-12 col-sm-4 col-md-3">Femme seulement</label>
                            <div class="col-12 col-sm-8 col-md-9">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="woman_only" id="woman_only" {{ $ride->woman_only == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="woman_only">
                                        Oui
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="smokers" class="col-12 col-sm-4 col-md-3">Accepter les fumeurs</label>
                            <div class="col-12 col-sm-8 col-md-9">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="smokers" name="smokers" {{ $ride->smokers == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="smokers">
                                        Oui
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="animals" class="col-12 col-sm-4 col-md-3">Accepter les animaux</label>
                            <div class="col-12 col-sm-8 col-md-9">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="animals" name="animals" {{ $ride->animals == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="animals">
                                        Oui
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="talking" class="col-12 col-sm-4 col-md-3">Accepter la discussion</label>
                            <div class="col-12 col-sm-8 col-md-9">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="talking" name="talking" {{ $ride->talking == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="talking">
                                        Oui
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="vaccin" class="col-12 col-sm-4 col-md-3">Pass vaccinal</label>
                            <div class="col-12 col-sm-8 col-md-9">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="vaccin" name="vaccin" {{ $ride->vaccin == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="vaccin">
                                        Oui
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="row">
                    <div class="col-12 text-center">
                        <a href="{{ route('admin_ride_republish', ['ride' => $ride->id]) }}" class="btn btn-secondary mr-2 btn-republish" title="Cliquez ici pour permettre à ce trajet d'apparaître sur le site">
                            <i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;
                            Réactiver le trajet
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;
                            Enregistrer
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection

@once
    @push('footer')
        <script>
            window.addEventListener("DOMContentLoaded", () => {
                const refreshBtn = document.querySelector(".btn-republish");
                if(refreshBtn) {
                    refreshBtn.addEventListener("click", e => {
                        if (!confirm("Voulez-vous re-publier ce trajet ?")) {
                            e.preventDefault();
                            return false;
                        }
                    });
                }
            });
        </script>
    @endpush
@endonce
