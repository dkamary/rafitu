{{-- Retour de réservation --}}

@extends('_layouts.front')

@php
    $ride = $reservation->getRide();
    $rideOptions = [
        'ride' => $ride,
        'loop' => json_decode('{"even": "false"}'),
        'showPrice' => false,
        'showDetails' => false,
        // 'showDate' => false,
        'showDistance' => true,
    ];
    $user = Auth::user();
    $driver = $ride->getDriver();
    // $title = isset($result) ? $result->getMessage() : (isset($order) ? $order->getMessage() : 'N/A');
    $title = 'Le paiement n\'a pas aboutie';
@endphp

@section('meta_title')
    {!! $title !!}
@endsection

@section('hero')
    @include('_partials.front.section.breadcrumbs', ['page_title' => $title])
@endsection

@section('main')
    <div class="container">
        <div class="row">
            <div class="col-12 col-xl-8 mx-auto bg-white my-5 py-3">

                <div class="row my-3 py-3">
                    <h2 @class([
                        'col-12 text-center fs-4',
                        'text-white',
                        'fw-bold',
                        'py-5',
                        'bg-success' => isset($result) ? $result->isSuccess() : (isset($order) ? $order->isSuccess() : false),
                        'bg-warning' => isset($result) ? $result->isWarning() : (isset($order) ? $order->isWarning() : false),
                        'bg-danger' => isset($result) ? $result->isError() : (isset($order) ? $order->isError() : false),
                    ])>
                        {!! isset($result) ? $result->getMessage() : (isset($order) ? $order->getMessage() : 'N/A') !!}
                    </h2>
                </div>

                <div class="row py-3">
                    <div class="col-12">
                        <div class="row trajet trajet__unique">
                            <div class="col-12 py-5 bg-white">

                                <h3 class="txt-rafitu text-center">
                                    Réservation du {{ DateManager::dateFr($ride->getDateDeparture()) }}
                                </h3>

                                {{-- <hr>

                                @include('trajet._partials.statut', ['ride' => $ride,]) --}}

                                <hr>

                                @include('trajet._partials.trajet-info', ['ride' => $ride,])

                                <hr>

                                @include('trajet._partials.chauffeur-info-details', ['ride' => $ride])

                                <hr>

                                @include('trajet._partials.itineraire', ['ride' => $ride, 'title' => 'L\'itinéraire du trajet'])

                                <hr>

                                @if (isset($reservation))
                                    @if($reservation->isPaid())
                                        @include('trajet.forms.reservation-cancel', ['reservation' => $reservation, 'btn_text' => 'Annuler la réservation'])
                                    @else
                                        @include('_partials.front.payment.choice', ['reservation' => $reservation, 'btn_classes' => 'btn btn-orange btn-xs mx-2', 'buttonOnly' => false])
                                    @endif
                                @else
                                    @include('trajet.forms.reservation', ['ride' => $ride])
                                @endif

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
