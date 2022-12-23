{{-- Dashboard User --}}

@extends('dashboard._layout.base')

@section('meta_title')
    Mes réservations
@endsection

@section('hero')
    @include('_partials.front.section.breadcrumbs', ['page_title' => 'Mon profil'])
@endsection

@section('dashboard_content')

    @forelse ($reservations as $reservation)

        @php
            $ride = $reservation->getRide();
        @endphp

        @include('trajet._partials.minimal', [
            'reservation' => $reservation,
            'ride' => $ride,
            'loop' => $loop,
            'showDriver' => false,
            'showLink' => false,
            'showDashboardLinks' => true,
            ])

    @empty
        <div class="row my-4 border-top border-bottom">
            <div class="col-12">
                <em>Vous n'avez pas encore fait aucune réservation pour le moment</em><br>
                <a href="{{ route('trouver_trajet') }}" class="btn btn-primary my-4 px-3">
                    <i class="fa fa-search" aria-hidden="true"></i>&nbsp;
                    Trouver votre trajet idéal
                </a>
            </div>
        </div>
    @endforelse

@endsection
