// Gestion des trajets

const handleLocationError = (browserHasGeolocation, infoWindow, map) => {
  infoWindow.setPosition(pos.getCenter());
  infoWindow.setContent(
      browserHasGeolocation
          ? "Erreur: Le service de Géolocation a échoué."
          : "Erreur: Votre géolocalisation n'est pas actif."
  );
  infoWindow.open(map);
};

const calculItinerary = ({ start, end, onSuccess, onError }) => {
  const Url = new URL(window.location.href);
  const requestUrl = Url.protocol + '//' + Url.hostname + '/google/directions/?origin=' + encodeURIComponent(start) + '&destination=' + encodeURIComponent(end)
  console.debug(requestUrl);
  var axios = require('axios');
  var config = {
      method: 'get',
      url: requestUrl,
      headers: {}
  };

  console.debug("Calcul itinéraire initalisé: %s", config.url);

  axios(config)
      .then(function (response) {
          // console.log(JSON.stringify(response.data));
          onSuccess(response.data);
      })
      .catch(function (error) {
          console.log(error);
          onError(error);
      });
};

function initMap() {
  console.debug("ride.js");

  // Search box
  autocompleteMainSearch();

  const trajet = document.querySelector("#depart");
  if(!trajet) {
      console.debug("On n'est pas pas dans la publication de trajet");

      return;
  }
  trajet.click();

  const mapDefaultOptions = {
      center: {
          lat: -34.397,
          lng: 150.644
      },
      zoom: 14,
  };
  const suggestionOptions = {
      fields: ["address_component", "geometry", "name", "place_id"],
      types: ["establishment"]
  };

  const geocoder = new google.maps.Geocoder();

  const itinerary = document.querySelector("#itinerary");
  const mapItinerary = new google.maps.Map(itinerary, mapDefaultOptions);

  const departureLng = document.querySelector("#departure_lng");
  const departureLat = document.querySelector("#departure_lat");
  const departureLabel = document.querySelector('#departure_label');
  const departure = document.querySelector("#departure_map");
  const mapDeparture = new google.maps.Map(departure, mapDefaultOptions);
  const infoWindowDeparture = new google.maps.InfoWindow();
  const markerDeparture = new google.maps.Marker();
  markerDeparture.setMap(mapDeparture);
  google.maps.event.addListener(mapDeparture, "click", event => {
      markerDeparture.setPosition(event.latLng);
      mapDeparture.setCenter(event.latLng);
      departureLng.value = event.latLng.lng();
      departureLat.value = event.latLng.lat();
  });
  const departureAutocomplete = new google.maps.places.Autocomplete(departureLabel, suggestionOptions);
  departureLabel.addEventListener("change", e => {
      geocoder.geocode({
          'address': departureLabel.value,
      }, (results, status) => {
          if (status == 'OK') {
              departureLng.value = results[0].geometry.location.lng();
              departureLat.value = results[0].geometry.location.lat();
              mapDeparture.setCenter(results[0].geometry.location);
              markerDeparture.setPosition(results[0].geometry.location);
              console.debug({
                  input: departureLabel.value,
                  lat: departureLng.value,
                  lng: departureLat.value,
                  results: results
              });
          } else {
              console.warn(`Geocode was not successful for the following reason: ${status}`);
          }
      });
  });

  const arrivalLng = document.querySelector("#arrival_lng");
  const arrivalLat = document.querySelector("#arrival_lat");
  const arrivalLabel = document.querySelector('#arrival_label');
  const arrival = document.querySelector("#arrival_map");
  const mapArrival = new google.maps.Map(arrival, mapDefaultOptions);
  const infoWindowArrival = new google.maps.InfoWindow();
  const markerArrival = new google.maps.Marker();
  markerArrival.setMap(mapArrival);
  google.maps.event.addListener(mapArrival, "click", event => {
      markerArrival.setPosition(event.latLng);
      arrivalLng.value = event.latLng.lng();
      arrivalLat.value = event.latLng.lat();
      mapArrival.setCenter(event.latLng);
  });
  const arrivalAutocomplete = new google.maps.places.Autocomplete(arrivalLabel, suggestionOptions);
  arrivalLabel.addEventListener("change", e => {
      geocoder.geocode({
          'address': arrivalLabel.value,
      }, (results, status) => {
          if (status == 'OK') {
              arrivalLng.value = results[0].geometry.location.lng();
              arrivalLat.value = results[0].geometry.location.lat();
              mapArrival.setCenter(results[0].geometry.location);
          } else {
              console.warn(`Geocode was not successful for the following reason: ${status}`);
          }
      });
  });

  if (navigator.geolocation) {
      console.debug("Geolocation disponible!");

      navigator.geolocation.getCurrentPosition(
          (position) => {
              const pos = {
                  lat: position.coords.latitude,
                  lng: position.coords.longitude,
              };
              markerDeparture.setPosition(pos);
              markerArrival.setPosition(pos);

              // infoWindowDeparture.setPosition(pos);
              // infoWindowDeparture.setContent("Emplacement trouvé.");
              // infoWindowDeparture.open(mapDeparture);
              mapDeparture.setCenter(pos);
              departureLng.value = pos.lng;
              departureLat.value = pos.lat;

              // infoWindowArrival.setPosition(pos);
              // infoWindowArrival.setContent("Emplacement trouvé.");
              // infoWindowArrival.open(mapArrival);
              mapArrival.setCenter(pos);
              arrivalLng.value = pos.lng;
              arrivalLat.value = pos.lat;
          },
          () => {
              handleLocationError(true, infoWindowDeparture, mapDeparture);
              handleLocationError(true, infoWindowArrival, mapArrival);
          }
      );
  } else {
      console.console.warn("Geolocation non disponible!!!");

      handleLocationError(true, infoWindowDeparture, mapDeparture.getCenter());
      handleLocationError(true, infoWindowArrival, mapArrival.getCenter());
  }

  const btnItinerary = document.querySelector("#itineraire");
  if (btnItinerary) {
      console.debug("Itinéraire trouvé!!!");

      btnItinerary.addEventListener("click", () => {
          const departureLat = document.querySelector("#departure_lat");
          const departureLng = document.querySelector("#departure_lng");
          const start = `${departureLat.value}, ${departureLng.value}`;

          const arrivalLat = document.querySelector("#arrival_lat");
          const arrivalLng = document.querySelector("#arrival_lng");
          const end = `${arrivalLat.value}, ${arrivalLng.value}`;

          let directionService = new google.maps.DirectionsService();
          let directionRenderer = new google.maps.DirectionsRenderer();
          directionRenderer.setMap(mapItinerary);
          const request = {
              origin: start,
              destination: end,
              travelMode: 'DRIVING'
          };
          console.debug(request);
          directionService.route(request, (response, status) => {
              if(status == 'OK') {
                  directionRenderer.setDirections(response);
                  console.debug(response);
                  populateItineraries({ route: response.routes[0] });
              }
          });

          let bounds = new google.maps.LatLngBounds();
          bounds.extend({ lat: parseFloat(departureLat.value), lng: parseFloat(departureLng.value) });
          bounds.extend({ lat: parseFloat(arrivalLat.value), lng: parseFloat(arrivalLng.value) });
          mapItinerary.fitBounds(bounds);

          // calculItinerary({
          //     start: start,
          //     end: end,
          //     onSuccess: response => {
          //         console.debug("Success!!!");
          //         console.debug(response);
          //         const markerOrigin = new google.maps.Marker();
          //         markerOrigin.setMap(mapItinerary);
          //         markerOrigin.setPosition(response.origin);

          //         const markerDestination = new google.maps.Marker();
          //         markerDestination.setMap(mapItinerary);
          //         markerDestination.setPosition(response.destination);

          //         let bounds = new google.maps.LatLngBounds();
          //         bounds.extend(response.origin);
          //         bounds.extend(response.destination);

          //         mapItinerary.fitBounds(bounds);

          //         let directionsService = new google.maps.DirectionsService();
          //         let directionsRenderer = new google.maps.DirectionsRenderer();

          //         directionsRenderer.setMap(mapItinerary);
          //     },
          //     onError: error => {
          //         //
          //     }
          // })
      })
  } else {
      console.debug("No Itinerary link!!!");
  }
}

