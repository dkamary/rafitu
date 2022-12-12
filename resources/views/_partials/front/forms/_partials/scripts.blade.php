{{-- Add form ride all steps script --}}

<script id="step-1-script">
    function step1Autocomplete({
        $,
        departureLat,
        departureLng,
        departureMarker,
        departureMap,
        directionService,
        directionRenderer,
        itineraryMap
    }) {

        console.debug("Set autocomplete step 1");
        console.debug({
            jquery: $,
            departureLat,
            departureLng,
            departureMarker,
            departureMap,
            directionService,
            directionRenderer,
            itineraryMap
        });

        const $input = $('#departure_label');

        const options = {
            url: function(phrase) {
                const baseurl = "{{ route('suggestion_ville') }}";
                const queryString = new URLSearchParams();
                queryString.append("search", phrase.trim());

                return baseurl + (baseurl.includes('/') ? '' : '/') + '?' + queryString.toString();
            },
            placeholder: "D'où partez-vous?",
            getValue: function(element) {
                console.debug("Get Value");
                return element.name;
            },
            listLocation: "suggestions",
            list: {
                maxNumberOfElements: 8,
                match: {
                    enabled: true
                },
                sort: {
                    enabled: true
                },
                onClickEvent: () => {
                    const selected = $input.getSelectedItemData();
                    console.debug({ selected });

                    console.debug({
                        msg: "departure latitude changed",
                        lat: selected.latitude,
                        lng: selected.longitude
                    });

                    const pos = {
                        lat: parseFloat(selected.latitude),
                        lng: parseFloat(selected.longitude)
                    };

                    departureMarker.setMap(departureMap);
                    departureMap.panTo(pos);
                    departureMap.setZoom(14);
                    departureMarker.setPosition(pos);

                    departureLat.value = selected.latitude;
                    departureLng.value = selected.longitude;

                    setTimeout(() => {
                        $input.value = selected.name;
                        console.info("Info should have been updated!");
                        console.debug({
                            selected,
                            value: $input.value
                        })
                    }, 500);

                    const arrivalLat = document.querySelector("#arrival_lat");
                    const arrivalLng = document.querySelector("#arrival_lng");

                    if(!arrivalLat) {
                        console.warn("Impossible de sélectionner #arrival_lat");
                        return;
                    }

                    if(!arrivalLng) {
                        console.warn("Impossible de sélectionner #arrival_lng");
                        return;
                    }

                    const arrivalPosition = {
                        lat: parseFloat(arrivalLat.value),
                        lng: parseFloat(arrivalLng.value)
                    };

                    if(isNaN(arrivalPosition.lat) || arrivalPosition.lat == 0 || isNaN(arrivalPosition.lng) || arrivalLng.lng == 0) {
                        console.warn("Pas de calcul d'itinéraire!");
                        return;
                    }

                    console.debug("calcul de l'itinéraire");
                    step3({
                        departureLat,
                        departureLng,
                        arrivalLat,
                        arrivalLng,
                        itineraryMap,
                        directionService,
                        directionRenderer
                    });
                },
                onHideListEvent: () => {}
            },
            requestDelay: 600,
            // template: {
            //     type: "custom",
            //     fields: function(value, item) {
            //         return `<span class="fi fi-${item.country_code.toLowerCase()}"></span>&nbsp;` + item.name;
            //     }
            // },
            theme: "square"
        };

        console.debug({ options });

        $('#departure_label').easyAutocomplete(options);
    }

    function step2Autocomplete({
        $,
        arrivalLat,
        arrivalLng,
        arrivalMarker,
        arrivalMap,
        directionService,
        directionRenderer,
        itineraryMap
    }) {

        console.debug("Set autocomplete step 2");

        console.debug({
            jquery: $,
            arrivalLat,
            arrivalLng,
            arrivalMarker,
            arrivalMap,
            directionService,
            directionRenderer,
            itineraryMap
        });

        const $input = $('#arrival_label');

        const options = {
            url: function(phrase) {
                const baseurl = "{{ route('suggestion_ville') }}";
                const queryString = new URLSearchParams();
                queryString.append("search", phrase.trim());

                return baseurl + (baseurl.includes('/') ? '' : '/') + '?' + queryString.toString();
            },
            placeholder: "Où voulez-vous allez?",
            getValue: function(element) {
                return element.name;
            },
            listLocation: "suggestions",
            list: {
                maxNumberOfElements: 8,
                match: {
                    enabled: true
                },
                sort: {
                    enabled: true
                },
                onClickEvent: () => {
                    const selected = $input.getSelectedItemData();
                    console.debug({ selected });

                    console.debug({
                        msg: "arrival latitude changed",
                        lat: selected.latitude,
                        lng: selected.longitude
                    });

                    const pos = {
                        lat: parseFloat(selected.latitude),
                        lng: parseFloat(selected.longitude)
                    };

                    arrivalMarker.setMap(arrivalMap);
                    arrivalMap.panTo(pos);
                    arrivalMap.setZoom(14);
                    arrivalMarker.setPosition(pos);

                    arrivalLat.value = selected.latitude;
                    arrivalLng.value = selected.longitude;

                    const departureLat = document.querySelector('#departure_lat');
                    const departureLng = document.querySelector("#departure_lng");

                    step3({
                        departureLat,
                        departureLng,
                        arrivalLat,
                        arrivalLng,
                        itineraryMap,
                        directionService,
                        directionRenderer
                    });
                },
                onHideListEvent: () => {}
            },
            requestDelay: 600,
            theme: "square"
        };
        $('#arrival_label').easyAutocomplete(options);
    }

    function step3({
        departureLat,
        departureLng,
        arrivalLat,
        arrivalLng,
        itineraryMap,
        directionService,
        directionRenderer
    }) {
        const start = `${departureLat.value}, ${departureLng.value}`;
        const end = `${arrivalLat.value}, ${arrivalLng.value}`;

        const request = {
            origin: start,
            destination: end,
            travelMode: 'DRIVING'
        };

        console.debug(request);

        directionService.route(request, (response, status) => {
            if (status == 'OK') {
                directionRenderer.setDirections(response);
                console.debug(response);
                populateItineraries({ route: response.routes[0] });
            }
        });

        let bounds = new google.maps.LatLngBounds();
        bounds.extend({ lat: parseFloat(departureLat.value), lng: parseFloat(departureLng.value) });
        bounds.extend({ lat: parseFloat(arrivalLat.value), lng: parseFloat(arrivalLng.value) });
        itineraryMap.fitBounds(bounds);
    }

    function populateItineraries({ route }) {
        const form = document.querySelector('#ride-form');
        if (!form) {
            console.debug("Unable to select the form `#ride-form`!!!");

            return;
        }

        let itineraryContainer = document.querySelector('#itinerary-container');
        if (!itineraryContainer) {
            itineraryContainer = document.createElement('div');
            itineraryContainer.id = 'itinerary-container';
            form.appendChild(itineraryContainer);
        }
        itineraryContainer.innerHTML = ''; // Important de vider la liste des itinéraires

        let index = 0;
        route.overview_path.forEach(position => {
            const hidden = document.createElement('input');
            hidden.type = 'hidden';
            hidden.name = "itinerary[]";
            hidden.id = 'itinerary_' + index++;
            hidden.value = position.lat() + ', ' + position.lng();

            console.debug(hidden.value);

            itineraryContainer.appendChild(hidden);
        });

        const distance = route.legs[0].distance;
        form.querySelector('#distance').value = distance.value;
        form.querySelector('#distance_display').innerHTML = distance.text;

        const duration = route.legs[0].duration;
        form.querySelector('#duration').value = duration.value;
        form.querySelector('#duration_display').innerHTML = duration.text;
    };
