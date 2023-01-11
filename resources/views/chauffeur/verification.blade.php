{{-- Verification chauffeur --}}

@extends('_layouts.front')

@php
    $title = $title ?? 'Vérification du profil chauffeur';
@endphp

@section('meta_title')
    {{ $title }}
@endsection

@section('hero')
    @include('_partials.front.section.breadcrumbs', ['page_title' => $title])
@endsection

@section('main')
<div class="container {{ $classList ?? '' }}">
    <div class="row">
        <div class="col-12 py-5 bg-white">
            <p class="text-center text-danger fs-4 mb-2">
                Avant de pouvoir publier un trajet nous devons procéder à quelques vérification.
            </p>
            <p class="text-center fs-4 mb-5">
                Veuillez remplir le fomulaire ci-dessous.
            </p>

            <hr>

            <div class="row my-4">
                <div class="col-12">
                    @include('chauffeur.forms.chauffeur-verification-v2')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
