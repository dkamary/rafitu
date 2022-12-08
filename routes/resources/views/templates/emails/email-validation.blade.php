{{-- Email validation --}}

@extends('templates._layouts.email-base')

@section('email_content')
    <h1>
        Merci pour votre inscription
    </h1>
    <h2>
        Vérifier votre email
    </h2>
    <p>
        Bonjour {{ $user->firstname }} {{ $user->lastname }}, <br>
        Vous y êtes presque, cliquez sur le bouton ci-dessous pour finaliser votre inscription.
    </p>
    <p style="margin: 15px auto;">
        <a href="{{ route('confirm_email', ['token' => $user->token, 'email' => $user->email]) }}" style="border: none; background: #0096c9; color: #fff; padding: 7px 10px; text-align: center; text-decoration: none; text-transform: uppercase;">Vérifier votre email</a>
    </p>
    <p>
        Merci,<br>
        L'équipe RAFITU
    </p>
    <p style="margin: 15px auto;">
        Contactez-nous au: <a href="tel:+1234567890">+1 23 45 67 89</a>
    </p>
@endsection
