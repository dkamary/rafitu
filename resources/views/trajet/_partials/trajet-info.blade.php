{{-- Trajet information --}}

@php
    $distances = $distances ?? [];
    $origin = isset($distances[$ride->id]) ? $distances[$ride->id]->origin : null;
    $destination = isset($distances[$ride->id]) ? $distances[$ride->id]->destination : null;

    $reservationCount = $ride->getReservationsCount();
    $titleOrigin = 'à environ ' . number_format($origin, 0, ',', ' ') . ' m de votre adresse de départ';
    $titleDestination = 'à environ ' . number_format($destination, 0, ',', ' ') . ' m de votre adresse d\'arrivée';
@endphp

<table role="presentation">
    <tbody>
        <tr>
            <td width="5%">
                <span class="fw-bold fs-6 trajet__horaire">{{ $ride->getDepartureDate('H:i') }}</span>
            </td>
            <td width="5%">
                <span class="trajet__point trajet__point-depart"></span>
            </td>
            <td width="70%">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="fs-5 fw-bold">{{ $ride->departure_label }}</h2>
                    <a href="{{ route('ride_show_departure', ['ride' => $ride]) }}" class="txt-rafitu">
                        <i class="fa fa-chevron-right fa-2x" aria-hidden="true"></i>
                    </a>
                </div>
            </td>
            <td width="20%" class="text-end">
                <h3 class="fs-4 fw-bold my-0">{{ number_format($ride->price, 2, ',', ' ') }}&nbsp;<sup>F CFA</sup></h3>
            </td>
        </tr>
        <tr>
            <td>
                @if($ride->duration > 0)
                <span class="text-black-50 fw-bold fs-6 trajet__duree">{{ $ride->getDuration(true) }}</span>
                @endif
            </td>
            <td>
                &nbsp;
            </td>
            <td class="pb-3" title="{{ $titleOrigin }}">

                <span class="trajet__distance-evaluation bg-{{ !is_null($origin) && $origin < 1500 ? 'success' : 'light-none' }}">
                    <img src="{{ asset('assets/img/walk-01.svg') }}" alt="">
                </span>
                <span class="trajet__distance-evaluation bg-{{ !is_null($origin) && $origin >= 1500 && $origin < 3000 ? 'warning' : 'light-none' }}">
                    <img src="{{ asset('assets/img/walk-01.svg') }}" alt="">
                </span>
                <span class="trajet__distance-evaluation bg-{{ !is_null($origin) && $origin >= 3000 ? 'danger' : 'light-none' }}">
                    <img src="{{ asset('assets/img/walk-01.svg') }}" alt="">
                </span>

            </td>
            <td class="text-end">
                <sup class="fs-6">par passager</sup>
            </td>
        </tr>
        <tr>
            <td>
                <span class="fw-bold fs-6 trajet__horaire">{{ $ride->getArrivalDate('H:i') }}</span>
            </td>
            <td>
                <span class="trajet__point trajet__point-arrivee"></span>
            </td>
            <td>
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="fs-5 fw-bold">{{ $ride->arrival_label }}</h2>
                    <a href="{{ route('ride_show_arrival', ['ride' => $ride]) }}" class="txt-rafitu">
                        <i class="fa fa-chevron-right fa-2x" aria-hidden="true"></i>
                    </a>
                </div>
            </td>
            <td>
                &nbsp;
            </td>
        </tr>
        <tr>
            <td>
                &nbsp;
            </td>
            <td>
                &nbsp;
            </td>
            <td title="{{ $titleDestination }}">
                @if (!is_null($destination))

                <span class="trajet__distance-evaluation bg-{{ !is_null($destination) && $destination < 1500 ? 'success' : 'light-none' }}">
                    <img src="{{ asset('assets/img/walk-01.svg') }}" alt="">
                </span>
                <span class="trajet__distance-evaluation bg-{{ !is_null($destination) && $destination >= 1500 && $destination < 3000 ? 'warning' : 'light-none' }}">
                    <img src="{{ asset('assets/img/walk-01.svg') }}" alt="">
                </span>
                <span class="trajet__distance-evaluation bg-{{ !is_null($destination) && $destination >= 3000 ? 'danger' : 'light-none' }}">
                    <img src="{{ asset('assets/img/walk-01.svg') }}" alt="">
                </span>

                @endif

                <div @class([
                            'fw-bold my-3 fs-6',
                            'text-danger' => ($ride->seats_available - $reservationCount) < 1,
                            'text-info' => ($ride->seats_available - $reservationCount) > 0,
                        ])>
                        Siège disponible: <span class="fw-bold">{{ $ride->seats_available - $reservationCount }}</span>
                </div>
            </td>
            <td>
                &nbsp;
            </td>
        </tr>
    </tbody>
</table>

@once
    @push('head')
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
