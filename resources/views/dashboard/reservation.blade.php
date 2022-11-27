{{-- Dashboard User --}}

@extends('dashboard._layout.base')

@section('meta_title')
    Mes réservations
@endsection

@section('hero')
    @include('_partials.front.section.breadcrumbs', ['page_title' => 'Mon profil'])
@endsection

@section('dashboard_content')
    <table class="table table-stripe">
        <thead>
            <tr>
                <td class="col-6">Trajet</td>
                <td class="col-2">Date</td>
                <td class="col-2">Statut</td>
                <td class="col-2">&nbsp;</td>
            </tr>
        </thead>
        <tbody>
            @forelse ($reservations as $reservation)
            @php
                $ride = $reservation->getRide();
            @endphp
            <tr id="reservation-{{ $reservation->id }}">
                <td class="trajet-{{ $reservation->id }}">
                    {{ $reservation->getRide()->getLabel() }}
                </td>
                <td class="date-{{ $reservation->id }}">
                    {{ $reservation->getReservationDate('d/m/Y') }}
                </td>
                <td class="status-{{ $reservation->id }}">
                    {{ $ride ? $ride->getStatus() : '...' }}
                </td>
                <td class="action-{{ $reservation->id }}">
                    <a href="{{ route('dashboard_reservation_show') }}" class="btn btn-link btn-primary">
                        Afficher
                    </a>
                    @if (!$reservation->isPaid())
                    <a href="#" class="btn btn-link btn-warning">
                        Payer
                    </a>
                    @endif
                </td>
            </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">
                        <em>Vous n'avez pas encore fait aucune réservation pour le moment</em><br>
                        <a href="#" class="btn btn-primary my-4">Trouver votre trajet idéal</a>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
