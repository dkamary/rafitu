{{-- User Set (edit / new) --}}

@extends('_layouts.back')

@php
    $page_title = 'Chauffeur';
@endphp

@section('meta_title')
    {{ $page_title }}
@endsection

@section('main')
    @include('_partials.back.section.breadcrumbs', ['page_title' => $page_title, ['page_parents' => [['route' => 'admin_driver_index', 'text' => 'Chauffeurs']]]])

    <div class="row bg-white py-4 px-2">
        <div class="col-12">
            <div class="row">
                <div class="col-12">
                    @include('_partials.back.notifications.flash-message')
                </div>
            </div>

            <div class="row mb-3 py-3 border-bottom">
                <label for="" class="col-12 col-md-3 fw-bold">Type pièce</label>
                <div class="col-12 col-md-6">
                    {{ $driver->identification_type_id == 1 ? 'Carte d\'identité' : 'Passeport' }}
                </div>
            </div>

            <div class="row mb-3 py-3 border-bottom">
                <label for="" class="col-12 col-md-3 fw-bold">Numéro d'identification</label>
                <div class="col-12 col-md-6">
                    {{ $driver->identification_number }}
                </div>
            </div>

            <div class="row mb-3 py-3 border-bottom">
                <label for="" class="col-12 col-md-3 fw-bold">Date d'obtention</label>
                <div class="col-12 col-md-6">
                    {{ $driver->identification_date }}
                </div>
            </div>

            <div class="row mb-3 py-3 border-bottom">
                <label for="" class="col-12 col-md-3 fw-bold">Scan du permis de conduire</label>
                <div class="col-12 col-md-6">
                    <img src="{{ asset('licence/' . $driver->licence_scan) }}" alt="" class="img-fluid">
                    @include('admin.drivers._partials.view-and-download', ['link' => asset('licence/' . $driver->licence_scan)])
                </div>
            </div>

            <div class="row mb-3 py-3 border-bottom">
                <label for="" class="col-12 col-md-3 fw-bold">Scan du certificat de visite technique en cours</label>
                <div class="col-12 col-md-6">
                    <img src="{{ asset('technicals/' . $driver->technical_check_scan) }}" alt="" class="img-fluid">
                    @include('admin.drivers._partials.view-and-download', ['link' => asset('technicals/' . $driver->technical_check_scan)])
                </div>
            </div>

            <div class="row mb-3 py-3 border-bottom">
                <label for="" class="col-12 col-md-3 fw-bold">Scan de l'assurance en cours</label>
                <div class="col-12 col-md-6">
                    <img src="{{ asset('insurrances/' . $driver->insurrance_scan) }}" alt="" class="img-fluid">
                    @include('admin.drivers._partials.view-and-download', ['link' => asset('insurrances/' . $driver->insurrance_scan)])
                </div>
            </div>

            <div class="row mb-3 py-3 border-bottom">
                <label for="" class="col-12 col-md-3 fw-bold">Scan de la carte grise</label>
                <div class="col-12 col-md-6">
                    <img src="{{ asset('gray-cards/' . $driver->gray_card_scan) }}" alt="" class="img-fluid">
                    @include('admin.drivers._partials.view-and-download', ['link' => asset('gray-cards/' . $driver->gray_card_scan)])
                </div>
            </div>

            <div class="row mb-3 py-3 border-bottom border-top">
                <div class="col text-center">
                    <a href="{{ route('admin_driver_validate', ['driver' => $driver]) }}" type="submit" class="btn btn-success">
                        <i class="fa fa-check" aria-hidden="true"></i>&nbsp;
                        Valider
                    </a>
                </div>
            </div>

        </div>
    </div>
@endsection