const populateItineraries = ({ route }) => {
  const form = document.querySelector('#ride-form');
  if(!form) {
      console.debug("Unable to select the form `#ride-form`!!!");

      return;
  }

  let itineraryContainer = document.querySelector('#itinerary-container');
  if(!itineraryContainer) {
      itineraryContainer = document.createElement('div');
      itineraryContainer.id = 'itinerary-container';
      form.appendChild(itineraryContainer);
  }
  itineraryContainer.innerHTML = '';

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

  const duration = route.legs[0] .duration;
  form.querySelector('#duration').value = duration.value;
  form.querySelector('#duration_display').innerHTML = duration.text;
};

const autocompleteMainSearch = () => {
  console.debug("Autocomplete for search form!");

  autoCompleteOrigin();
  autoCompleteDestination();

  console.debug("Auto complete set up?");
};

const autoCompleteOrigin = () => {
  const originLat = document.querySelector("#search_origin_lat");
  const originLng = document.querySelector("#search_origin_lng");
  const origin = document.querySelector("#search_origin");
  const geocoder = new google.maps.Geocoder();

  if(origin) {
      console.debug("Autocomplete Origin");

      const originAutocomplete = new google.maps.places.Autocomplete(origin, {
          fields: ["address_component", "geometry", "name", "place_id"],
          types: ["establishment"]
      });

      origin.addEventListener("change", e => {
        const value = origin.value;
        if(value.trim().length == 0) {
          originLng.value = originLat.value = 0;
          return false;
        }
        
          geocoder.geocode({
              'address': origin.value,
          }, (results, status) => {
              if (status == 'OK') {
                  originLng.value = results[0].geometry.location.lng();
                  originLat.value = results[0].geometry.location.lat();
                  console.debug('Origin Search form autocomplete!');
                  console.debug({
                      lat: results[0].geometry.location.lat(),
                      lng: results[0].geometry.location.lng()
                  });
              } else {
                  console.warn(`Geocode was not successful for the following reason: ${status}`);
              }
          });
      });
  } else {
      console.debug("Il n'y a pas de champ `#search_origin` dans la page");
  }
};

