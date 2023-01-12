{{-- Front office JavaScripts --}}

<!-- JQuery js-->
<script src="{{ asset('assets/js/jquery.js') }}"></script>

<!-- Bootstrap js -->
<script src="{{ asset('assets/plugins/bootstrap/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

<!--JQuery Sparkline Js-->
<script src="{{ asset('assets/js/vendors/jquery.sparkline.min.js') }}"></script>

<!-- Circle Progress Js-->
<script src="{{ asset('assets/js/vendors/circle-progress.min.js') }}"></script>

<!-- Star Rating-2 Js-->
<script src="{{ asset('assets/plugins/ratings-2/jquery.star-rating.js') }}"></script>
<script src="{{ asset('assets/plugins/ratings-2/star-rating.js') }}"></script>

<!--Counters -->
<script src="{{ asset('assets/plugins/counters/counterup.min.js') }}"></script>
<script src="{{ asset('assets/plugins/counters/waypoints.min.js') }}"></script>
<script src="{{ asset('assets/plugins/counters/numeric-counter.js') }}"></script>

<!--Owl Carousel js -->
<script src="{{ asset('assets/plugins/owl-carousel/owl.carousel.js') }}"></script>
<script src="{{ asset('assets/js/owl-carousel.js') }}"></script>

<!--Horizontal Menu-->
<script src="{{ asset('assets/plugins/Horizontal2/Horizontal-menu/horizontal.js') }}"></script>

<!--JQuery TouchSwipe js-->
<script src="{{ asset('assets/js/jquery.touchSwipe.min.js') }}"></script>

<!--Select2 js -->
<script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/js/select2.js') }}"></script>

<!-- sticky Js-->
<script src="{{ asset('assets/js/sticky.js') }}"></script>
<script src="{{ asset('assets/js/custom-sticky.js') }}"></script>

<!-- Cookie js -->
<script src="{{ asset('assets/plugins/cookie/jquery.ihavecookies.js') }}"></script>
<script src="{{ asset('assets/plugins/cookie/cookie.js') }}"></script>

<!-- p-scroll bar Js-->
<script src="{{ asset('assets/plugins/pscrollbar/pscrollbar.js') }}"></script>

<!-- Swipe Js-->
<script src="{{ asset('assets/js/swipe.js') }}"></script>

<!-- Custom Js-->
<script src="{{ asset('assets/js/custom.js') }}"></script>

{{-- Google Maps API --}}
{{-- @yield('google_maps', view('_partials.front.google-maps.default-maps')) --}}

