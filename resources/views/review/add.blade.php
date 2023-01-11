{{-- Nouvel avis --}}

@extends('_layouts.front')

@php
    $title = $title ?? 'Donner votre avis';
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
        <div class="col-12 col-md-6 mx-auto py-8">
            <div class="row bg-white">
                <div class="col-12">
                    @include('review.form.review-set', ['reservation' => $reservation])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
