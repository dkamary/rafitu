{{-- Dashboard Index --}}

@extends('dashboard._layout.base')

@section('meta_title')
    Espace Client
@endsection

@section('hero')
    @include('_partials.front.section.breadcrumbs', ['page_title' => 'Espace Client'])
@endsection

@section('dashboard_content')
    <p>
        Bienvenue dans votre espace client.
    </p>
@endsection
