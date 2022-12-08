/**
 * Google maps functions
 */

const loadMaps = require("./modules/google-map");

const initMap = () => {
    console.debug("Init Map");

    loadMaps({ selector: ".google-map" });
};

window.initMap = initMap;
