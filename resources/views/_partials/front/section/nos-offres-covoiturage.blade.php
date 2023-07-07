{{-- Nos offres covoiturages --}}

@php
    $randomRides = RideManager::getRandom(3);
@endphp

@if (count($randomRides))

<section class="sptb position-relative ">
    <div class="container">
    <h2 class="mb-4 font-weight-semibold text-dark text-md-left text-center">Nos offres de covoiturage</h2>
        <div class="row">
            @foreach ($randomRides as $ride)

                @php
                    $title = $ride->getDepartureLabel() .' à ' . $ride->getArrivalLabel() . ' pour ' . number_format($ride->price, 2, '.', '') .' FCFA';
                @endphp

                <div class="col-xl-4 col-lg-4 col-md-12 my-2">
                    <a href="{{ route('ride_show', ['ride' => $ride->id]) }}" class="offre-container bg-rafitu text-white" title="{{ $title }}">
                        <div class="row">
                            <div class="col-8">
                                <div class="row text-center">
                                    <div class="col-12 fw-bold">{{ Str::limit($ride->departure_label, 50) }}</div>
                                    <div class="col-12 my-2 my-md-0"><i class="fa fa-arrow-down fa-2x" aria-hidden="true"></i></div>
                                    <div class="col-12 fw-bold">{{ Str::limit($ride->arrival_label, 50) }}</div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-0 text-end">
                                    <strong class="fs-4">{{ number_format($ride->price, 2, '.', '') }}</strong><sup>F CFA</sup>
                                </div>
                                <div class="mb-0 text-end">
                                    <em style="font-size: .8em">par passager</em>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                {{-- <div class="col-xl-4 col-lg-4 col-md-12 mb-0 mt-2" title="{{ $title }}">
                    <a href="{{ route('ride_show', ['ride' => $ride->id]) }}" class="btn btn-lg btn-block btn-primary br-ts-md-0 br-bs-md-0">
                        <div class="row">

                            <div class="col-12 d-flex justify-content-between py-4 px-1">
                                <div class="col-auto">
                                    <span>{{ $ride->getDepartureLabel(true, ' ') }}</span>
                                    <span class="px-1"><i class="fa fa-arrow-right" aria-hidden="true"></i></span>
                                    <span>{{ $ride->getArrivalLabel(true, ' ') }}</span>
                                </div>
                                <div class="col-auto">
                                    <strong>{{ number_format($ride->price, 2, '.', '') }}F CFA</strong>
                                </div>
                            </div>

                        </div>
                    </a>
                </div> --}}

            @endforeach
        </div>
    </div>
</section>

@endif


@once
    <style id="offre-style">
        .offre-container {
            display: block;
            width: 100%;
            height: 100%;
            padding: 12px;
        }

        .offre-container .address-container {
            display: flex;
            justify-content: flex-start;
            align-items: flex-start;
        }

        .offre-container .address-container.departure {
            margin-bottom: 2rem;
        }

        .address-container.departure .icon::before {
            border-radius: 50%;
        }

        .address-container.departure .icon::after {
            height: 2.5rem;
            width: .5rem;
            bottom: -2.4rem;
        }

        .address-container.arrival .icon::before {
            /* clip-path: polygon(0% 0%, 50% 100%, 100% 0%); */
            border-radius: 50%;
        }

        .address-container.arrival .icon::after {
            height: 2.5rem;
            width: .5rem;
            top: -2.4rem;
        }

        .address-container .icon {
            position: relative;
            display: block;
            width: 3rem;
            height: 1rem;
            /* margin-right: 1rem; */
        }

        .address-container .icon::before,
        .address-container .icon::after {
            content: '';
            display: block;
            width: 1rem;
            height: 1rem;
            background-color: #ffffff;
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
        }

        .address-container .text-label {
            width: calc(100% - 1rem);
            min-height: 3rem;
        }
    </style>
@endonce