<script id="auto-complete-homepage-script">
    var suggestionContainer = undefined;
    var timeoutQuery = 0;
    var inExecution = false;
    var clickOutsite = false;
    var googleAutocompleteService = undefined;
    var geocoderService = undefined;
    var placesService = undefined;
    var hiddenMap = undefined;
    var hiddenElement = undefined;

    const autocompleteCity = ({ selector, src, field, delay, onClick }) => {
        let defaultOptions = {
            selector: '.autocomplete-city',
            src: '{{ route('suggestion_ville') }}',
            delay: 600
        };

        let options = {
            selector: selector ? selector : defaultOptions.selector,
            src: src ? src : defaultOptions.src,
            delay: delay ? delay : defaultOptions.delay,
            onClick,
            field,
            suggestionContainer: null,
        };

        const input = document.querySelector(selector);
        if(!input) {
            console.error("Impossible de sélectionner : %s", selector);

            return;
        }

        input.setAttribute("autocomplete", "off");
        input.parentElement.style.position = "relative";

        buildSuggestionContainer({ options, input });
        manageClickOutside();

        window.controller = new AbortController();
        window.signal = window.controller.signal;

        input.addEventListener("input", e => {
            // console.debug("input event!!!");
            // console.debug({
            //     timeoutQuery
            // });

            if(timeoutQuery != 0) {
                // console.debug("stop the next query and create new timeout!");

                clearTimeout(timeoutQuery);
            }

            timeoutQuery = setTimeout(() => {
                startSearch({
                    input
                });

                console.debug({ inExecution });
                if(!inExecution) {
                    console.debug("Requete en cours d'éxécution!");

                } else {
                    console.warn("Abort current Fetch!");

                    window.controller.abort();
                    clearTimeout(timeoutQuery);
                    inExecution = false;
                    console.debug({ inExecution });

                    console.debug("New instance of AbortController!");
                    window.controller = new AbortController();
                    window.signal = window.controller.signal;
                }

                setTimeout(() => {
                    search({ options, input });
                }, 500);

            }, delay);

            console.debug({
                timeoutQuery
            });
        });
    };

    const buildSuggestionContainer = ({ options, input }) => {
        options.suggestionContainer = document.createElement("div");
        options.suggestionContainer.classList.add("suggestion__container");

        input.after(options.suggestionContainer);
    };

    const buildSuggestionContainerOld = (params) => {
        // console.debug("Build Container!");

        if(suggestionContainer) {
            // console.debug("Le conteneur des suggestions est déjà créé!");

            return;
        }

        suggestionContainer = document.createElement("div");
        suggestionContainer.classList.add("suggestion__container");

        const body = document.querySelector("body");
        if(!body) {
            console.error("Impossible de sélectionner Body!!!!");
            return;
        }

        body.appendChild(suggestionContainer);
    };

    const manageClickOutside = () => {
        if(clickOutsite) {
            // console.debug("Click outside already defined!");

            return;
        }

        document.addEventListener("click", e => {
            const elements = document.querySelectorAll('autocomplete');
            let targetEl = e.target;
            let inside = false;
            do {

                elements.forEach(elt => {
                    if(targetEl == elt) {
                        // console.debug("Click inside!");
                        inside = true;
                        return false;
                    }
                });

                if(inside) break;

            } while(targetEl = targetEl.parentNode);

            if(!inside) {
                // console.debug("Click outsite");
                hideResult();
            }
        });
    };

    const startSearch = ({ input }) => {
        input.classList.add("start-search");
    };

    const endSearch = ({ input }) => {
        input.classList.remove("start-search");
    };

    const search = ({ options, input }) => {
        inExecution = true;
        console.debug({ inExecution });

        if(input.value.trim().length == 0) {
            inExecution = false;
            // console.debug("Aucune requête!");
            hideResult();
            return;
        }

        // search
        if(options.src == 'google') {
            searchGoogle({ options, input })
        } else if (options.src.includes('http')) {
            searchUrl({ options, input });
        } else if (Array.isArray(options.src)) {
            ;
        }

        displayLoader({ options });
    };

    const searchGoogle = ({ options, input }) => {
        // console.debug("Search Google");

        if(googleAutocompleteService == undefined) {
            // console.info("Google Autocomple Service!");

            googleAutocompleteService = new google.maps.places.AutocompleteService();

            console.debug({ googleAutocompleteService });
        }

        if(geocoderService == undefined) {
            // console.info("Google Geocoder Service!");

            geocoderService = new google.maps.Geocoder();

            // console.debug({ geocoderService });
        }

        if(placesService == undefined) {
            // console.info("Google Places Service!");
            hiddenElement = document.createElement("div");
            document.body.append(hiddenElement);
            hiddenMap = new google.maps.Map(hiddenElement, { center: { lat: -33.66, lng: 151.196 }, zoom: 14 });

            placesService = new google.maps.places.PlacesService(hiddenMap);

            console.debug({ placesService });
        }

        const value = input.value;
        googleAutocompleteService.getQueryPredictions({ input: value.trim() }, (predictions, status) => {
            console.debug({
                status,
                predictions
            });

            if(google.maps.places.PlacesServiceStatus.OK != status || !predictions) {
                // console.debug("Aucun résultat!");

                displayResult({ options, input, results: [] });

                return;
            }

            // console.debug("Display Google Result!");

            const suggestions = predictions;
            options.suggestionContainer.innerHTML = '';
            options.suggestionContainer.classList.add("show");

            const rect = input.getBoundingClientRect();
            options.suggestionContainer.style.width = rect.width + 'px';
            options.suggestionContainer.style.left = (input.offsetLeft) + 'px';

            console.info({
                rect,
                inputID: input.id
            });

            if(!suggestions || suggestions.length == 0) {
                // console.debug("Aucune correspondance!");

                const div = document.createElement("div");
                div.innerHTML = "Aucune correspondance";

                options.suggestionContainer.appendChild(div);

                return;
            }

            // console.debug("Il y a des éléments");
            // console.debug({
            //     suggestions
            // });

            const ul = document.createElement("ul");
            options.suggestionContainer.appendChild(ul);

            suggestions.forEach(element => {
                const li = document.createElement("li");
                const a = document.createElement("a");
                a.href = "#";
                a.innerHTML = element.description;
                li.appendChild(a);
                ul.appendChild(li);

                // console.debug("Adding: %s", element.description);

                a.addEventListener("click", e => {
                    e.preventDefault();

                    input.value = element.description;
                    hideResult();

                    if(typeof options.onClick == "function") {
                        console.debug("Custom OnClick event!");

                        placesService.getDetails({
                            placeId: element.place_id,
                            fields: ["geometry"]
                        }, (place, status) => {
                            console.debug({
                                status,
                                place
                            });

                            if(status == google.maps.places.PlacesServiceStatus.OK && place) {

                                options.onClick({
                                    element: {
                                        name: element.description,
                                        longitude: place.geometry.location.lng(),
                                        latitude: place.geometry.location.lat(),
                                    },
                                    input
                                });
                            }
                        });
                    }
                });
            });
        });
    };

    const searchUrl = ({ options, input }) => {
        // console.debug("Search URL");

        const value = input.value.trim();

        const query = new URLSearchParams();
        query.append('search', value);

        if(options.field) {
            query.append('field', options.field);
        }

        const url = options.src;
        fetch(url + '?' + query.toString(), {
            signal
        })
        .then(response => response.json())
        .then(jsonResponse => {
            console.debug(jsonResponse);

            endSearch({
                input
            });

            displayResult({
                options,
                input,
                results: jsonResponse
            });

            inExecution = false;
            console.debug({ inExecution });
        })
        .catch(err => {
            console.error(err);
            inExecution = false;
            console.debug({ inExecution });
        });

        clearTimeout(timeoutQuery);
        timeoutQuery = 0;
    };

    const displayLoader = ({
        options
    }) => {
        options.suggestionContainer.innerHTML = '<span>Recherche en cours </span><img src="{{ asset('assets/img/loader-1.svg') }}" style="height: 1.5rem; width: auto;" />';
        options.suggestionContainer.classList.add("show");
    };

    const displayResult = ({
        options,
        input,
        results
    }) => {

        // console.debug("Display result!");

        const suggestions = results.suggestions;
        options.suggestionContainer.innerHTML = '';
        options.suggestionContainer.classList.add("show");

        const rect = input.getBoundingClientRect();
        options.suggestionContainer.style.width = rect.width + 'px';
        // options.suggestionContainer.style.top = (rect.height + 5) + 'px';
        options.suggestionContainer.style.left = (input.offsetLeft) + 'px';

        console.info({
            rect,
            inputID: input.id
        });

        if(!suggestions || suggestions.length == 0) {
            // console.debug("Aucune correspondance!");

            const div = document.createElement("div");
            div.innerHTML = "Aucune correspondance";

            options.suggestionContainer.appendChild(div);

            return;
        }

        // console.debug("Il y a des éléments");
        // console.debug({
        //     results,
        //     suggestions
        // });

        const ul = document.createElement("ul");
        options.suggestionContainer.appendChild(ul);

        suggestions.forEach(element => {
            const li = document.createElement("li");
            const a = document.createElement("a");
            a.href = "#";
            a.innerHTML = element.name;
            li.appendChild(a);
            ul.appendChild(li);

            console.debug("Adding: %s", element.name);

            a.addEventListener("click", e => {
                e.preventDefault();

                input.value = element.name;
                hideResult();

                if(typeof options.onClick == "function") {
                    console.debug("Custom OnClick event!");

                    options.onClick({
                        element,
                        input
                    });
                }
            });
        });
    };

    const hideResult = () => {
        // console.debug("Hide result!");

        const elements = document.querySelectorAll(".suggestion__container");

        elements.forEach(elt => {
            elt.classList.remove("show");
        });
    };
</script>

<script id="jquery-functionalities">
    (function($){

        $(function(){
            const $document = $(document);
            const $viewport = $('html, body');
            $document
                .on('click', '.scroll-to', e => {
                    e.preventDefault();
                    const $this = $(e.currentTarget);
                    const $target = $($this.attr('href'));
                    $viewport.animate({
                        scrollTop: $target.offset().top - 32
                    }, 1000);
                });
        });

    }(window.jQuery));
</script>
