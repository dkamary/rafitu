{{-- Admin User Index --}}

@extends('_layouts.back')

@section('meta_title')
    Réseaux sociaux
@endsection

@section('main')
    @include('_partials.back.section.breadcrumbs', ['page_title' => 'Réseaux Sociaux'])

    @include('_partials.back.notifications.flash-message')

    <div class="row bg-white py-5">
        <div class="col-12">
            @include('admin.social-network.form.social-network-parameter', ['parameter' => $parameter])
        </div>
    </div>

@endsection
