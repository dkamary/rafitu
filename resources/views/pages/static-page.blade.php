{{-- Home page --}}

@extends('_layouts.front')

@php

@endphp

@section('meta_title')
    {{ $page->title }}
@endsection

@section('hero')
    @include('_partials.front.section.breadcrumbs', ['page_title' => $page->title])
@endsection

@section('main')

    @include('pages._partials.static-page-content', ['page' => $page, 'hasTitle' => false])

@endsection

@once
    @push('head')
        <style id="homepage-style">
            .homepage-features {
                margin-top: -11% !important;
            }

            .homepage-features .status-border {
                background: #ffffff;
                height: 100%;
            }

            .scam-warning .image-container img {
                height: 10rem;
                width: auto;
            }
        </style>
    @endpush
@endonce
