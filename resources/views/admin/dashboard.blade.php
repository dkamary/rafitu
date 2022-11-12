{{-- Dashboard layouts --}}

@extends('_layouts.back')

@section('meta_title')
    Tableau de bord
@endsection

@section('main')
    @include('_partials.back.section.breadcrumbs', ['page_title' => 'Tableau de bord'])

    @include('_partials.back.section.overview')


    <div class="row">
        <div class="col-xl-8 col-lg-12 col-md-12">
            @include('_partials.back.section.overview-last-year')
        </div>
        <div class="col-xl-4 col-lg-12 col-md-12">
            @include('_partials.back.section.activity')
        </div>
    </div>

    <div class="row">
        <div class="col-xl-4 col-lg-12 col-md-12">
            @include('_partials.back.section.customer-satisfaction')
        </div>
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-8">
            @include('_partials.back.section.developing-team')
        </div>
    </div>

    <div class="row">
        <div class="col-xl-4 col-lg-12 col-md-12">
            @include('_partials.back.section.todo-list')
        </div>
        <div class="col-xl-4 col-lg-6 col-md-12">
            @include('_partials.back.section.card-style-1')
        </div>
        <div class="col-xl-4 col-lg-6 col-md-12">
            @include('_partials.back.section.card-style-2')
        </div>
    </div>
@endsection
