{{-- Login --}}

@php
    $discussionBalloon = false;
@endphp

@extends('_layouts.front')

@section('meta_title')
    Se connecter
@endsection

@section('hero')
    @include('_partials.front.section.breadcrumbs', ['page_title' => 'Se connecter'])
@endsection

@section('main')

    @include('pages._partials.login-main')

@endsection
