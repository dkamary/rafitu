{{-- Payer une réservation --}}

@extends('templates._layouts.email-base')

@php
    $user = $reservation->getuser();
    $ride = $reservation->getRide();
@endphp

@section('email_content')
    <h1>
        Une réservation a été payé
    </h1>

    <p style="margin-top: 15px  ">
        La réservation a été faite par <strong>{{ $user->getFullname() }}</strong> a été payé.
    </p>
    <div style="margin-top: 15px auto;">
        @include('templates._partials.ride-details', ['ride' => $ride, 'isAdmin' => true])
    </div>

@endsection
