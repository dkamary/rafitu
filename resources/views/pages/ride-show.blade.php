{{-- Afficher les détails d'un trajet --}}

@extends('_layouts.front')

@php
    $status = $ride->getStatus();
    $rideOptions = [
        'ride' => $ride,
        'loop' => json_decode('{"even": "false"}'),
        'showPrice' => false,
        'showDetails' => false,
        'showDate' => false,
    ];
    $driver = $ride->getDriver();
    $user = Auth::user();
@endphp

@section('meta_title')
    Détails Trajet
@endsection

@section('hero')
    @include('_partials.front.section.breadcrumbs', ['page_title' => 'Détails Trajet'])
@endsection

@section('main')
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-8 col-lg-6 mx-auto bg-white my-5 py-3">
                <div class="row">
                    <div class="col-12 text-center">
                        <h2>{{ DateManager::dateFr($ride->getDateDeparture()) }}</h2>
                    </div>
                </div>
                <div class="row border-top border-bottom mt-3 py-3">
                    <div class="col-12 text-center">
                        @if($status)
                            {{ $status->label }}
                        @else
                            Planifié
                        @endif
                    </div>
                </div>
                <div class="row py-3">
                    <div class="col-12">
                        @include('pages._partials.ride-element', $rideOptions)
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
                        <form class="form" action="{{ route('reservation_submit') }}" method="post">
                            @csrf
                            <input type="hidden" name="ride_id" value="{{ $ride->id }}">
                            <input type="hidden" name="user_id" value="{{ $user ? $user->id : 0 }}">
                            <input type="hidden" name="price" value="{{ $ride->price }}">
                            <input type="hidden" name="is_paid" value="0">
                            <div class="row mb-3">
                                <label class="col-12 col-md-3 d-flex align-items-end">
                                    Passager(s):
                                </label>
                                <div class="col-12 col-md-9">
                                    <input class="form-control" type="number" name="passenger" id="passenger" min="1" max="{{ $ride->seats_available }}" placeholder="Nombre de passager max {{ $ride->seats_available }}" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 d-flex justify-content-center align-items-center">
                                    <button type="submit" class="btn btn-primary">
                                        Réserver
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection