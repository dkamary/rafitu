{{-- Liste des trajets --}}

@extends('_layouts.front')

@php
    $title = $title ?? 'Liste des trajets';
@endphp

@section('meta_title')
    {{ $title }}
@endsection

@section('hero')
    @include('_partials.front.section.breadcrumbs', ['page_title' => $title])
@endsection

@section('main')
<div class="container {{ $classList ?? '' }}">
    <div class="row">
        <div class="col-12 py-5">
            @forelse ($rides as $ride)
                @include('trajet._partials.minimal', ['ride' => $ride, 'loop' => $loop, 'showLink' => true])
            @empty
            <div class="row my-3">
                <div class="col-12 text-center">
                    Aucun trajet pour le moment
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
