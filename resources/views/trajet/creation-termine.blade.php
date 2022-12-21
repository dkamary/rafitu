{{-- Trajet créer avec succès --}}

@extends('_layouts.front')

@php
    $title = $title ?? 'Votre trajet est publié';
@endphp

@section('meta_title')
    {{ $title }}
@endsection

@section('hero')
    @include('_partials.front.section.breadcrumbs', ['page_title' => $title])
@endsection

@section('main')
<div class="container {{ $classList ?? '' }}">
    <div class="row trajet trajet__unique">
        <div class="col-12 py-5 bg-white">

            <h2 class="fs-4 text-center text-success">
                Félicitations votre trajet a été enregistré avec succès.
            </h2>

            <hr>

            @include('trajet._partials.date')

            <hr>

            @include('trajet._partials.trajet-info', ['ride' => $ride,])

            <hr>

            @include('trajet._partials.itineraire', ['ride' => $ride, 'title' => 'L\'itinéraire du trajet'])

            <hr>

            @include('trajet._partials.trajet-preferrences', ['ride' => $ride])

            <hr>

            <div class="row mt-5">
                <div class="col-12 text-center">

                    <a class="btn btn-orange ad-post " href="{{ route('ride_add') }}">
                        <i class="fa fa-plus-circle" aria-hidden="true" style="color: #fff"></i>&nbsp;
                        Publier un autre trajet
                    </a>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
