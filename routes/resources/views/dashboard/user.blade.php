{{-- Dashboard User --}}

@extends('dashboard._layout.base')

@section('meta_title')
    Mon profil
@endsection

@section('hero')
    @include('_partials.front.section.breadcrumbs', ['page_title' => 'Mon profil'])
@endsection

@section('dashboard_content')
    @include('dashboard.forms.user', ['user' => $user])
@endsection
