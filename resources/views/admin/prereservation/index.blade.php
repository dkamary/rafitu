{{-- Pré reservation liste --}}

@extends('_layouts.back')

@section('meta_title')
    Les pré-réservations
@endsection

@section('main')
    @include('_partials.back.section.breadcrumbs', ['page_title' => 'Pré-réservations'])

    @include('_partials.back.notifications.flash-message')

    <div class="row py-5 bg-white">
        <div class="col-12">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="actives-tab" data-bs-toggle="tab" data-bs-target="#actives" type="button" role="tab" aria-controls="actives" aria-selected="true">Pré-réservations actives</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="inactives-tab" data-bs-toggle="tab" data-bs-target="#inactives" type="button" role="tab" aria-controls="inactives" aria-selected="false">Pré-réservations effacées</button>
                </li>

            </ul>
            <div class="tab-content" id="prereservation-tab">
                <div class="tab-pane fade show active" id="actives" role="tabpanel" aria-labelledby="actives-tab">
                    @include('admin.prereservation.list', ['list' => $actives])
                </div>
                <div class="tab-pane fade" id="inactives" role="tabpanel" aria-labelledby="inactives-tab">
                    @include('admin.prereservation.list', ['list' => $inactives, 'bg_header' => 'bg-dark'])
                </div>
            </div>
        </div>
    </div>
@endsection
