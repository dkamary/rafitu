{{-- Dashboard User --}}

@extends('dashboard._layout.base')

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
    $message = $reservation->isPaid() ? '' : 'Votre réservation n\'est pas encore réglé';
    $classes = $reservation->isPaid() ? '' : 'text-warning';
    $arrivalDate = $ride->getDateArrival();
    $now = new \DateTime();
    $diff = $arrivalDate->diff($now);
@endphp

@section('meta_title')
    Ma réservation
@endsection

@section('hero')
    @include('_partials.front.section.breadcrumbs', ['page_title' => 'Ma réservation'])
@endsection

@section('dashboard_content')

    @include('trajet._partials.date', ['ride' => $ride])
    <hr>
    <div class="row mt-3 py-3">
        <div class="col-12 text-center {{ $classes }} fs-4">
            {!! $message !!}
        </div>
    </div>
    <hr>
    @include('trajet._partials.trajet-info', ['ride' => $ride, 'showPlaceLink' => false])
    <hr>
    @include('trajet._partials.chauffeur-info-details', ['ride' => $ride, 'showPreferrences' => false])
    <hr>
    @include('trajet._partials.trajet-preferrences', ['ride' => $ride])
    <hr>
    @if(!$reservation->isPaid())

        @include('_partials.front.payment.choice', [
            'reservation' => $reservation,
            'btn_classes' => 'btn btn-orange',
        ])

    @elseif($diff->invert > 0)

        <p class="text-center mb-3">
            Vous avez déjà effectuer ce trajet
        </p>

        <div class="text-center mb-3">
            <a href="#" class="btn btn-outline-info">
                <i class="fa fa-commenting" aria-hidden="true"></i>&nbsp;
                Donner votre avis
            </a>
        </div>

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

    {{-- @include('_partials.front.reservation.display-reservation', [
        'reservation' => $reservation,
        'rideOptions' => $rideOptions,
        'message' => [
            'classes' => $classes,
            'content' => $message,
        ]
    ]) --}}
@endsection
