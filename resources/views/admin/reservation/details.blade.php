{{-- Détails des réservations --}}
@extends('_layouts.back')

@php
    $title = $title ?? 'Réservations';
    $routeName = Route::currentRouteName();
    $client = $reservation->getuser();
    $ride = $reservation->getRide();
@endphp

@section('meta_title')
    {{ $title }}
@endsection

@section('main')
    @include('_partials.back.section.breadcrumbs', ['page_title' => $title])

    @include('_partials.back.notifications.flash-message')

    <div class="row bg-white py-5 my-5">
        <div class="col-12">
            <div class="row p-5 mt-5">
                <div class="card px-0 border-info">
                    <div class="card-header bg-info text-white fs-4 fw-bold">
                        Informations Client
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-3">
                                <h6 class="card-title">Nom :</h6>
                            </div>
                            <div class="col-12 col-md-9">
                                <p class="card-text">{{ $client->getFullname() }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-3">
                                <h6 class="card-title">Adresse email :</h6>
                            </div>
                            <div class="col-12 col-md-9">
                                <p class="card-text">{{ $client->email }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-3">
                                <h6 class="card-title">Statut :</h6>
                            </div>
                            <div class="col-12 col-md-9">
                                <p class="card-text">
                                @if($reservation->status == 'cancel')
                                    <span class="badge bg-warning">Annulée</span>
                                @elseif($reservation->status == 'paid')
                                    <span class="badge bg-success">Payée</span>
                                @elseif ($reservation->status == 'unpaid')
                                    <span class="badge badge-danger">Impayée</span>
                                @elseif($reservation->status == 'delete')
                                    <span class="badge bg-dark">Effacé</span>
                                @endif
                                </p>
                            </div>
                        </div>

                        @if($reservation->isPaid())
                        @php
                            $order = $reservation->getOrder();
                        @endphp
                        <div class="row">
                            <div class="col-12 col-md-3">
                                <h6 class="card-title">Moyen de paiement :</h6>
                            </div>
                            <div class="col-12 col-md-9">
                                <p class="card-text">{{ $order ? $order->source : 'N/A' }}</p>
                            </div>
                        </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="row p-5 mt-3    ">
                <div class="card border-secondary px-0">
                    <div class="card-header bg-secondary text-white fs-4 fw-bold">
                        Réservation
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-3">
                                <h6 class="card-title">Date de réservation :</h6>
                            </div>
                            <div class="col-12 col-md-9">
                                <p class="card-text">{{ display_date($reservation->reservation_date, 'H:i') }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-3">
                                <h6 class="card-title">Date de paiement :</h6>
                            </div>
                            <div class="col-12 col-md-9">
                                <p class="card-text">{{ display_date($reservation->payment_date, 'H:i') }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-3">
                                <h6 class="card-title">Montant :</h6>
                            </div>
                            <div class="col-12 col-md-9">
                                <p class="card-text"><strong>{{ $reservation->price }}</strong>&nbsp;<sup>F CFA</sup></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-3">
                                <h6 class="card-title">Passager(s) :</h6>
                            </div>
                            <div class="col-12 col-md-9">
                                <p class="card-text"><strong>{{ $reservation->passenger }}</strong></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="row p-5 mt-3 mb-5">
                <div class="card px-0 border-dark">
                    <div class="card-header bg-dark text-white fs-4 fw-bold">
                        Trajet
                    </div>
                    <div class="card-body">
                        <div class="container {{ $classList ?? '' }}">
                            <div class="row trajet trajet__unique">
                                <div class="col-12 py-5 bg-white">

                                    @include('trajet._partials.date', ['ride' => $ride])

                                    {{-- <hr>

                                    @include('trajet._partials.statut', ['ride' => $ride,]) --}}

                                    <hr>

                                    @include('trajet._partials.trajet-info', ['ride' => $ride,])

                                    <hr>

                                    @include('trajet._partials.chauffeur-info-details', ['ride' => $ride])

                                    <hr>

                                    @include('trajet._partials.itineraire', ['ride' => $ride, 'title' => 'L\'itinéraire du trajet'])

                                    <hr>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
