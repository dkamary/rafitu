{{-- Suggestion --}}

@once

@include('_partials.widgets.autocomplete')

<script id="city-suggestion-script" defer async>
    window.addEventListener("DOMContentLoaded", event => {
        console.debug("autocomplete for Cities !!!");

        autocomplete_Init({
            selector: '.autocomplete',
            source: "{{ route('suggestion_ville') }}",
            onclick: ({ event, input, container, item }) => {
                console.debug("Click item!");
                console.debug({ event, input, container, item });
            }
        });
    });
</script>

@endonce
