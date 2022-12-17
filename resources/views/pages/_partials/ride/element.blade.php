{{-- Affichage d'un trajet - Resultat de recherche --}}

@php
    $parameters = $parameters ?? [
        'origin' => new App\Models\Position(0, 0),
        'destination' => new App\Models\Position(0, 0),
    ];

    $showPrice = $showPrice ?? true;
    $showDetails = $showDetails ?? true;
    $showDate = $showDate ?? true;
    $showDistance = $showDistance ?? false;
    $showIcon = $showIcon ?? true;

    $reservationCount = $ride->getReservationsCount();
    $origin = $parameters['origin'];
    $destination = $parameters['destination'];

    $driver = $ride->getDriver();
    $avatar = $driver->getAvatar();
    $driverAvatar = $avatar;
    if($avatar) {
        if(strpos($avatar, 'http') !== false) {
            $driverAvatar = $avatar;
        } else {
            $driverAvatar = asset('avatars/' . $avatar);
        }
    } else {
        $driverAvatar = asset('avatars/user-01.svg');
    }
@endphp

<div class="row mb-4 border rounded ride__result py-3 {{ $loop->even ? 'bg-light' : 'bg-white' }}">
    <div class="col-12">
        <div class="row">
            <div @class([
                'col-8' => $showPrice,
                'col-12' => $showPrice ? false : true,
            ])>
                <div class="ride__info py-3">
                    @if($showDate)
                    <div class="row">
                        <div @class([
                            'col-12',
                            'd-flex justify-content-between' => $showDistance,
                        ])>
                            <h4 class="fw-bold txt-rafitu">{{ $ride->getDepartureDate('d/m/Y') }}</h4>
                            @if($showDistance)
                            <h5 class="fw-bold text-black-50">{{ $ride->getDistance() }}</h5>
                            @endif
                        </div>
                    </div>
                    @endif

                    <div class="row ride__departure">
                        <div class="col-12 py-2">
                            <h5>{{ $ride->departure_label }}</h5>
                            <h6 class="fw-bold">{{ $ride->getDepartureDate('H:m') }}</h6>

                            @if ($origin && $origin->isset())
                                @isset($distances[$ride->id])

                                    @php
                                        $title = 'à ' . number_format($distances[$ride->id]->origin, 0, ',', ' ') . ' m de votre adresse de départ';
                                    @endphp

                                    @if($showIcon)

                                        <div class="d-flex ms-5" title="{{ $title }}">
                                            <div class="walker-icon bg-{{ $distances[$ride->id]->origin < 1500 ? 'success' : 'light' }}">
                                                <img src="{{ asset('assets/img/walk-01.svg') }}" alt="" >
                                            </div>
                                            <div class="walker-icon mx-2 bg-{{ $distances[$ride->id]->origin >= 1500 && $distances[$ride->id]->origin < 3000 ? 'warning' : 'light' }}">
                                                <img src="{{ asset('assets/img/walk-01.svg') }}" alt="" >
                                            </div>
                                            <div class="walker-icon bg-{{ $distances[$ride->id]->origin >= 3000 ? 'danger' : 'light' }}">
                                                <img src="{{ asset('assets/img/walk-01.svg') }}" alt="" >
                                            </div>
                                        </div>

                                    @else

                                        @php
                                            $level = 'light';
                                            if($distances[$ride->id]->origin < 1500) {
                                                $level = 'success';
                                            }elseif($distances[$ride->id]->origin < 3000) {
                                                $level = 'warning';
                                            } elseif($distances[$ride->id]->origin > 3000)  {
                                                $level = 'danger';
                                            }
                                        @endphp
                                        <div class="ms-5 text-{{ $level }}">
                                            <em class="fw-bolder">{{ number_format($distances[$ride->id]->origin, 0, ',', ' ') }} m</em>&nbsp;de votre adresse de départ.
                                        </div>

                                    @endif

                                @endisset
                            @endif

                        </div>
                    </div>
                    <div class="row ride__arrival">
                        <div class="col-12 py-2">
                            <h5>{{ $ride->arrival_label }}</h5>
                            @if($ride->hasArrivalDate())
                                <h6 class="fw-bold">{{ $ride->getArrivalDate('H:m') }}</h6>
                            @endif

                            @if ($destination && $destination->isset())

                                @isset($distances[$ride->id])

                                    @php
                                        $title = 'à ' . number_format($distances[$ride->id]->destination, 0, ',', ' ') . ' m de votre adresse d\'arrivée';
                                    @endphp

                                    @if($showIcon)

                                        <div class="d-flex ms-5" title="{{ $title }}">
                                            <div class="walker-icon bg-{{ $distances[$ride->id]->destination < 1500 ? 'success' : 'light' }}">
                                                <img src="{{ asset('assets/img/walk-01.svg') }}" alt="" >
                                            </div>
                                            <div class="walker-icon mx-2 bg-{{ $distances[$ride->id]->destination >= 1500 && $distances[$ride->id]->destination < 3000 ? 'warning' : 'light' }}">
                                                <img src="{{ asset('assets/img/walk-01.svg') }}" alt="" >
                                            </div>
                                            <div class="walker-icon bg-{{ $distances[$ride->id]->destination >= 3000 ? 'danger' : 'light' }}">
                                                <img src="{{ asset('assets/img/walk-01.svg') }}" alt="" >
                                            </div>
                                        </div>

                                    @else

                                        @php
                                            $level = '';
                                            if($distances[$ride->id]->destination < 1500) {
                                                $level = 'success';
                                            }elseif($distances[$ride->id]->destination < 3000) {
                                                $level = 'warning';
                                            } elseif($distances[$ride->id]->destination > 3000)  {
                                                $level = 'danger';
                                            }
                                        @endphp
                                        <div class="ms-5 text-{{ $level }}">
                                            <em class="fw-bolder">{{ number_format($distances[$ride->id]->destination, 0, ',', ' ') }} m</em>&nbsp;de votre adresse d'arrivée.
                                        </div>

                                    @endif

                                @endisset

                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 py-4">

                            <a href="#" class="row" title="{{ $driver->getFullname() }}">
                                <div class="col-auto">
                                    <img src="{{ $driverAvatar }}" alt="{{ $driverAvatar }}" class="rounded-circle" style="height: 3rem;">
                                </div>
                                <div class="col-auto">
                                    <div class="row">
                                        <div class="col-12 d-flex align-items-center">
                                            <strong class="text-rafitu fs-5">{{ $driver->firstname }}</strong>
                                        </div>
                                    </div>
                                </div>
                            </a>

                        </div>
                    </div>

                </div>
            </div>
            @if($showPrice)
                <div class="col-4 py-3">
                    <div class="row">
                        <div class="col-12">Distance: <span class="fw-bold">{{ $ride->getDistance() }}</span></div>
                        <div class="col-12">Prix: <span class="fw-bold">{{ $ride->price }} F CFA</span></div>
                        <div @class([
                            'col-12 fw-bold my-3',
                            'text-danger' => ($ride->seats_available - $reservationCount) < 1,
                            'text-info' => ($ride->seats_available - $reservationCount) > 0,
                        ])>Siège disponible: <span class="fw-bold">{{ $ride->seats_available - $reservationCount }}</span></div>
                    </div>

                    @if($reservationCount == 0)

                        <p class="fw-bold fs-italic text-info">Il n'y a pas encore de réservation pour ce trajet</p>
                        @else
                        <p class="fw-bold text-warning">
                            {{ $reservationCount }} personne{{ $reservationCount > 1 ? '(s) ont' : ' a' }} réservé sur ce trajet.
                        </p>

                    @endif

                    @if($ride->woman_only)
                    <div class="row">
                        <div class="col-12 txt-rafitu fst-italic fw-boldeuro">Femme seulement</div>
                    </div>
                    @endif
                </div>
            @endif
        </div>
        @if($showDetails)
            <div class="row mb-4">
                <div class="col-12 text-center">
                    <a href="{{ route('ride_show', ['ride' => $ride,]) }}" class="btn btn-primary">
                        Voir les détails
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>

@once
    @push('head')
        <style id="search-ride-element">
            .ride__info {
                position: relative;
            }

            .ride__departure,
            .ride__arrival {
                position: relative;
            }

            .ride__departure::before,
            .ride__arrival::before {
                content: '';
                display: block;
                position: absolute;
                width: 16px;
                height: 16px;
                background-color: #ffffff;
                border: #4c6dff 2px solid;
                border-radius: 50%;
                z-index: 2;
            }


            .ride__departure::before {
                left: 10px;
                top: 10px;
            }

            .ride__departure::after {
                content: '';
                display: block;
                position: absolute;
                width: 5px;
                height: 98%;
                background: #4c6dff;
                top: 13px;
                left: 15px;
                z-index: 1;
            }

            .ride__arrival {
                margin-top: 1rem;
            }

            .ride__arrival::before {
                left: 10px;
                top: 22%;
            }

            .ride__arrival::after {
                content: '';
                display: block;
                position: absolute;
                width: 5px;
                height: 70%;
                background: #4c6dff;
                top: -13px;
                left: 15px;
                z-index: 1;
            }

            .ride__departure h5,
            .ride__arrival h5 {
                padding-left: 22px;
            }

            .ride__departure h6,
            .ride__arrival h6 {
                padding-left: 32px;
            }

            .walker-icon {
                border-radius: 50%;
                box-sizing: border-box;
                width: 1.3rem;
                height: 1.3rem;
                display: flex;
                justify-content: center;
                align-items: center;
                cursor: pointer;
            }

            .walker-icon img {
                display: block;
                width: auto;
                height: 1rem;
            }

            .walker-icon.bg-light {
                background-color: #dbdbdb !important;
            }
        </style>
    @endpush
@endonce
