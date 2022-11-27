{{-- Ride List for debug purpose --}}

@extends('_layouts.front')

@section('meta_title')
    Liste de tous les trajets
@endsection

@section('hero')
    @include('_partials.front.section.breadcrumbs', ['page_title' => 'Liste de tous les trajets'])
@endsection

@section('main')
    <div class="container">
        <div class="row">
            <div class="col-12">
                @foreach ($rides as $ride)
                    @include('pages._partials.ride-element', ['ride' => $ride, 'loop' => $loop])
                @endforeach
            </div>
        </div>
    </div>
@endsection
