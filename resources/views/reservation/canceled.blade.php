{{-- Récapitulatif réservation --}}


@extends('_layouts.front')

@php
    $title = $title ?? 'La réservation a été annulée';
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
        <div class="col-12 py-7 bg-white">

            @include('trajet._partials.date', ['ride' => $ride])

            <hr>

            @include('trajet._partials.trajet-info', ['ride' => $ride, 'showPlaceLink' => false])

            <hr>

            @include('reservation._partials.details', ['ride' => $ride])

            <hr>

        </div>
    </div>
</div>
@endsection
