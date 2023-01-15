{{-- Paramètres des trajets --}}

@extends('_layouts.back')

@php
    $page_title = 'Paramètres des trajets';
@endphp

@section('meta_title')
    {{ $page_title }}
@endsection

@section('main')

    @include('_partials.back.section.breadcrumbs', ['page_title' => $page_title,])

    @include('_partials.back.notifications.flash-message')

    <div class="row my-4 p-4 bg-white border">
        <div class="col-12">
            <form action="{{ route('admin_ride_parameters') }}" method="post">

                <div class="row my-3">
                    <label for="dist_longtrajet" class="col-12 col-md-4">
                        Distance minimale des longs trajets
                    </label>
                    <div class="col-12 col-md-4">
                        <div class="input-group mb-3">
                            <input type="number" class="form-control text-end" placeholder="Distance en mètres" value="{{ $parameters->dist_longtrajet }}"
                            id="dist_longtrajet" name="dist_longtrajet" min="10000" step="100"
                            aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <span class="input-group-text" id="basic-addon2">mètres</span>
                        </div>
                    </div>
                </div>

                <div class="row my-3">
                    <div class="col-12 d-flex justify-content-center align-items-center">
                        <button type="submit" class="btn btn-primary d-flex justify-content-center align-items-center">
                            <i class="fa fa-floppy-o fa-2x" aria-hidden="true"></i>&nbsp;
                            Enregistrer
                        </button>
                    </div>
                </div>

                @csrf

            </form>
        </div>
    </div>

@endsection
