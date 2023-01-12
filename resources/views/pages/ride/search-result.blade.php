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
                {{-- @include('pages._partials.ride.element', ['ride' => $ride, 'loop' => $loop]) --}}
                @include('trajet._partials.minimal', ['ride' => $ride, 'loop' => $loop])
            @empty
            <div class="row">
                <div class="col-12 bg-white p-5 text-center">
                    Aucun trajet ne correspond à votre recherche
                </div>
                <div class="col-12 bg-white pb-5 text-center">
                    <a href="#booking" class="btn btn-orange px-3 scroll-to">
                        Réserver dès maintenant
                    </a>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</div>

@if(count($rides) == 0)

<div class="container-fluid bg-rafitu" id="booking">
    <div class="container">
        @include('_partials.front.section.booking.new')
    </div>
</div>

@endif

@endsection
