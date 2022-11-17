{{-- Search ride hero section --}}

<form action="{{ route('ride_search') }}" method="GET" class="form row g-0 form-search-ride-hero">
    <div class="form-group  col-xl-3 col-lg-3 col-md-12 mb-0 bg-white ">
        <input type="text" class="form-control input-lg br-te-md-0 br-be-md-0 border-end-0" name="origin" id="search_origin" placeholder="Départ">
        <span><i class="fa fa-map-marker location-gps me-1"></i></span>
        <input type="hidden" name="origin_lat" id="search_origin_lat">
        <input type="hidden" name="origin_lng" id="search_origin_lng">
    </div>
    <div class="form-group  col-xl-3 col-lg-3 col-md-12 mb-0 bg-white">
        <input type="text" class="form-control input-lg br-md-0 border-end-0" name="destination" id="search_destination" placeholder="Destination">
        <span><i class="fa fa-map-marker location-gps me-1"></i></span>
        <input type="hidden" name="destination_lat" id="search_destination_lat">
        <input type="hidden" name="destination_lng" id="search_destination_lng">
    </div>
    <div class="form-group col-xl-3 col-lg-3 col-md-12 select2-lg  mb-0 bg-white">
        <input type="datetime" class="form-control input-lg br-md-0 border-end-0" name="search_date" id="search_date" placeholder="Aujourd'hui">
        <span><i class="fa fa-calendar location-gps me-1"></i></span>
    </div>
    <div class="form-group col-xl-1 col-lg-1 col-md-12 select2-lg  mb-0 bg-white">
        <span><i class="fa fa-user location-gps me-1"></i></span>
        <input type="text" class="form-control input-lg br-md-0 border-end-0" name="search_count" id="search_count" placeholder="">
    </div>
    <div class="col-xl-2 col-lg-2 col-md-12 mb-0">
        <button type="submit" class="btn btn-lg btn-block btn-primary br-ts-md-0 br-bs-md-0">Rechercher</button>
    </div>
    @csrf
</form>
