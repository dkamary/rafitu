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
    Paiement effectué
@endsection

@section('hero')
    @include('_partials.front.section.breadcrumbs', ['page_title' => 'Paiement effectué'])
@endsection

@section('main')
    <div class="container">
        <div class="row">
            <div class="col-12 col-xl-8 mx-auto bg-white my-5 py-3">
                <div class="row">
                    <div class="col-12 text-center">
                        <h2>Votre réservation</h2>
                    </div>
                </div>
                <div class="row border-top border-bottom mt-3 py-3">
                    <div @class([
                        'col-12 text-center fs-4',
                        'text-success' => isset($result) ? $result->isSuccess() : (isset($order) ? $order->isSuccess() : false),
                        'text-warning' => isset($result) ? $result->isWarning() : (isset($order) ? $order->isWarning() : false),
                        'text-danger' => isset($result) ? $result->isError() : (isset($order) ? $order->isError() : false),
                    ])>
                        {!! isset($result) ? $result->getMessage() : (isset($order) ? $order->getMessage() : 'N/A') !!}
                    </div>
                </div>
                <div class="row py-3">
                    <div class="col-12">
                        @include('trajet.details', ['ride' => $ride, 'reservation' => $reservation])
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
                        {{-- <form class="form" action="#" method="post" onsubmit="alert('Fonctionnalité bientôt disponible')">
                            <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">
                            <input type="hidden" name="user_id" value="{{ $user ? $user->id : 0 }}">
                            <div class="row">
                                <div class="col-12 d-flex justify-content-center align-items-center">
                                    <button type="submit" class="btn btn-primary" disabled>
                                        Procéder au paiement
                                    </button>
                                </div>
                            </div>
                        </form> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
