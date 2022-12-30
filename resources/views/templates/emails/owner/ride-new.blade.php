{{-- Nouveau trajet --}}

@extends('templates._layouts.email-base')

@php
    $owner = $ride->getOwner();
@endphp

@section('email_content')
    <h1>
        Votre trajet a bien été pris en compte
    </h1>

    <div style="margin-top: 15px auto;">
        @include('templates._partials.ride-details', ['ride' => $ride, 'isAdmin' => false])
    </div>

    <p style="margin-top: 15px  ">
        L'équipe RAFITU.
    </p>

@endsection
