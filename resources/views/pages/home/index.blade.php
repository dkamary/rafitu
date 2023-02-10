{{-- Home page --}}

@extends('_layouts.front')

@php

@endphp

@section('meta_title')
    Voyager en covoiturage à prix réduit
@endsection

@section('meta_description')
    Faites des économies sur vos trajets en trouvant des conducteurs fiables et conviviaux au sein
    de la communauté de RAFITU. Vos voyages en quelques clics.
@endsection

@section('hero')
    @include('_partials.front.section.sliders.bs-slider')
@endsection

@section('main')
    {{-- @include('_partials.front.section.features', ['features_classes' => ['homepage-features']]) --}}

    <div class="container-fluid bg-rafitu">
        <div class="container">
            @include('_partials.front.section.booking.new')
        </div>
    </div>

    @include('_partials.front.section.nos-offres-covoiturage')

    <div class="container-fluid bg-white py-5">
        <div class="container">
            @include('_partials.front.section.homepage.bienvenue')
        </div>
    </div>

    <div class="container-fluid py-5">
        <div class="container">
            @include('_partials.front.section.homepage.statistiques')
        </div>
    </div>

    <div class="container-fluid bg-rafitu py-5">
        <div class="container">
            @include('_partials.front.section.homepage.pourquoi-nous-choisir')
        </div>
    </div>

    {{-- @include('_partials.front.section.ads-latest')
    @include('_partials.front.section.ads-featured')
    @include('_partials.front.section.statistics')
    @include('_partials.front.section.locations')
    @include('_partials.front.section.testimonials')
    @include('_partials.front.section.locations-top')
    @include('_partials.front.section.advertise') --}}

@endsection

@once
    @push('head')
        <style id="homepage-style">
            .homepage-features {
                margin-top: -11% !important;
            }

            .homepage-features .status-border {
                background: #ffffff;
                height: 100%;
            }

            .scam-warning .image-container img {
                height: 10rem;
                width: auto;
            }

            @media (min-width: 992px) {
                .owl-carousel .owl-item img {
                    height: auto !important;
                }
            }
        </style>
    @endpush
@endonce
