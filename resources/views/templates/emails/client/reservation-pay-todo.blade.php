{{-- Annulation de réservation --}}

@extends('templates._layouts.email-base')

@php
    $user = $reservation->getuser();
    $ride = $reservation->getRide();
@endphp

@section('email_content')
    <h1>
        Votre réservation n'a pas été encore réglée
    </h1>

    <div style="margin-top: 15px auto;">
        <p class="my-3">
            Veuillez procéder au paiement de la réservation.
        </p>
        @include('templates._partials.ride-details', ['ride' => $ride, 'isAdmin' => false,])
    </div>

    <p style="margin-top: 15px  ">
        L'équipe RAFITU.
    </p>

@endsection
