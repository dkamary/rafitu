{{-- Nouveau trajet ajouté --}}

@extends('templates._layouts.email-base')

@php
    $owner = $ride->getOwner();
@endphp

@section('email_content')
    <h1>
        Nous avons un nouveau trajet
    </h1>

    <p style="margin-top: 15px  ">
        Un nouveau trajet a été ajouter par <strong>{{ $owner->getFullname() }}</strong>.
    </p>
    <div style="margin-top: 15px auto;">
        @include('templates._partials.ride-details', ['ride' => $ride, 'isAdmin' => true])
    </div>

@endsection
