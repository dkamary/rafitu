{{-- Trajet details --}}


@extends('_layouts.front')

@php
    $driver = $ride->getDriver();
    $title = $title ?? $driver->getFullName();
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

            @include('trajet._partials.chauffeur-info-details')

            <hr>

            <div class="row my-5">
                <div class="col-12 text-center">
                    <a href="{{ route('ride_show', ['ride' => $ride]) }}" class="btn btn-primary">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;
                        Revenir au détails du trajet
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
