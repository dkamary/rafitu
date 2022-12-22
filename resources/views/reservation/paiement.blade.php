{{-- Récapitulatif réservation --}}


@extends('_layouts.front')

@php
    $title = $title ?? 'Récapitulatif de la réservation';
    $ride = $reservation->getRide();
@endphp

@section('meta_title')
    {{ $title }}
@endsection

@section('hero')
    @include('_partials.front.section.breadcrumbs', ['page_title' => $title])
@endsection

@section('main')
<div class="container {{ $classList ?? '' }}">
    <div class="row trajet trajet__unique">
        <div class="col-12 py-5 bg-white">

            @include('trajet._partials.trajet-info', ['ride' => $ride, 'showPlaceLink' => false])

            <hr>

            @include('reservation._partials.details', ['ride' => $ride])

            <hr>

            @include('paiement._partials.mode-de-paiement', ['reservation' => $reservation,])

        </div>
    </div>
</div>
@endsection
