{{-- Dashboard Index --}}

@extends('dashboard._layout.base')

@section('meta_title')
    Espace Client
@endsection

@section('hero')
    @include('_partials.front.section.breadcrumbs', ['page_title' => 'Espace Client'])
@endsection

@section('dashboard_content')

    <div class="row">
        <div class="col-12 col-sm-6 col-md-4 mb-4">
            @include('dashboard._partials.messages', ['messages' => $messages])
        </div>
        <div class="col-12 col-sm-6 col-md-4 mb-4">
            @include('dashboard._partials.reservations', ['reservations' => $reservations])
        </div>
        <div class="col-12 col-sm-6 col-md-4 mb-4">
            @include('dashboard._partials.reservations-unpaid', ['unpaids' => $unpaids])
        </div>
        <div class="col-12 col-sm-6 col-md-4 mb-4">
            @include('dashboard._partials.profile')
        </div>
    </div>
@endsection
