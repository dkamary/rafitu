{{-- Suggestion pour les trajets --}}

@once

<script id="trajet-suggestion-script" defer async>
    window.addEventListener('DOMContentLoaded', e => {
        console.debug("Trajet suggestion!!!");

        const inputs = document.querySelectorAll('.trajet-suggestion');
        if(!inputs || inputs.length == 0) {
            console.warn('No input for ride suggestions!!!');
            return;
        }

        console.debug(`${inputs.length} input(s) trajet suggestion found!`);

        inputs.forEach(input => {
            const form = document.querySelector(input.dataset.form);
            if(!form) {
                console.warn("Unable to select the form parent!");
                return;
            }

            input.parentElement.style.position = 'relative';
            input.setAttribute('autocomplete', 'off');

            const hidden = createTrajetHidden();
            input.after(hidden);

            const suggestionList = createTrajetSuggestion({ input });
            input.after(suggestionList);

            ['keyup'].forEach(eventName => {
                input.addEventListener(eventName, e => {
                    handleTrajetFetchCancel();

                    const data = new FormData();
                    data.append('search', input.value.trim());
                    data.append('count', 10);
                    data.append('_token', form.querySelector('input[name="_token"]').value);
                    data.append('field', input.dataset.field ? input.dataset.field : input.name);

                    fetch('{{ route('city_search_ride') }}', {
                        method: 'POST',
                        mode: 'cors',
                        body: data,
                        signal: signal,
                    })

                    .then(response => response.json())

                    .then(jsonResponse => {
                        hideAllTrajetSuggestion();

                        showTrajetSuggestion(suggestionList);
                        suggestionList.replaceChildren();

                        if(!jsonResponse.rides || jsonResponse.rides.length == 0) {
                            console.debug("No results");
                            const msg = document.createElement('em');
                            msg.innerHTML = 'Aucune correspondance';
                            suggestionList.appendChild(msg);

                            return;
                        }

                        const ul = document.createElement('ul');
                        ul.classList.add('suggestion__ride-list');
                        suggestionList.appendChild(ul);
                        let k = 0;
                        jsonResponse.rides.forEach(ride => {
                            const li = document.createElement('li');
                            const a = document.createElement('a');
                            a.href = '#';
                            a.innerText = ride.label;
                            li.appendChild(a);
                            ul.appendChild(li);
                            a.addEventListener('click', e => {
                                e.preventDefault();
                                input.value = ride.label;
                                hidden.value = ride.id;
                                console.debug({
                                    ride,
                                    value: hidden.value,
                                })
                                hideTrajetSuggestion(suggestionList);
                            });
                        });
                    });
                });
            });

            ['blur', 'focusout', 'focus', 'focusin'].forEach(eventName => {
                input.addEventListener(eventName, e => {
                    setTimeout(() => {
                        hideAllTrajetSuggestion();
                    }, 500);
                });
            });
        });
    });

    const createTrajetHidden = () => {
        const ride = document.createElement('input');
        ride.type = 'hidden';
        ride.id = 'ride_id';
        ride.name = 'ride_id';

        return ride;
    }

    const createTrajetSuggestion = ({ input }) => {
        const suggestionList = document.createElement('div');
        suggestionList.classList.add('suggestion__container', 'bg-white', 'p-3');

        suggestionList.style.position = 'absolute';
        suggestionList.style.top = (input.offsetTop + input.offsetHeight) + 'px';
        suggestionList.style.left = input.offsetLeft + 'px';
        suggestionList.style.transition = '1s';
        suggestionList.style.opacity = 0;
        suggestionList.style.boxShadow = '0px 3px 5px 0px rgba(0, 0, 0, .3)';
        suggestionList.style.height = '1px';
        suggestionList.style.width = 'auto';
        suggestionList.style.minWidth = '400px';
        suggestionList.style.overflowY = 'hidden';
        suggestionList.style.zIndex = 10000;
        suggestionList.style.borderTop = 'solid 1px lightgray';
        suggestionList.style.borderBottom = 'solid 1px lightgray';

        return suggestionList;
    };

    const hideAllTrajetSuggestion = () => {
        const suggestions = document.querySelectorAll('.suggestion__container');
        if(!suggestions || suggestions.length == 0) {
            console.debug("No suggestion container to hide!");
            return;
        }

        suggestions.forEach(suggestionList => {
            hideTrajetSuggestion(suggestionList);
        });
    };

    const hideTrajetSuggestion = (suggestionList) => {
        suggestionList.style.opacity = 0;
        suggestionList.replaceChildren();
    };

    const showTrajetSuggestion = (suggestionList) => {
        suggestionList.style.opacity = 1;
        suggestionList.style.height = 'auto';
    };

    const handleTrajetFetchCancel = () => {
        if(window.controller) {
            window.controller.abort();
        }
        window.controller = new AbortController();
        window.signal = window.controller.signal;
    }
</script>

@endonce
