{{-- Newsletter Result --}}

@extends('_layouts.front')

@php
    $pageTitle = $pageTitle ?? 'Newsletter';
@endphp

@section('meta_title')
    {{ $pageTitle }}
@endsection

@section('hero')
    @include('_partials.front.section.breadcrumbs', ['page_title' => $pageTitle])
@endsection

@section('main')

    <div class="container bg-white mt-9">
        <div class="row my-4">
            <div class="col-12 col-md-9 mx-auto">

                <p class="text-center mb-4 fs-4">
                    Nous vous remercions de votre aimable attention.<br>
                    Les informations que vous avez soumis ont été prises en compte.
                </p>

                @if(Session::has('success'))
                    <p class="text-center text-success fs-5">
                        {!! Session::get('success') !!}
                    </p>
                @endif

                @if(Session::has('warning'))
                    <p class="text-center text-warning fs-5">
                        {!! Session::get('warning') !!}
                    </p>
                @endif

                @if(Session::has('error'))
                    <p class="text-center text-danger fs-5">
                        {!! Session::get('error') !!}
                    </p>
                @endif

            </div>
        </div>
    </div>

@endsection
