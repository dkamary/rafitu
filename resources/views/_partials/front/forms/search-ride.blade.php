{{-- Search ride --}}

@php
    $origin = Request::get('origin');
    $origin_lat = Request::get('origin_lat');
    $origin_lng = Request::get('origin_lng');
    $destination = Request::get('destination');
    $destination_lat = Request::get('destination_lat');
    $destination_lng = Request::get('destination_lng');
    $search_date = Request::get('search_date');
    $search_count = Request::get('search_count');
@endphp

<form class="form form-search-ride-hero" action="{{ route('ride_search') }}" method="get">
    <div class="row mb-3">
        <div class="col-12">
            <label for="search_origin" class="form-label">Départ</label>
            <input type="search" name="origin" id="search_origin" class="form-control"
            value="{{ $origin }}"
                placeholder="Votre lieu de départ">
            <input type="hidden" name="origin_lat" id="search_origin_lat" value="{{ $origin_lat }}">
            <input type="hidden" name="origin_lng" id="search_origin_lng" value="{{ $origin_lng }}">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-12">
            <label for="search_destination" class="form-label">Arrivée</label>
            <input type="search" name="destination" id="search_destination" class="form-control"
            value="{{ $destination }}"
                placeholder="Votre lieu d'arrivée">
            <input type="hidden" name="destination_lat" id="search_destination_lat" value="{{ $destination_lat }}">
            <input type="hidden" name="destination_lng" id="search_destination_lng" value="{{ $destination_lng }}">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-6">
            <label for="search_date" class="form-label">Date</label>
            <input type="date" name="search_date" id="search_date" value="{{ $search_date }}" class="form-control" placeholder="Date de départ">
        </div>
        <div class="col-6">
            <label for="search_count" class="form-label">Passager</label>
            <input type="number" name="search_count" id="search_count" value="{{ $search_count }}" class="form-control" placeholder="Passager" min="1" max="7">
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
