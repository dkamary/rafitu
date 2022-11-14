{{-- Home page --}}

@extends('_layouts.front')

@php

@endphp

@section('meta_title')
    Voyager en covoiturage à prix réduit
@endsection

@section('main')
    {{-- @include('_partials.front.section.features', ['features_classes' => ['homepage-features']]) --}}

    <div class="container-fluid bg-rafitu">
        <div class="container">
            @include('_partials.front.section.booking.new')
        </div>
    </div>

    <section class="sptb position-relative " style="background:#0096c9;">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-6  d-lg-block">
                        <img src="https://cdn.blablacar.com/kairos/assets/images/phishing-b200bc23cc51c0950d45..svg" alt="img" class="br-ts-2 br-bs-2 w-100">
                    </div>
                    <div class="col-md-12 col-lg-6  ps-0 ">
                        <div class="card-body p-7 about-con pabout">
                            <h2 class="mb-4 font-weight-semibold text-white">Aidez-nous à vous protéger contre les arnaques</h2>
                            <!-- <h4 class="leading-normal text-white">majority have suffered alteration in some form, by injected humour</h4> -->
                            <p class="leading-normal text-white">Chez RAFITU, nous mettons tout en œuvre pour vous proposer une plateforme aussi sécurisée que possible. Mais les tentatives d'arnaque demeurent une réalité, et nous tenons à vous expliquer exactement comment les éviter et les signaler. Suivez nos conseils pour nous aider à vous protéger.</p>
                            <a href="#" class="btn btn-primary  mt-2">En savoir plus</a>
                        </div>
                    </div>
            </div>
        </div>
    </section>

    <section class="sptb position-relative " style="background:white;">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-6  d-lg-block">
                        <img src="{{ asset('assets/images/frais_en_moins.png') }}" alt="img" class="br-ts-2 br-bs-2 w-100">
                    </div>
                    <div class="col-md-12 col-lg-6  ps-0 ">
                        <div class="card-body p-7 about-con pabout">
                            <h2 class="mb-4 font-weight-semibold">Des frais en moins et bien plus que ça…</h2>
                            <!-- <h4 class="leading-normal">majority have suffered alteration in some form, by injected humour</h4> -->
                            <p class="leading-normal">En covoiturant entre Saint Etienne et Fréjus, Camille, conductrice BlaBlaCar, va sauver une histoire d’amour et limiter un peu le CO2. Si elle pensait juste récupérer 60 € sur son trajet, c’est raté…

                        Comme elle, partagez bien plus qu’un simple trajet. En cadeau de bienvenue, recevez 25 € de carburant offerts pour votre premier covoiturage sur BlaBlaCar et 15 € sur BlaBlaCar Daily.</p>
                            <a href="#" class="btn btn-primary  mt-2">Covoiturer avec nous</a>
                        </div>
                </div>
            </div>
        </div>
    </section>

    <section class="sptb position-relative " style="background:#0096c9;">
        <div class="container">
        <h2 class="mb-4 font-weight-semibold text-white">Ou allez- vous ?</h2>
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-12 mb-0">
                        <a href="#" class="btn btn-lg btn-block btn-primary br-ts-md-0 br-bs-md-0">Bordeaux &nbsp;<i class="fa fa-long-arrow-right"></i>&nbsp; Toulouse &nbsp;<i class="fa fa-angle-right float-end mt-1 d-none d-lg-block"></i></a>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-12 mb-0">
                        <a href="#" class="btn btn-lg btn-block btn-primary br-ts-md-0 br-bs-md-0">Nantes &nbsp;<i class="fa fa-long-arrow-right"></i>&nbsp; Rennes &nbsp;<i class="fa fa-angle-right float-end mt-1 d-none d-lg-block"></i></a>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-12 mb-0">
                        <a href="#" class="btn btn-lg btn-block btn-primary br-ts-md-0 br-bs-md-0">Paris &nbsp;<i class="fa fa-long-arrow-right"></i>&nbsp; Lyon &nbsp;<i class="fa fa-angle-right float-end mt-1 d-none d-lg-block"></i></a>
                </div>
            </div>
        </div>
    </section>

    <section class="sptb position-relative " style="background:white;">
        <div class="container">
        <h2 class="mb-4 font-weight-semibold">Le covoiturage selon RAFITU</h2>
                    <div class="row">
                        <div class="col-sm-6 col-xl-4">
                            <div class="card h-100">
                                <a href="#"><img class="card-img-top br-te-7 br-ts-7" src="{{ asset('assets/images/4.png') }}" alt="Well, I didn't vote for you."></a>
                                <div class="card-body d-flex flex-column">
                                    <h4><a href="#"> Notre tchat communautaire</a></h4>
                                    <div class="text-muted">Nous croyons aux connexions humaines ur RAFITU, quand vous avez une question, ce sont de vraies personnes qui vous répondent : les Helpers !</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-4">
                            <div class="card h-100">
                                <a href="#"><img class="card-img-top br-te-7 br-ts-7" src="{{ asset('assets/images/5.png') }}" alt="Well, I didn't vote for you."></a>
                                <div class="card-body d-flex flex-column">
                                    <h4><a href="#">Top 5 des anecdotes de covoiturage   ❄️ Spécial fêtes de fin d’année ❄️</a></h4>
                                    <div class="text-muted">Pour célébrer le cap des 100 millions de membres Rafitu dans le monde, nous vous avons demandé de partager avec nous vos meilleurs souvenirs de covoiturage. Avec plus de 200 millions de rencontres chaque année, des moments uniques, inoubliables et parfois insolites arrivent souvent !</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-4">
                            <div class="card h-100">
                                <a href="#"><img class="card-img-top br-te-7 br-ts-7" src="{{ asset('assets/images/6.png') }}" alt="Well, I didn't vote for you."></a>
                                <div class="card-body d-flex flex-column">
                                    <h4><a href="#">Rafitu fait le plein de nouveautés pour l’été ✨.</a></h4>
                                    <div class="text-muted">Découvrez nos dernières innovations et mises à jour.</div>
                                </div>
                            </div>
                        </div>

                    </div>
        </div>
    </section>

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
        </style>
    @endpush
@endonce
