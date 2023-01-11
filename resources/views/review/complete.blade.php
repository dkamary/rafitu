{{-- Avis soumis avec succès --}}

@extends('_layouts.front')

@php
    $title = $title ?? 'Nous prenons en compte votre avis';
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
        <div class="col-12 col-md-6 mx-auto py-8">
            <div class="row bg-white">
                <div class="col-12">

                    <p class="text-center fs-4 txt-rafitu py-4 px-2">
                        Merci pour votre commentaire.<br>
                        Votre avis sur le trajet que vous avez effectué a été pris en compte.
                    </p>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