const autoCompleteDestination = () => {
  const destinationLat = document.querySelector("#search_destination_lat");
  const destinationLng = document.querySelector("#search_destination_lng");
  const destination = document.querySelector("#search_destination");
  const geocoder = new google.maps.Geocoder();

  if(destination) {
      console.debug("Autocomplete Destination");

      const destinationAutocomplete = new google.maps.places.Autocomplete(destination, {
          fields: ["address_component", "geometry", "name", "place_id"],
          types: ["establishment"]
      });

      destination.addEventListener("change", e => {
        const value = destination.value;
        if(value.trim().length == 0) {
          destinationLng.value = destinationLat.value = 0;
          return false;
        }

          geocoder.geocode({
              'address': destination.value,
          }, (results, status) => {
              if (status == 'OK') {
                  destinationLng.value = results[0].geometry.location.lng();
                  destinationLat.value = results[0].geometry.location.lat();
                  console.debug('Destination Search autocomplete!');
                  console.debug({
                      lat: results[0].geometry.location.lat(),
                      lng: results[0].geometry.location.lng()
                  });
              } else {
                  console.warn(`Geocode was not successful for the following reason: ${status}`);
              }
          });
      });
  }else {
      console.debug("Il n'y a pas de champ `#search_destination` dans la page");
  }
};

window.initMap = initMap;
