{{-- Nouvelle Réservation --}}

@extends('templates._layouts.email-base')

@php
    $user = $reservation->getuser();
    $ride = $reservation->getRide();
@endphp

@section('email_content')
    <h1>
        Une réservation a été faite par <strong>{{ $user->getFullname() }}</strong>
    </h1>

    <div style="margin-top: 15px auto;">
        @include('templates._partials.ride-details', ['ride' => $ride, 'isAdmin' => false,])
    </div>

    <p style="margin-top: 15px  ">
        L'équipe RAFITU.
    </p>

@endsection
