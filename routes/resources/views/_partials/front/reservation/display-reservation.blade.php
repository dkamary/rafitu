{{-- Display Reservation --}}

@php
    $ride = $ride ?? $reservation->getRide();
    $rideOptions = $rideOptions ?? [
        'ride' => $ride,
        'loop' => json_decode('{"even": "false"}'),
        'showPrice' => false,
        'showDetails' => false,
        // 'showDate' => false,
        'showDistance' => true,
    ];
    $user = Auth::user();
    $driver = $ride->getDriver();
    $message = $message ?? [
        'classes' => 'text-success',
        'content' => 'xxx'
    ];
    $arrivalDate = $ride->getDateArrival();
    $now = new \DateTime();
    $diff = $arrivalDate->diff($now);
@endphp

<div class="container">
    <div class="row">
        <div class="col-12 bg-white my-5 py-3">
            <div class="row">
                <div class="col-12 text-center">
                    <h2>Votre réservation</h2>
                </div>
            </div>
            <div class="row border-top border-bottom mt-3 py-3">
                <div class="col-12 text-center {{ $message['classes'] }} fs-4">
                    {!! $message['content'] !!}
                </div>
            </div>
            <div class="row py-3">
                <div class="col-12">
                    @include('pages._partials.ride.element', $rideOptions)
                </div>
            </div>

            <div class="row border-top border-bottom mt-3 py-3">
                <div class="col-12 d-flex justify-content-between">
                    <span>Prix</span>
                    <h3><strong>{{ $ride->price }}</strong> F CFA</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-12 d-flex justify-content-between align-items-center py-5">
                    <div>
                        <div class="fs-6">{{ $driver ? $driver->getFullname() : '' }}</div>
                        <div class="my-2"><em>Aucun avis pour le moment</em></div>
                    </div>
                    <div>
                        @if($driver)
                            <img src="{{ $driver->avatar }}" alt="" class="img-fluid border rounded-circle" alt="Avatar">
                        @endif
                    </div>
                </div>
            </div>

            @if ($ride->woman_only == 1)
            <div class="row my-3 py-5">
                <div class="col-12">
                    <span class="text-info">
                        <i class="fa fa-female" aria-hidden="true"></i> &nbsp;
                        Pour femme uniquement
                    </span>
                </div>
            </div>
            @endif

            <div class="row border-top mt-3 py-3">
                <div class="col-12">
                    @if(!$reservation->isPaid())

                        @include('_partials.front.forms.reservation-payment')

                    @elseif($diff->invert > 0)

                        <p class="text-center">
                            Vous avez déjà effectuer ce trajet
                        </p>
                        <p class="text-center">
                            Voulez-vous donner votre avis?
                        </p>

                    @else
                        <form action="#" method="post" class="form">
                            <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">
                            <div class="row">
                                <div class="col-12 d-flex justify-content-center align-items-center">
                                    <button type="submit" class="btn btn-danger">
                                        Annuler la réservation
                                    </button>
                                </div>
                            </div>
                            @csrf
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
