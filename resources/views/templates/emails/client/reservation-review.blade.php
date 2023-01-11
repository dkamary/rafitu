{{-- Annulation de réservation --}}

@extends('templates._layouts.email-base')

@php
    $user = $reservation->getuser();
    $ride = $reservation->getRide();
@endphp

@section('email_content')
    <h1>
        Votre avis sur le trajet que vous avez fait nous intéresse
    </h1>

    <div style="margin: 15px auto;">
        <p class="my-3">
            Afin d'améliorer nos services, nous avons besoin de votre avis sur le trajet que vous avez fait
        </p>
        @include('templates._partials.ride-details', ['ride' => $ride, 'isAdmin' => false,])
    </div>

    <div style="margin: 20px auto;">
        <a href="{{ route('review_add', ['reservation' => $reservation]) }}" style="background-color: #4c6dff; color: #fff; padding: 1rem 1.7rem; text-align: center; font-size: 1.2rem;">
            Donner un avis
        </a>
    </div>

    <p style="margin: 20px auto; ">
        L'équipe RAFITU.
    </p>

@endsection
