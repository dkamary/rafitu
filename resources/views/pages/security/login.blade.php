{{-- Login --}}

@php
    $discussionBalloon = false;
@endphp

@extends('_layouts.front')

@section('meta_title')
    Se connecter
@endsection

@section('meta_description')
    Inscrivez-vous pour trouver gratuitement des covoiturages près de chez vous.
@endsection

@section('hero')
    @include('_partials.front.section.breadcrumbs', ['page_title' => 'Se connecter'])
@endsection

@section('main')

    @include('pages._partials.login-main')

@endsection
