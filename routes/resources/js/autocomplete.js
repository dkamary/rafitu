// Auto complete

class Autocomplete {
    #selector;
    #data;
    #element;
    #container;
    #items;
    #requestInProgress = false;

    constructor(options) {
        let defaultOptions = {
            selector: ".autocomplete",
            element: null,
            data: []
        };

        options = { ...defaultOptions, ...options };

        console.debug(options);

        this.init(options);
    }

    init(options) {
        console.debug("Init!");

        this.#element = options.element;
        this.#selector = options.selector;
        this.#data = options.data;

        if(!(this.#element instanceof Element || this.#element instanceof HTMLElement)) {
            console.warn("L'élément en paramètre n'est pas une instance d'un élément DOMElement!");
            console.debug("Tentative de sélection à partir du selecteur");

            this.#element = document.querySelector(this.#selector);
            if(!this.#element) {
                console.error("L'object `%s` est introuvable!!!", this.#selector);
                console.debug("Annulation de l'initialisation!");

                return;
            }
        }

        const container = document.createElement("div");
        container.classList.add('autocomplete__container');

        this.#element.after(container);

        const list = document.createElement("div");
        list.classList.add("autocomplete__listItems");
        container.appendChild(list);
        this.#container = container;
        this.#items = list;

        list.appendChild(this.loader());

        this.events();
    }

    events() {
        console.debug("Events!");

        const input = this.#element;
        const data = this.#data;

        console.debug(data);
        console.info("This is an info");

        input.addEventListener("input", event => {
            const $this = event.currentTarget;
            const value = $this.value.trim();
            if(value.length == 0) {
                console.warn("Chaine vide!");
                this.hide();

                return;
            }

            this.empty();
            this.#container.appendChild(this.loader());

            let result = [];

            if(Array.isArray(data)) {
                result = this.findInArray({ data, value });
            } else if(data instanceof String) {
                result = this.findInRequest({ data, value });
            }

            result.forEach(item => {
                this.add(item);
            });
        });
    }

    findInArray({ data, value }) {
        console.debug("Find in Array!");
        let first = true;

        return data.map(current => {
            if(current.substr(0, value.trim().length).toUpperCase() == value.toUpperCase()) {

                if(first) {
                    this.empty();
                    first = false;
                }

                const item = document.createElement("div");
                item.classList.add("autocomplete__item");
                item.innerHTML = "<strong>" + current.substr(0, value.trim().length) + "</strong>";
                item.innerHTML += current.substr(value.trim().length);

                item.addEventListener("click", e => {
                    e.preventDefault();
                    this.#element.value = current;

                    this.hide();
                });

                return item;
            }
        });
    }

    async findInRequest({ data, value }) {
        console.debug("Find in Request!");

        if(this.#requestInProgress) {
            if(window.controller instanceof AbortController) {
                window.controller.abort();
                window.controller = undefined;
                delete(window.controller);
                this.#requestInProgress = false;
            }
        } else {
            window.controller = new AbortController();
            window.signal = window.controller.signal;
        }

        this.#requestInProgress = true;

        const queryString = new URLSearchParams();
        queryString.append("search", query);
        const url = baseUrl + (!data.endsWith('/') ? '/' : '') + '?' + queryString.toString();

        const source = await fetch(url, { signal: window.signal });
        const response = await source.json();

        this.#requestInProgress = false;
        window.controller = undefined;
        delete(window.controller);

        return response.suggestions.map(suggestion => {
            const item = document.createElement("div");
            item.classList.add("autocomplete__item");
            item.innerHTML = "<strong>" + suggestion.name.substr(0, value.trim().length) + "</strong>";
            item.innerHTML += suggestion.name.substr(value.trim().length);

            return item;
        });
    }

    show() {
        this.#container.classList.add("show");
    }

    hide() {
        this.#container.classList.remove("show");
    }

    loader() {
        const loader = document.createElement("div");
        loader.classList.add("autocomplete__loader");

        const img = document.createElement("img");
        img.src = '/assets/img/loader-1.svg';
        img.style.height = "2rem";
        img.style.width = "auto";

        loader.appendChild(img);

        return loader;
    }

    empty() {
        const children = this.#items.childNodes;
        console.debug(children);

        if(!children) {
            console.debug("No children!");
            return;
        }

        children.forEach(item => {
            this.#items.removeChild(item);
        });
    }

    add(item) {
        console.debug(item);
        this.#items.append(item);
    }
}

/// APPLICATION LOGIC
departureLabelAutocomplete = new Autocomplete({
    selector: '#departure_label',
    data: ['abc', 'def', 'ghi', 'jkl', 'mno', 'pqr']
});
