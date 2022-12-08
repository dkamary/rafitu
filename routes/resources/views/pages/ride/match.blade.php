{{-- Ride List Match --}}

@extends('_layouts.front')

@php
    $title = $title ?? 'Trajet(s) correspondant(s)';
@endphp

@section('meta_title')
    {{ $title }}
@endsection

@section('hero')
    @include('_partials.front.section.breadcrumbs', ['page_title' => $title])
@endsection

@section('main')
    <div class="container {{ $classList ?? '' }}">
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
                    @include('pages._partials.ride.element', ['ride' => $ride, 'loop' => $loop])
                @empty
                <div class="row my-3">
                    <div class="col-12 text-center">
                        Aucun trajet ne correspond à vos critères
                    </div>
                    <div class="col-12 my-4 text-center">
                        <a href="{{ route('trouver_trajet') }}" class="btn btn-primary">
                            Trouver un trajet
                        </a>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
