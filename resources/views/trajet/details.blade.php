{{-- Trajet details --}}


@extends('_layouts.front')

@php
    $title = $title ?? 'Détails du trajet';
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

            @include('trajet._partials.date', ['ride' => $ride])

            <hr>

            @include('trajet._partials.statut', ['ride' => $ride,])

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
@endsection
