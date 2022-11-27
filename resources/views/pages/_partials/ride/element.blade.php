{{-- Affichage d'un trajet - Resultat de recherche --}}

@php
    $showPrice = $showPrice ?? true;
    $showDetails = $showDetails ?? true;
    $showDate = $showDate ?? true;
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
                        <div class="col-12">
                            <h4 class="fw-bold txt-rafitu">{{ $ride->getDepartureDate('d/m/Y') }}</h4>
                        </div>
                    </div>
                    @endif

                    <div class="row ride__departure">
                        <div class="col-12 py-2">
                            <h5>{{ $ride->departure_label }}</h5>
                            <h6 class="fw-bold">{{ $ride->getDepartureDate('H:m') }}</h6>
                        </div>
                    </div>
                    <div class="row ride__arrival">
                        <div class="col-12 py-2">
                            <h5>{{ $ride->arrival_label }}</h5>
                            @if($ride->hasArrivalDate())
                                <h6 class="fw-bold">{{ $ride->getArrivalDate('H:m') }}</h6>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @if($showPrice)
                <div class="col-4 py-3">
                    <div class="row">
                        <div class="col-12">Prix: <span class="fw-bold">{{ $ride->price }} F CFA</span></div>
                        <div class="col-12">Siège disponible: <span class="fw-bold">{{ $ride->seats_available }}</span></div>
                    </div>

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
                top: 2px;
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
        </style>
    @endpush
@endonce
