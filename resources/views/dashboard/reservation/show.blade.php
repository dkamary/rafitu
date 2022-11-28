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
@endphp

@section('meta_title')
    Ma réservation
@endsection

@section('hero')
    @include('_partials.front.section.breadcrumbs', ['page_title' => 'Ma réservation'])
@endsection

@section('dashboard_content')
    @include('_partials.front.reservation.display-reservation', [
        'reservation' => $reservation,
        'rideOptions' => $rideOptions,
        'message' => [
            'classes' => $classes,
            'content' => $message,
        ]
    ])
@endsection
