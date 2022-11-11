/**
 * Google Map
 */

const autocompleteInput = require("./google-autocomplete");

const googleMapDefaultOptions = {
    center: {
        lat: -34.397,
        lng: 150.644
    },
    zoom: 14,
};

const loadMaps = ({ selector }) => {
    console.debug("Load Maps with selector: `%s`", selector);

    const maps = document.querySelectorAll(selector);
    if (!maps || maps.length == 0) {
        console.debug("Unable to find maps in the web page");

        return;
    }

    maps.forEach(map => {
        const gMap = loadGoogleMap({ element: map });
        if(map.dataset.autocomplete) {
            autocompleteInput({
                selector: map.dataset.autocomplete,
                map: gMap,
                addMarker: (map.dataset.addMarker == true || map.dataset.addMarker == "true")
            });
        }
    });
}

const loadGoogleMap = ({ element }) => {
    console.debug("Load Google Map");

    if (!element) {
        console.debug("Unable to create Google map from empty NodeElement");
        console.debug(element);
    }

    return new google.maps.Map(element, googleMapDefaultOptions);
};

module.exports = loadMaps;
