{{-- Google Maps par défaut --}}

<script defer async>
    function initMap() {
        const maps = document.querySelectorAll('.google-map');
        if(!maps && maps.length == 0) {
            console.warn('No google map found!!!');
            return;
        }

        console.debug(`${maps.length} map(s) found!!!`);

        maps.forEach(map => {
                let options = {
                    center: {
                        lat: -34.397,
                        lng: 150.644
                    },
                    zoom: 14,
                };

                if(map.dataset.lat) options.center.lat = map.dataset.lat;
                if(map.dataset.lng) options.center.lng = map.dataset.lng;
                if(map.dataset.zoom) options.zoom = map.dataset.zoom;

                console.debug('New instance of googleMap');

                const gMap = new google.maps.Map(map, options);
            });
    }
</script>
<script defer async
    src="https://maps.googleapis.com/maps/api/js?key={{ Config::get('google.maps.api.key') }}&libraries=places&callback=initMap">
</script>
