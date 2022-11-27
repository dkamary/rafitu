{{-- Dashboard User --}}

@extends('dashboard._layout.base')

@php
    $ride = $reservation->getRide();
@endphp

@section('meta_title')
    Mes réservations
@endsection

@section('hero')
    @include('_partials.front.section.breadcrumbs', ['page_title' => 'Mon profil'])
@endsection

@section('dashboard_content')
    @dump($ride)
    @dump($reservation)
@endsection
