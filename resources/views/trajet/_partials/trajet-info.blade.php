{{-- Trajet information --}}

@php
    $distances = $distances ?? [];
    $origin = isset($distances[$ride->id]) ? $distances[$ride->id]->origin : null;
    $destination = isset($distances[$ride->id]) ? $distances[$ride->id]->destination : null;

    $showPlaceLink = $showPlaceLink ?? true;

    $siegeDisponibles = $ride->getSeatsAvailable();
    $titleOrigin = 'à environ ' . number_format($origin, 0, ',', ' ') . ' m de votre adresse de départ';
    $titleDestination = 'à environ ' . number_format($destination, 0, ',', ' ') . ' m de votre adresse d\'arrivée';
@endphp

<div class="trajet__presentation">

    <div class="ligne">
        <div class="colonne horaire">
            <strong class="fw-bold fs-6">{{ $ride->getDepartureDate('H:i') }}</strong>
        </div>
        <div class="colonne point point-depart">
            <span></span>
        </div>
        <div class="colonne trajet-label">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="fs-5 fw-bold">{{ $ride->departure_label }}</h2>
                @if($showPlaceLink)
                <a href="{{ route('ride_show_departure', ['ride' => $ride]) }}" class="txt-rafitu">
                    <i class="fa fa-chevron-right fa-2x" aria-hidden="true"></i>
                </a>
                @endif
            </div>
        </div>
        <div class="colonne prix text-end">
            <h3 class="fs-4 fw-bold my-0">{{ number_format($ride->price, 0, ',', ' ') }}&nbsp;<sup>F CFA</sup></h3>
        </div>
    </div>

    <div class="ligne">
        <div class="colonne duration">
            @if($ride->duration > 0)
                <span class="text-black-50 fw-bold fs-6">{{ $ride->getDuration(true) }}</span>
            @endif
        </div>
        <div class="colonne trait">
            <span></span>
        </div>
        <div class="colonne distance">
            @include('trajet._partials.trajet-distance', ['distance' => $origin])
        </div>
        <div class="colonne text-end">
            <sup class="fs-6">par passager</sup>
        </div>
    </div>

    <div class="ligne">
        <div class="colonne horaire">
            <strong class="fw-bold fs-6">{{ $ride->getArrivalDate('H:i') }}</strong>
        </div>
        <div class="colonne point point-arrivee">
            <span></span>
        </div>
        <div class="colonne trajet-label">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="fs-5 fw-bold">{{ $ride->arrival_label }}</h2>
                @if($showPlaceLink)
                <a href="{{ route('ride_show_arrival', ['ride' => $ride]) }}" class="txt-rafitu">
                    <i class="fa fa-chevron-right fa-2x" aria-hidden="true"></i>
                </a>
                @endif
            </div>
        </div>
        <div class="colonne prix">
            &nbsp;
        </div>
    </div>

    <div class="ligne">
        <div class="colonne"></div>
        <div class="colonne"></div>
        <div class="colonne">
            @include('trajet._partials.trajet-distance', ['distance' => $origin])

            <div @class([
                        'fw-bold my-3 fs-6',
                        'text-danger' => $siegeDisponibles < 1,
                        'text-info' => $siegeDisponibles > 0,
                    ])>
                    Siège disponible: <span class="fw-bold">{{ $siegeDisponibles }}</span>
            </div>
        </div>
        <div class="colonne"></div>
    </div>

    <div class="ligne-mobile my-5">
        <h3 class="fs-3 fw-bold my-0">{{ number_format($ride->price, 0, ',', ' ') }}&nbsp;<sup>F CFA</sup></h3>
        <h4 class="fs-4 ms-1 my-0">par passager</h4>
    </div>
</div>

@once
    @push('head')
        <style id="trajet-presentaion-styles">
            .ligne {
                display: flex;
                flex-wrap: wrap;
            }

            .colonne {
                max-width: 100%;
            }

            .colonne:nth-child(1) {
                width: 5%;
            }

            .colonne:nth-child(2) {
                width: 5%;
            }

            .colonne:nth-child(3) {
                width: 70%;
            }

            .colonne:nth-child(4) {
                width: 20%;
            }

            .colonne.point,
            .colonne.trait {
                position: relative;
            }

            .colonne.trait {
                text-align: center;
            }

            .colonne.point span {
                display: block;
                width: 1rem;
                height: 1rem;
                border-radius: 50%;
                border: solid 4px #4c6dff;
                background-color: #ffffff;
                position: absolute;
                left: 50%;
                transform: translateX(-50%);
                z-index: 2;
            }

            .colonne.point.point-depart::before,
            .colonne.point.point-arrivee::before {
                display: block;
                width: .5rem;
                height: 3rem;
                background-color: #4c6dff;
                left: 50%;
                transform: translateX(-50%);
                content: '';
                position: absolute;
            }

            .colonne.point.point-arrivee::before {
                top: -1rem;
                height: 2rem;
            }

            .colonne.trait span {
                display: inline-block;
                width: .5rem;
                height: 100%;
                background-color: #4c6dff;
                text-align: center;
            }

            .colonne.duration {
                display: flex;
                justify-items: center;
            }

            .ligne-mobile {
                display: none;
            }

            @media screen and (max-width: 576px) {
                .colonne.horaire {
                    width: 100%;
                }

                .colonne.prix {
                    display: none;
                }

                .colonne.trajet-label {
                    width: 100%;
                    padding-left: 2rem;
                }

                .colonne.text-end sup.fs-6 {
                    display: none;
                }

                .colonne.duration {
                    visibility: hidden;
                }

                .colonne.point span {
                    width: 1.3rem;
                    height: 1.3rem;
                }

                .colonne.point.point-depart::before {
                    top: .5rem;
                    height: 6rem;
                }

                .colonne.horaire strong {
                    padding-left: 2rem;
                }

                .colonne.point.point-arrivee::before {
                    top: -3rem;
                    height: 4rem;
                }

                .colonne.trait span {
                    visibility: hidden;
                }

                .ligne-mobile {
                    display: flex;
                    justify-content: center;
                    align-items: baseline;
                }

                .trajet__distance-container.mb-4 {
                    margin-bottom: 3rem;
                }
            }
        </style>
        <style id="trajet-styles">
            .trajet table {
                width: 100%;
            }

            .trajet__point {
                display: block;
                position: relative;
                width: 1.5rem;
                height: 1.5rem;
                border-radius: 50%;
                background-color: #ffffff;
                border: solid 4px #4c6dff;
                margin-left: auto;
                margin-right: auto;
                z-index: 2;
            }

            .trajet__point::before {
                content: '';
                width: 7px;
                height: 2.5rem;
                background-color: #4c6dff;
                position: absolute;
                z-index: 1;
                left: 50%;
                transform: translateX(-50%);
            }

            .trajet__point-depart::before {
                top: 1.1rem;
            }

            .trajet__point-arrivee::before {
                bottom: 1.1rem;
            }

            .trajet__distance-evaluation {
                display: inline-flex;
                width: 1.6rem;
                height: 1.6rem;
                margin-right: 7px;
                border-radius: 50%;
                background-color: #ededed;
                justify-content: center;
                align-items: center;
            }

            .trajet__distance-evaluation img {
                height: 1.3rem;
                width: auto;
            }
        </style>
    @endpush
@endonce
