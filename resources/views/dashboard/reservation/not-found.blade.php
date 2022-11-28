{{-- Reservation not Found --}}

@extends('dashboard._layout.base')

@section('meta_title')
    La réservation est introuvable
@endsection

@section('hero')
    @include('_partials.front.section.breadcrumbs', ['page_title' => 'La réservation est introuvable'])
@endsection

@section('dashboard_content')
    <h2 class="fw-bold fs-4">La réservation que vous voulez atteindre est introuvable</h2>
@endsection
