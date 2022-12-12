{{-- Nos offres covoiturages --}}

@php
    $randomRides = RideManager::getRandom(3);
@endphp

@if (count($randomRides))

<section class="sptb position-relative ">
    <div class="container">
    <h2 class="mb-4 font-weight-semibold text-dark">Nos offres de covoiturage</h2>
        <div class="row">
            @foreach ($randomRides as $ride)

                @php
                    $title = $ride->getDepartureLabel() .' à ' . $ride->getArrivalLabel() . ' pour ' . number_format($ride->price, 2, '.', '') .' FCFA';
                @endphp

                <div class="col-xl-4 col-lg-4 col-md-12 mb-0 mt-2" title="{{ $title }}">
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
                </div>

            @endforeach
        </div>
    </div>
</section>

@endif
