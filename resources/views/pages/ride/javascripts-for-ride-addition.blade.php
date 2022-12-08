{{-- Javascript for ride addition --}}

@once

@include('_partials.front.google-maps.city-suggestion')

<script defer async id="ride-addition-script">
    function handleMap() {
        console.debug('handleMap!!!');

        let currentPosition = {
            lat: -34.397,
            lng: 150.644
        };

        /// FUNCTIONS HELPERS
        const initMap = ({ selector, domElement }) => {
            console.debug("initMap");
            console.debug({
                selector, domElement
            });

            const map = !selector ? domElement : document.querySelector(selector);
            if(!map) {
                console.error("Impossible de sélectionner l'élément avec le selecteur `%s`", selector);
                return null;
            }
            const options = {
                center: {
                    lat: map.dataset.lat ? map.dataset.lat : currentPosition.lat,
                    lng: map.dataset.lng ? map.dataset.lng : currentPosition.lng
                },
                zoom: 14,
            };
            const gMap = new google.maps.Map(map, options);

            setCurrentLocation(gMap);
            handleMapClick({
                map: gMap
            });

            return gMap;
        };

        const setCurrentLocation = (gMap) => {
            console.debug("setCurrentLocation");

            if(!navigator || !navigator.geolocation) {
                console.warn("Geolocation n'est pas disponible!");
                gMap.setCenter(currentPosition);

                return null;
            }

            navigator.geolocation.getCurrentPosition(
                (position) => {
                    console.debug(position);

                    currentPosition.lat = position.coords.latitude;
                    currentPosition.lng = position.coords.longitude;
                    gMap.setCenter(currentPosition);

                    console.debug("Current Position setted!");
                },
                () => {
                    console.error("Une erreur est survenue lors de la géolocalisation");
                }
            );
        };

        const createMarker = ({ position, map, title }) => {
            console.debug("createMarker");

            const marker = new google.maps.Marker({
                position,
                map,
                title
            });

            return marker;
        };

        const handleMapClick = ({ map, callback, marker }) => {
            console.debug("handleMapClick");

            if(!callback) {
                callback = event => {
                    if(!marker) {
                        marker = createMarker({
                            position: {lat: 0, lng: 0},
                            map,
                        })
                    }

                    marker.setPosition(event.latLng);
                    // map.setCenter(event.latLng);

                    const domElement = map.__gm.Aa;
                    console.debug(domElement);

                    const inputLat = document.querySelector(domElement.dataset.inputlat);
                    const inputLng = document.querySelector(domElement.dataset.inputlng);

                    if(!inputLat) {
                        console.error("Selection impossible de %s", domElement.dataset.inputlat);
                        return;
                    }
                    inputLat.value = event.latLng.lat();

                    if(!inputLng) {
                        console.error("Selection impossible de %s", domElement.dataset.inputlng);
                        return;
                    }
                    inputLng.value = event.latLng.lng();
                }
            }
            google.maps.event.addListener(map, "click", callback);
        };

        const selectMaps = ({ selector }) => {
            console.debug("selectMaps");

            const maps = document.querySelectorAll('.ride-map');

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

                const gMap = initMap({
                    domElement: map
                });
            });
        };

        /// END FUNCTIONS HELPERS

        /// START LOGIC
        selectMaps({
            selector: 'ride-map'
        });
        /// END LOGIC
    }
</script>

<script defer async
    src="https://maps.googleapis.com/maps/api/js?key={{ Config::get('google.maps.api.key') }}&libraries=places&callback=handleMap">
</script>
@endonce
