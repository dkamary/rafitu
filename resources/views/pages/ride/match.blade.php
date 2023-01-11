{{-- Ride List Match --}}

@extends('_layouts.front')

@php
    $title = $title ?? 'Trajet(s) correspondant(s)';
    $seatAvailable = isset($seatAvailable) ? $theRide->getSeatsAvailable() : 0;
@endphp

@section('meta_title')
    {{ $title }}
@endsection

@section('hero')
    @include('_partials.front.section.breadcrumbs', ['page_title' => $title])
@endsection

@section('main')
    <div class="container {{ $classList ?? '' }}">

        @isset($theRide)

            @if(!is_null($theRide))

            <table role="presentation">
                <tbody>
                    <tr>
                        <td colspan="4">
                            <h2 class="text-center fw-bolder fs-3 text-info my-4">
                                Le trajet suivant correspond à vos critères
                            </h2>
                        </td>
                    </tr>
                    <tr>
                        <td width="5%">
                            <span class="fw-bold fs-6 trajet__horaire">{{ $theRide->getDepartureDate('H:i') }}</span>
                        </td>
                        <td width="5%">
                            <span class="trajet__point trajet__point-depart"></span>
                        </td>
                        <td width="70%">
                            <div class="d-flex justify-content-between align-items-center">
                                <h2 class="fs-5 fw-bold">{{ $theRide->departure_label }}</h2>
                                <a href="{{ route('ride_show_departure', ['ride' => $theRide]) }}" class="txt-rafitu">
                                    <i class="fa fa-chevron-right fa-2x" aria-hidden="true"></i>
                                </a>
                            </div>
                        </td>
                        <td width="20%" class="text-end">
                            <h3 class="fs-4 fw-bold my-0">{{ number_format($theRide->price, 2, ',', ' ') }}&nbsp;<sup>F CFA</sup></h3>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            @if($theRide->duration > 0)
                            <span class="text-black-50 fw-bold fs-6 trajet__duree">{{ $theRide->getDuration(true) }}</span>
                            @endif
                        </td>
                        <td>
                            &nbsp;
                        </td>
                        <td class="pb-3" title="">

                            &nbsp;

                        </td>
                        <td class="text-end">
                            <sup class="fs-6">par passager</sup>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="fw-bold fs-6 trajet__horaire">{{ $theRide->getArrivalDate('H:i') }}</span>
                        </td>
                        <td>
                            <span class="trajet__point trajet__point-arrivee"></span>
                        </td>
                        <td>
                            <div class="d-flex justify-content-between align-items-center">
                                <h2 class="fs-5 fw-bold">{{ $theRide->arrival_label }}</h2>
                                <a href="{{ route('ride_show_arrival', ['ride' => $theRide]) }}" class="txt-rafitu">
                                    <i class="fa fa-chevron-right fa-2x" aria-hidden="true"></i>
                                </a>
                            </div>
                        </td>
                        <td>
                            &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <td>
                            &nbsp;
                        </td>
                        <td>
                            &nbsp;
                        </td>
                        <td title="">

                            {{-- @include('trajet._partials.trajet-distance', ['distance' => $origin]) --}}

                            <div @class([
                                        'fw-bold my-3 fs-6',
                                        'text-danger' => ($theRide->getSeatsAvailable()) < 1,
                                        'text-info' => ($ride->getSeatsAvailable()) > 0,
                                    ])>
                                    Siège disponible: <span class="fw-bold">{{ $ride->seats_available - $reservationCount }}</span>
                            </div>
                        </td>
                        <td>
                            &nbsp;
                        </td>
                    </tr>
                </tbody>

                <tfoot>
                    <tr>
                        <td colspan="4">
                            <div class="row">
                                <div class="col-12 d-flex justify-content-center align-items-center">
                                    @include('trajet.forms.reservation', ['ride' => $ride, 'reservation_text' => 'Valider la réservation', 'passenger' => $passenger])
                                </div>
                            </div>
                        </td>
                    </tr>
                </tfoot>
            </table>

            @endif

            <hr>

        @endisset

        @if ($count)
            <div class="row bg-white my-5 p-4">
                <div class="col-12 text-center fw-bold">
                    Le{{ $count > 1 ? 's' : '' }} trajet{{ $count > 1 ? 's' : '' }} suivant{{ $count > 1 ? 's' : '' }} correspond{{ $count > 1 ? 'ent' : '' }}
                    le plus à vos critères de réservation
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-12 py-5">

                {{-- @dump($sql) --}}

                @forelse ($rides as $ride)
                    @include('trajet._partials.minimal', ['ride' => $ride, 'loop' => $loop, 'showLink' => true])
                @empty
                <div class="row bg-white my-5 p-4">
                    <div class="col-12 text-center fw-bold">
                        <h3 class="fs-4 text-warning">
                            Votre trajet n'est pas disponible pour le moment.<br>
                            Cependant voici quelques trajets qui pourrait vous intéressez.
                        </h3>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 py-5">

                        @php
                            $rides = RideManager::getRandomRides(6);
                        @endphp

                        @foreach ($rides as $ride)
                            @include('trajet._partials.minimal', ['ride' => $ride, 'loop' => $loop, 'showLink' => true])
                        @endforeach

                    </div>
                </div>

                <br>

                <div class="row my-3 bg-white py-3">
                    <div class="col-12 text-center">
                        Aucun trajet ne correspond à vos critères
                    </div>
                    <div class="col-12 my-4 text-center">
                        <a href="{{ route('trouver_trajet') }}" class="btn btn-primary">
                            <i class="fa fa-search" aria-hidden="true"></i>&nbsp;
                            Trouver un trajet
                        </a>
                    </div>
                </div>
                @endforelse
            </div>
        </div>

    </div>

    <div class="container-fluid my-2 py-4 bg-light">
        <div class="row">
            <div class="col-12">
                @include('_partials.front.section.nos-offres-covoiturage')
            </div>
        </div>
    </div>

    <div class="container-fluid bg-rafitu py-5">
        <div class="container">
            @include('_partials.front.section.homepage.pourquoi-nous-choisir')
        </div>
    </div>
@endsection
