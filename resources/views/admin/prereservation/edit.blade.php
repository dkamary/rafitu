{{-- Edition de la pré réservation --}}

@extends('_layouts.back')

@section('meta_title')
    Les pré-réservations
@endsection

@section('main')
    @include('_partials.back.section.breadcrumbs', ['page_title' => 'Pré-réservations'])

    @include('_partials.back.notifications.flash-message')

    <div class="row py-5 bg-white">
        <div class="col-12">
            @include('admin.prereservation.form.prereservation', [
                'prereservation' => $prereservation,
            ])
        </div>
    </div>
@endsection
