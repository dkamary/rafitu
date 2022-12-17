{{-- Dashboard User --}}

@extends('dashboard._layout.base')

@section('meta_title')
    Mes messages
@endsection

@section('hero')
    @include('_partials.front.section.breadcrumbs', ['page_title' => 'Mes messages'])
@endsection

@section('dashboard_content')
    <table class="table table-stripe">
        <thead>
            <tr>
                <td class="col-6">Conversations</td>
                <td class="col-2">Date</td>
                {{-- <td class="col-2">Statut</td> --}}
                <td class="col-2">&nbsp;</td>
            </tr>
        </thead>
        <tbody>
            @forelse ($messages as $msg)
                <tr id="reservation-{{ $reservation->id }}">
                    <td class="trajet-{{ $reservation->id }}">
                        <strong>{{ $ride->departure_label }}</strong> <br>
                        vers <br>
                        <strong>{{ $ride->arrival_label }}</strong>
                    </td>
                    <td class="date-{{ $reservation->id }}">
                        {{ $reservation->getReservationDate('d/m/Y') }}
                    </td>
                    <td class="status-{{ $reservation->id }} fw-bold">
                        {{ $ride ? $ride->getStatus() : '...' }}
                    </td>
                    <td class="action-{{ $reservation->id }}">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('dashboard_reservation_show', ['reservation' => $reservation]) }}" class="btn btn-xs btn-primary">
                                Afficher
                            </a>
                            @if (!$reservation->isPaid())
                            &nbsp;
                                @include('_partials.front.forms.reservation-payment', ['reservation' => $reservation, 'user' => Auth::user(), 'btn_classes' => 'btn btn-xs btn-warning', 'btn_text' => 'Payer'])
                            @endif
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">
                        <em>Vous n'avez pas encore de message pour le moment</em><br>
                        <a href="{{ route('trouver_trajet') }}" class="btn btn-primary my-4">Trouver votre trajet idéal</a>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
