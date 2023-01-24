{{-- Formulaire d'édition préréservation --}}

<form action="{{ route('admin_prereservation_save', ['prereservation' => $prereservation->id]) }}" method="post">
    <div class="row mb-3">
        <label for="" class="col-12 col-md-4">Nom :</label>
        <div class="col-12 col-md-8">{{ $prereservation->fullname }}</div>
    </div>
    <div class="row mb-3">
        <label for="" class="col-12 col-md-4">Email :</label>
        <div class="col-12 col-md-8">{{ $prereservation->email }}</div>
    </div>
    <div class="row mb-3">
        <label for="" class="col-12 col-md-4">Départ :</label>
        <div class="col-12 col-md-8">{{ $prereservation->departure_label }}</div>
    </div>
    <div class="row mb-3">
        <label for="" class="col-12 col-md-4">Arrivée :</label>
        <div class="col-12 col-md-8">{{ $prereservation->arrival_label }}</div>
    </div>
    <div class="row mb-3">
        <label for="" class="col-12 col-md-4">Date et heure :</label>
        <div class="col-12 col-md-8">{{ display_date($prereservation->reservation_date .' ' . $prereservation->reservation_time, 'H:i') }}</div>
    </div>
    <div class="row mb-3">
        <label for="" class="col-12 col-md-4">Status</label>
        <div class="col-12 col-md-8">
            <input type="checkbox" id="is_active" name="is_active" value="1" {{ $prereservation->isActive() ? 'checked' : '' }}>
            <label class="form-check-label" for="is_active">Active</label>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-12 text-center">
            <button type="submit" class="btn btn-outline-primary">
                <i class="fa fa-check" aria-hidden="true"></i>&nbsp;
                Enregistrer les modifications
            </button>
        </div>
    </div>
    @csrf
</form>

@once

    @push('footer')
        script#prereservation-check
    @endpush

@endonce
