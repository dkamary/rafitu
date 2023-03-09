{{-- Funfact Set (edit / new) --}}

@extends('_layouts.back')

@php
    $isNew = !isset($funfact) || is_null($funfact) || is_null($funfact->id);
    $page_title = $isNew ? 'Nouveau fait amusant' : 'Edition fait amusant';
@endphp

@section('meta_title')
    {{ $page_title }}
@endsection

@section('main')
    @include('_partials.back.section.breadcrumbs', ['page_title' => $page_title,])

    <div class="row py-6 bg-white">
        <div class="col-12">
            <div class="row">
                <div class="col-12">
                    @include('_partials.back.notifications.flash-message')
                </div>
            </div>

            @include('admin.funfact.form.funfact', ['funfact' => $funfact])

        </div>
    </div>
@endsection
