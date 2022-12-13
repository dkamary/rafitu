{{-- Add Ride --}}

@extends('_layouts.front')

@section('meta_title')
Votre résultat de recherche
@endsection

@section('hero')
@include('_partials.front.section.breadcrumbs', ['page_title' => 'Votre résultat de recherche'])
@endsection

@section('main')
<div class="container">
    <div class="row my-5">
        <div class="col-12 col-md-4">
            <div class="card">
                <div class="card-body border rounded">
                    @include('_partials.front.forms.search-ride')
                </div>
            </div>
        </div>
        <div class="col-12 col-md-8">

            {{-- @dump($distances ?? null)
            @dump($parameters) --}}

            @forelse ($rides as $ride)
                @include('pages._partials.ride.element', ['ride' => $ride, 'loop' => $loop])
            @empty
            <div class="row my-3">
                <div class="col-12">
                    Aucun trajet ne correspond à votre recherche
                </div>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