</script>

<script defer async id="ride-init-map-script">
    function initMap() {
        const options = {
            center: {
                lat: -34.397,
                lng: 150.644
            },
            zoom: 14,
        };

        const departureMap = new google.maps.Map(document.querySelector("#departure_map"), options);
        const arrivalMap = new google.maps.Map(document.querySelector("#arrival_map"), options);
        const itineraryMap = new google.maps.Map(document.querySelector("#itinerary_map"), options);

        const departureMarker = new google.maps.Marker({ position: options.center, title: "Point de départ" });
        const arrivalMarker = new google.maps.Marker({ position: options.center, title: "Point d'arrivé" });

        const directionService = new google.maps.DirectionsService();
        const directionRenderer = new google.maps.DirectionsRenderer();
        directionRenderer.setMap(itineraryMap);

        if (navigator.geolocation) {
            console.info("Geolocation disponible!");

            navigator.geolocation.getCurrentPosition(
                (position) => {
                    const pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude,
                    };

                    console.info("Your current position is: { long: %f, lat: %f }", pos.lng, pos.lat);

                    departureMarker.setPosition(pos);
                    arrivalMarker.setPosition(pos);

                    departureMap.setCenter(pos);
                    arrivalMap.setCenter(pos);
                    arrivalMap.setCenter(pos);
                },
                () => {
                    console.error("Une erreur est survenue lors de la géolocalisation!");
                }
            );
        } else {
            console.error("Geolocation non disponible!!!");
        }

        const departureLat = document.querySelector("#departure_lat");
        const departureLng = document.querySelector("#departure_lng");
        const arrivalLat = document.querySelector("#arrival_lat");
        const arrivalLng = document.querySelector("#arrival_lng");

        // MAP EVENT CLICK
        departureMap.addListener("click", event => {
            departureMarker.setMap(departureMap);
            departureMarker.setPosition(event.latLng);
            departureMap.panTo(event.latLng);

            departureLat.value = event.latLng.lat();
            departureLng.value = event.latLng.lng();
        });

        arrivalMap.addListener("click", event => {
            arrivalMarker.setMap(departureMap);
            arrivalMarker.setPosition(event.latLng);
            arrivalMap.panTo(event.latLng);

            arrivalLat.value = event.latLng.lat();
            arrivalLng.value = event.latLng.lng();

            step3({
                departureLat,
                departureLng,
                arrivalLat,
                arrivalLng,
                itineraryMap,
                directionService,
                directionRenderer
            });
        });

        autocompleteCity({
            selector: '#departure_label',
            src: 'google',
            onClick: ({ element, input }) => {
                const selected = element;
                console.debug({ selected });

                console.debug({
                    msg: "departure latitude changed",
                    lat: selected.latitude,
                    lng: selected.longitude
                });

                const pos = {
                    lat: parseFloat(selected.latitude),
                    lng: parseFloat(selected.longitude)
                };

                departureMarker.setMap(departureMap);
                departureMap.panTo(pos);
                departureMap.setZoom(14);
                departureMarker.setPosition(pos);

                departureLat.value = selected.latitude;
                departureLng.value = selected.longitude;

                setTimeout(() => {
                    // input.value = selected.name;
                    console.info("Info should have been updated!");
                    console.debug({
                        selected,
                        value: input.value
                    })
                }, 500);

                const arrivalLat = document.querySelector("#arrival_lat");
                const arrivalLng = document.querySelector("#arrival_lng");

                if(!arrivalLat) {
                    console.warn("Impossible de sélectionner #arrival_lat");
                    return;
                }

                if(!arrivalLng) {
                    console.warn("Impossible de sélectionner #arrival_lng");
                    return;
                }

                const arrivalPosition = {
                    lat: parseFloat(arrivalLat.value),
                    lng: parseFloat(arrivalLng.value)
                };

                if(isNaN(arrivalPosition.lat) || arrivalPosition.lat == 0 || isNaN(arrivalPosition.lng) || arrivalLng.lng == 0) {
                    console.warn("Pas de calcul d'itinéraire!");
                    return;
                }

                console.debug("calcul de l'itinéraire");
                step3({
                    departureLat,
                    departureLng,
                    arrivalLat,
                    arrivalLng,
                    itineraryMap,
                    directionService,
                    directionRenderer
                });
            }
        });

        autocompleteCity({
            selector: '#arrival_label',
            src: 'google',
            onClick: ({ element, input }) => {
                const selected = element;
                console.debug({ selected });

                console.debug({
                    msg: "arrival latitude changed",
                    lat: selected.latitude,
                    lng: selected.longitude
                });

                const pos = {
                    lat: parseFloat(selected.latitude),
                    lng: parseFloat(selected.longitude)
                };

                arrivalMarker.setMap(arrivalMap);
                arrivalMap.panTo(pos);
                arrivalMap.setZoom(14);
                arrivalMarker.setPosition(pos);

                arrivalLat.value = selected.latitude;
                arrivalLng.value = selected.longitude;

                const departureLat = document.querySelector('#departure_lat');
                const departureLng = document.querySelector("#departure_lng");

                step3({
                    departureLat,
                    departureLng,
                    arrivalLat,
                    arrivalLng,
                    itineraryMap,
                    directionService,
                    directionRenderer
                });
            }
        });

        // step1Autocomplete({
        //     $: window.jQuery,
        //     departureMarker,
        //     departureMap,
        //     departureLng,
        //     departureLat,
        //     directionService,
        //     directionRenderer,
        //     itineraryMap
        // });

        // step2Autocomplete({
        //     $: window.jQuery,
        //     arrivalMarker,
        //     arrivalMap,
        //     arrivalLng,
        //     arrivalLat,
        //     directionService,
        //     directionRenderer,
        //     itineraryMap
        // });

        //
    }
</script>
<script defer async
    src="https://maps.googleapis.com/maps/api/js?key={{ Config::get('google.maps.api.key') }}&libraries=places&callback=initMap">
</script>
