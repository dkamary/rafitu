{{-- Google Maps par défaut --}}

<script defer async src="{{ asset('assets/js/ride.js') }}?version={{ date('YmdHis') }}"></script>
<script defer async src="https://maps.googleapis.com/maps/api/js?key={{ Config::get('google.maps.api.key') }}&libraries=places&callback=initMap"></script>
