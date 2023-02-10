{{-- Add Ride --}}

@extends('_layouts.front')

@section('meta_title')
    Publier un trajet
@endsection

@section('meta_description')
    Publier sur votre trajet facilement et gratuitement sur la plateforme de RAFITU.
@endsection

@section('hero')
    @include('_partials.front.section.breadcrumbs', ['page_title' => 'Publier un trajet'])
@endsection

@section('main')
    <section class="sptb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-xl-0">
                        {{-- <div class="card-header">
                            <h3 class="card-title">Publier un trajet</h3>
                        </div> --}}
                        <div class="card-body">
                            @include('_partials.front.forms.add-ride', ['vehicules' => $vehicules])
                        </div>
                    </div>
                </div>
            </div> <!-- end row -->
        </div>
    </section>
    <!--/Add posts-section-->
@endsection

@once
    @push('head')
        <style>
            .card-body .nav-tabs .nav-link:hover:not(.disabled), .nav-tabs .nav-link {
                font-size: 1.1rem;
                font-weight: bold;
            }

            .card-body .nav-tabs .nav-link:hover:not(.disabled), .nav-tabs .nav-link.active {
                background-color: #4c6dff !important;
                border: none;
            }
        </style>
    @endpush
@endonce
