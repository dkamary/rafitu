{{-- Afficher le resultat de réservation --}}

@extends('_layouts.front')

@php
    $ride = $reservation->getRide();
    $rideOptions = [
        'ride' => $ride,
        'loop' => json_decode('{"even": "false"}'),
        'showPrice' => false,
        'showDetails' => false,
        // 'showDate' => false,
        'showDistance' => true,
    ];
    $user = Auth::user();
    $driver = $ride->getDriver();
@endphp

@section('meta_title')
    Réservation
@endsection

@section('hero')
    @include('_partials.front.section.breadcrumbs', ['page_title' => 'Réservation'])
@endsection

@section('main')
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-8 col-lg-6 mx-auto bg-white my-5 py-3">
                <div class="row">
                    <div class="col-12 text-center">
                        <h2>Votre réservation</h2>
                    </div>
                </div>
                <div class="row border-top border-bottom mt-3 py-3">
                    <div class="col-12 text-center text-success fs-4">
                        La réservation a été effectué avec succès<br>
                        Veuillez passer à l'étape suivante
                    </div>
                </div>
                <div class="row py-3">
                    <div class="col-12">
                        @include('pages._partials.ride.element', $rideOptions)
                    </div>
                </div>

                <div class="row border-top border-bottom mt-3 py-3">
                    <div class="col-12 d-flex justify-content-between">
                        <span>Prix</span>
                        <h3><strong>{{ $ride->price }}</strong> F CFA</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 d-flex justify-content-between align-items-center py-5">
                        <div>
                            <div class="fs-6">{{ $driver ? $driver->getFullname() : '' }}</div>
                            <div class="my-2"><em>Aucun avis pour le moment</em></div>
                        </div>
                        <div>
                            @if($driver)
                                <img src="{{ $driver->avatar }}" alt="" class="img-fluid border rounded-circle" alt="Avatar">
                            @endif
                        </div>
                    </div>
                </div>

                @if ($ride->woman_only == 1)
                <div class="row my-3 py-5">
                    <div class="col-12">
                        <span class="text-info">
                            <i class="fa fa-female" aria-hidden="true"></i> &nbsp;
                            Pour femme uniquement
                        </span>
                    </div>
                </div>
                @endif

                <div class="row border-top mt-3 py-3">
                    <div class="col-12">
                        @include('_partials.front.payment.choice')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('head')
    <style>
        #cinetpay-form {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #cinetpay-form .cpButton {
            background-color: #4c6dff;
            border: solid 1px #4c6dff;
            color: #fff;
            font-style: normal;
            text-shadow: unset;
        }

        #cinetpay-form .cpButton::before,
        #cinetpay-form .cpButton::after {
            display: none;
        }
    </style>
@endpush
