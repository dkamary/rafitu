{{-- Search ride --}}

<form class="form form-search-ride-hero" action="{{ route('ride_search') }}" method="get">
    <div class="row mb-3">
        <div class="col-12">
            <label for="search_origin" class="form-label">Départ</label>
            <input type="search" name="origin" id="search_origin" class="form-control"
            value="{{ request()->get('origin', old('origin')) }}"
                placeholder="Votre lieu de départ">
            <input type="hidden" name="origin_lat" id="search_origin_lat" value="{{ request()->get('origin_lat', old('origin_lat')) }}">
            <input type="hidden" name="origin_lng" id="search_origin_lng" value="{{ request()->get('origin_lng', old('origin_lng')) }}">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-12">
            <label for="search_destination" class="form-label">Arrivée</label>
            <input type="search" name="destination" id="search_destination" class="form-control"
            value="{{ request()->get('destination', old('destination')) }}"
                placeholder="Votre lieu d'arrivée">
            <input type="hidden" name="destination_lat" id="search_destination_lat">
            <input type="hidden" name="destination_lng" id="search_destination_lng">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-6">
            <label for="search_date" class="form-label">Date</label>
            <input type="date" name="search_date" id="search_date" value="{{ old('search_date') }}" class="form-control" placeholder="Date de départ">
        </div>
        <div class="col-6">
            <label for="search_count" class="form-label">Passager</label>
            <input type="number" name="search_count" id="search_count" value="{{ old('search_count') }}" class="form-control" placeholder="Passager" min="1" max="7">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">
                Rechercher
            </button>
        </div>
    </div>
    @csrf
</form>
