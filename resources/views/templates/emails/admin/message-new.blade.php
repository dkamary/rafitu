{{-- Payer une réservation --}}

@extends('templates._layouts.email-base')

@php
    $client = $message->getClient();
@endphp

@section('email_content')
    <h1>
        Vous avez reçu un nouveau message
    </h1>

    <p style="margin-top: 15px  ">
        Vous avez reçu un message de <strong>{{ $client->getFullname() }}</strong>
    </p>
    <div style="margin-top: 15px auto;">
        <div class="quote">
            {{ $message->content }}
        </div>
    </div>

@endsection
