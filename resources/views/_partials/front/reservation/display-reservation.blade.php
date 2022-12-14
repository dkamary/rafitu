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

                        {{-- @include('_partials.front.forms.reservation-payment') --}}

                        <div class="row">
                            <div class="col-12 text-center">
                                <!-- Button trigger modal -->
                                <button type="button" class="{{ $btn_classes ?? 'btn btn-primary' }}" data-bs-toggle="modal" data-bs-target="#paymentModal">
                                    {{ $btn_text ?? 'Procéder au paiement' }}
                                </button>
                            </div>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="paymentModalLabel">Mode de paiement</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row my-4">
                                            <div class="col-12">
                                                Veuillez sélectionner votre méthode payement
                                            </div>
                                        </div>
                                        <div class="row my-4">
                                            <div class="col-6">
                                                {{-- <button class="btn btn-primary btn-block">
                                                    <i class="fa fa-paypal m-1" aria-hidden="true"></i>&nbsp;
                                                    Paypal
                                                </button> --}}
                                                @include('_partials.front.forms.paypal', [
                                                    'btn_text' => '<i class="fa fa-paypal" aria-hidden="true"></i>&nbsp;Paypal',
                                                    'btn_classes' => 'btn btn-primary btn-block',
                                                    'reservation' => $reservation,
                                                    ])
                                                <div class="row my-2">
                                                    <div class="col-12 d-flex justify-content-center align-items-center icon-payment">
                                                        <img src="{{ asset('logos/PayPal-Logo.wine.svg') }}" alt="Paypal">
                                                        <img src="{{ asset('logos/Visa_Inc.-Logo.wine.svg') }}" alt="Visa">
                                                        <img src="{{ asset('logos/Mastercard-Logo.wine.svg') }}" alt="Mastercard">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                @include('_partials.front.forms.cinetpay', [
                                                    'btn_text' => '<i class="fa fa-mobile" aria-hidden="true"></i>&nbsp;CinetPay',
                                                    'btn_classes' => 'btn btn-info btn-block',
                                                    'reservation' => $reservation,
                                                    ])
                                                <div class="row my-2">
                                                    <div class="col-12 d-flex justify-content-center align-items-center icon-payment">
                                                        <img src="{{ asset('logos/Orange_Money-Logo.wine.svg') }}" alt="Orange Money">
                                                        <img src="{{ asset('logos/mtn-mobile-money-logo.png') }}" alt="MTN Mobile Money">
                                                        <img src="{{ asset('logos/moov-money.png') }}" alt="MTN Mobile Money">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{--
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                    --}}

                                </div>
                            </div>
                        </div>

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

@once

    @push('head')
        <style id="icon-payment-styles">
            .icon-payment img {
                height: 2.5rem !important;
                width: auto !important;
                margin-left: 5px;
                margin-right: 5px;
            }
        </style>
    @endpush

@endonce
