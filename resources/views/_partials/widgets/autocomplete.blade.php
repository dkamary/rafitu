{{-- Auto completete plugin --}}

<style id="autocomplete__styles">
    .autocomplete {
        display: none;
        position: absolute;
        width: 100%;
        height: auto;
        background-color: #fff;
        border: solid 1px #efefef;
        box-shadow: 0px 3px 5px 0px rgba(0, 0, 0, .3);
        padding: 5px;
        transition: .8s;
        z-index: 10000;
        opacity: 0;
    }

    .autocomplete .autocomplete__item {
        padding-bottom: 5px;
    }

    .autocomplete .autocomplete__item:hover {
        font-weight: bold;
    }

</style>

@once

<script id="autocomplete__scripts">
    const autocomplete_Init = ({
        selector,
        source,
        eachItem,
        onclickItem,
    }) => {
        console.debug("autocomplete Init !!!");

        const containers = document.querySelectorAll(selector);
        if(!containers || containers.length == 0) {
            console.warn("Aucun élément autocomplete `%s` dans la page", selector);

            return;
        }

        console.debug("Initialisation des autocompletes !!!");

        containers.forEach(container => {
            source = container.dataset.source ? container.dataset.source : source;

            autocomplete_CreateWidget({
                container,
                source,
                onclickItem,
                eachItem
            });
        });
    };

    const autocomplete_CreateWidget = ({
        container,
        source,
        onclickItem,
        eachItem
    }) => {
        console.debug("Create Widget !!!");
        console.debug({
            'data-input': container.dataset.input,
            container
        })

        const input = document.querySelector(container.dataset.input);
        if(!input) {
            console.error("No input selected!!!");

            return;
        }

        console.debug("Widget Created!!!")

        autocomplete_HandleEvents({
            container,
            input,
            source,
            onclickItem,
            eachItem
        });
    };

    const autocomplete_HandleEvents = ({
        container,
        input,
        source,
        onclickItem,
        eachItem
    }) => {
        console.debug("Handle Events !!!");

        autocomplete_HandleInputEvent({ container, input, source, onclickItem});
        autocomplete_HandleKeydownEvent({ input });
    };

    const autocomplete_HandleInputEvent = ({ container, input, source, onclickItem }) => {
        console.debug("Handle Input Event !!!");

        input.addEventListener("input", e => {
            let value = input.value.trim();

            console.debug("Input:input `%s`", value);

            if(value.length == 0) {
                console.debug("No autocompletion to do!");

                return;
            }

            if(typeof source == "string") {
                const query = new URLSearchParams();
                query.append("search", value);
                query.append("field", container.dataset.field);
                const url = source + (!source.endsWith('/') ? '/' : '') + '?' + query.toString();

                if(window.controller != undefined) {
                    window.controller.abort();
                    window.controller = undefined;
                    delete(window.controller);
                } else {
                    window.controller = new AbortController();
                    window.signal = window.controller.signal;
                }

                fetch(url, { signal: window.signal })
                    .then(response => response.json())
                    .then(jsonResponse => {

                        emptySuggestion({ container });

                        if(jsonResponse.suggestions && jsonResponse.suggestions.length > 0) {
                            jsonResponse.suggestions.forEach(item => {
                                addSuggestion({
                                    container, input, item, onclickItem
                                });
                            });
                        } else {
                            console.debug("Aucun résultat");
                        }
                    })
                    .catch(err => {
                        console.error(err);
                    });

                showSuggestion({ container });

                return;
            }

            if(source.isArray()) {
                source.forEach(item => {
                    if(item.name.substr(0, value.length).toUpperCase() == value.toUpperCase()) {
                        addSuggestion({
                            container,
                            input,
                            item,
                            onclickItem
                        });
                    }
                });

                return;
            }
        });
    };

    const autocomplete_HandleKeydownEvent = ({ input }) => {
        console.debug("Handle Keydown Event !!!");

        input.addEventListener("keydown", e => {});
    }

    const addSuggestion = ({ container, input, item, onclickItem }) => {
        console.debug("Add suggestion !!!");
        console.debug({ item });

        let value = input.value.trim();
        const suggestionContainer = document.createElement("div");
        suggestionContainer.classList.add('autocomplete__item');

        const suggestion = document.createElement("a");
        const strong = document.createElement("strong");

        strong.innerHTML = item.label.substr(0, value.length);
        suggestion.append(strong);
        suggestion.append(item.label.substr(value.length));
        suggestion.href = "#";

        suggestionContainer.append(suggestion);
        container.append(suggestionContainer);

        suggestion.addEventListener("click", e => {
            e.preventDefault();
            hideSuggestion({ container });
            if(onclickItem && typeof onclickItem == "function") {
                onclickItem({ event: e, container, input, item });
            }
        });
    };

    const showSuggestion = ({ container }) => {
        container.style.display = 'inline-block';
        container.style.opacity = 1;
    };

    const hideSuggestion = ({ container }) => {
        container.style.opacity = 0;
        container.style.display = 'none';
    };

    const emptySuggestion = ({ container }) => {
        const items = container.querySelectorAll('.autocomplete__item');
        console.debug({ items });

        if(!items && items.length == 0) {
            console.debug("Aucun élément dans la liste");

            return;
        }

        items.forEach(item => {
            container.removeChild(item);
        });
    };
</script>

@endonce
