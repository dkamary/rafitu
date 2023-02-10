{{-- Search Ride --}}

@extends('_layouts.front')

@section('meta_title')
    Rechercher un trajet
@endsection

@section('meta_description')
    Rendez vos voyages plus agréables en partageant la route avec d'autres personnes. Inscrivez-vous pour trouver des covoiturages à des petits prix.
@endsection

@section('hero')
    @include('_partials.front.section.breadcrumbs', ['page_title' => 'Rechercher un trajet'])
@endsection

@section('main')
<div class="container">
    <div class="row my-5">
        <div class="col-12 col-md-8 mx-auto">
            <div class="row my-6">
                <div class="col-12 text-center fs-2 txt-rafitu">
                    Rechercher votre trajet idéal dans <br> notre base de données.
                </div>
            </div>

            <div class="card">
                <div class="card-body border rounded">
                    @include('_partials.front.forms.search-ride', [
                        'withIcons' => true,
                    ])
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid my-2 py-4 bg-light">
    <div class="row">
        <div class="col-12">
            @include('_partials.front.section.nos-offres-covoiturage')
        </div>
    </div>
</div>

{{-- <div class="container-fluid py-5">
    <div class="container">
        @include('_partials.front.section.homepage.statistiques')
    </div>
</div> --}}

<div class="container-fluid bg-rafitu py-5">
    <div class="container">
        @include('_partials.front.section.homepage.pourquoi-nous-choisir')
    </div>
</div>

@endsection
