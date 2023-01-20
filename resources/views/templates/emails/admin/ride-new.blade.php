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
        Un nouveau trajet a été ajouter par <strong>{{ $owner->getFullname() }}</strong>.<br>
        Cliquez ici pour voir les <a href="{{ route('admin_ride_show', ['ride' => $ride->id]) }}" style="color: rgb(40, 44, 170)">details</a>.
    </p>
    <div style="margin-top: 15px auto;">
        @include('templates._partials.ride-details', ['ride' => $ride, 'isAdmin' => true])
    </div>

@endsection
