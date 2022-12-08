var axios = require('axios');

const searchPlace = ({input, onSuccess, onError }) => {
    input = encodeURI(input);
    var config = {
        method: 'get',
        url: `https://maps.googleapis.com/maps/api/place/autocomplete/json?input=${input}`,
        headers: {}
    };

    axios(config)
        .then(response => {
            console.debug(JSON.stringify(response.data));
            onSuccess(JSON.parse(response.data));
        })
        .catch(error => {
            console.error(error);
            onError(error);
        });
};

const placeSuggestion = () => {
    const places = document.querySelectorAll(".place");
    if (places && places.length) {
        places.forEach(placeInput => {
            const suggestion = document.createElement("div");
            const hiddenLng = document.createElement("input");
            const hiddenLat = document.createElement("input");

            suggestion.classList.add("place-suggestion");
            suggestion.dataset.input = placeInput.id;
            placeInput.addEventListener("change", e => {
                searchPlace({
                    input: placeInput.value,
                    onSuccess: response => {
                        if(!response.predictions) {
                            suggestion.innerHTML = '';

                            return;
                        }

                        response.predictions.forEach(entry => {
                            const container = document.createElement("div");
                            container.classList.add(".place-suggestion__prediction");
                            container.dataset.place_id = entry.place_id;
                            container.dataset.reference = entry.reference;
                            container.innerHTML = entry.description;

                            container.addEventListener("click", e => {
                                //
                            });
                        });
                    },
                    onError: error => {}
                });
            });
        });
    }
};

module.exports = searchPlace;
module.exports = placeSuggestion;
