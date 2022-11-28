{{-- Search Ride --}}

@extends('_layouts.front')

@section('meta_title')
    Rechercher un trajet
@endsection

@section('hero')
@include('_partials.front.section.breadcrumbs', ['page_title' => 'Rechercher un trajet'])
@endsection

@section('main')
<div class="container">
    <div class="row my-5">
        <div class="col-12 col-md-6 mx-auto">
            <div class="card">
                <div class="card-body border rounded">
                    @include('_partials.front.forms.search-ride')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
