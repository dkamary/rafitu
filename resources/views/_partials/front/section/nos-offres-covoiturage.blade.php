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

                <div class="col-xl-4 col-lg-4 col-md-12 mb-0 mt-2">
                    <a href="{{ route('ride_show', ['ride' => $ride->id]) }}" class="btn btn-lg btn-block btn-primary br-ts-md-0 br-bs-md-0">
                        <div class="row">
                            <div class="col">
                                {{ $ride->getDepartureLabel(true) }}
                            </div>
                            <div class="col justify-content-center align-items-center">
                                <i class="fa fa-arrow-right" aria-hidden="true"></i>
                            </div>
                            <div class="col">
                                {{ $ride->getArrivalLabel(true) }}
                            </div>
                            <div class="col-12">
                                <strong>{{ number_format($ride->price, 2, '.', '') }}F CFA</strong>
                            </div>
                        </div>
                    </a>
                </div>

            @endforeach
        </div>
    </div>
</section>

@endif
