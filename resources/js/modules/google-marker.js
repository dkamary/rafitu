/**
 * Google marker
 */

const placeMarker = ({ map, location }) => {
    const marker = new google.maps.Marker();
    marker.setMap(map);
    marker.setPosition(location);

    return marker;
};

module.exports= placeMarker;
