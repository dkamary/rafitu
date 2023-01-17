{{-- Trajet distance --}}

@php
    $values = [
        'short' => 2000,
        'medium' => 4000,
        'long' => 6000,
    ];
    $distance = $distance ?? 0;
@endphp

<div class="trajet__distance-container mb-4">
    @if($distance == 0)
        <img src="{{ asset('images/marker-none.svg') }}" alt="">
        <img src="{{ asset('images/marker-none.svg') }}" alt="">
        <img src="{{ asset('images/marker-none.svg') }}" alt="">
    @elseif($distance > $values['medium'])
        <img src="{{ asset('images/marker-long.svg') }}" alt="">
        <img src="{{ asset('images/marker-long.svg') }}" alt="">
        <img src="{{ asset('images/marker-long.svg') }}" alt="">
    @elseif($distance > $values['short'])
        <img src="{{ asset('images/marker-medium.svg') }}" alt="">
        <img src="{{ asset('images/marker-medium.svg') }}" alt="">
    @else
        <img src="{{ asset('images/marker-short.svg') }}" alt="">
    @endif
</div>

@once

    @push('head')

        <style id="trajet-distance-styles">
            .trajet__distance-container {
                display: flex;
                justify-content: flex-start;
                align-items: center;
            }

            .trajet__distance-container img {
                height: 1.5rem;
                width: auto;
                margin-right: .6rem;
            }
        </style>

    @endpush
@endonce
