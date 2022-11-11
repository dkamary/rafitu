/**
 * Google Map Autocomplete
 */

const placeMarker = require("./google-marker");

const autocompleteOptions = {
    fields: ["address_component", "geometry", "name", "place_id"],
    types: ["establishment"]
};

const placeAutocomplete = ({ selector }) => {
    console.debug("Load Autocomplete place");

    const autoCompleters = document.querySelectorAll(selector);
    if (!autoCompleters || autoCompleters.length == 0) {
        console.debug("No Autocomplete input found!");

        return;
    }
};

const autocompleteInput = ({ selector, map, addMarker }) => {
    console.debug("Auto Complete Input");

    const input = document.querySelector(selector);
    if (!input) {
        console.debug("No Input found for selector: `%s`", selector);

        return;
    }

    const autoCompleteInput = new google.maps.places.Autocomplete(input, autocompleteOptions);
    const geocoder = new google.maps.Geocoder();
    const marker = placeMarker({ map: map, location: { lat: 0.0, lng: 0.0 } });

    input.addEventListener("change", event => {
        geocoder.geocode({
            'address': input.value
        }, (results, status) => {
            if (status == "OK") {
                autocompleteOK({ input: input, results: results, map: map });
            } else {
                console.debug("Place autocomplete failed: %s", status);
            }
        });
    });

    return autoCompleteInput;
};

const autocompleteOK = ({ input, results, map }) => {
    console.debug("Place autocomplete OK!");

    const lng = results[0].geometry.location.lng();
    const lat = results[0].geometry.location.lat();

    handleLatitude({ input: input, lat: lat });
    handleLongitude({ input: input, lng: lng });

    map.setCenter(lat, lng, 14);
};

const handleLatitude = ({ input, lat }) => {
    const hiddenLat = document.querySelector(input.dataset.latField);

    if (hiddenLat) {
        console.debug("`%s`'s latitude: %f", input.value, lat);
        hiddenLat.value = lat;
    } else {
        console.debug("No Hidden Lattitude field found!");
        console.debug("Add hidden field for lat!");
        const hidden = createHiddenField({
            id: input.name + '_' + 'lat',
            name: input.name + '_' + 'lat'
        });
        input.after(hidden);
        input.dataset.latField = input.name + '_' + 'lat';
    }
};

const handleLongitude = ({ input, lng }) => {
    const hiddenLng = document.querySelector(input.dataset.lngField);

    if (hiddenLng) {
        console.debug("`%s`'s longitude: %f", input.value, lng);
        hiddenLng.value = results[0].geometry.location.lng();
    } else {
        console.debug("No Hidden Longitude found!");
        console.debug("Add hidden field for lat!");
        const hidden = createHiddenField({
            id: input.name + '_' + 'lng',
            name: input.name + '_' + 'lng'
        });
        input.after(hidden);
        input.dataset.lngField = input.name + '_' + 'lng';
    }
};

const createHiddenField = ({ id, name }) => {
    const hidden = document.createElement("input");
    hidden.type = "hidden";
    hidden.id = id;
    hidden.name = name ? name : id;

    return hidden;
};

// module.exports = placeAutocomplete;
module.exports = autocompleteInput;
