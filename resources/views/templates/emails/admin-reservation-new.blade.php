{{-- Nouvelle réservation ajouté --}}

@extends('templates._layouts.email-base')

@php
    $user = $reservation->getuser();
    $ride = $reservation->getRide();
@endphp

@section('email_content')
    <h1>
        Nous avons une nouvelle réservation
    </h1>

    <p style="margin-top: 15px  ">
        Une nouvelle réservation a été faite par <strong>{{ $user->getFullname() }}</strong>.
    </p>
    <div style="margin-top: 15px auto;">
        @include('templates._partials.ride-details', ['ride' => $ride])
    </div>

@endsection
