{{-- Commissions --}}

@extends('_layouts.back')

@php
    $page_title = 'Commissions';
@endphp

@section('meta_title')
    {{ $page_title }}
@endsection

@section('main')
    @include('_partials.back.section.breadcrumbs', ['page_title' => $page_title,])

    @include('_partials.back.notifications.flash-message')

    <div class="row">
        <div class="col-12 text-end">
            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#commission">
                <i class="fa fa-cogs" aria-hidden="true"></i>&nbsp;
                Modifier les paramètres des commissions
            </button>
        </div>
    </div>

    <hr>

    <div class="row my-4 p-4 bg-white border">
        <div class="col-12">

            {{-- @dump($todo) --}}

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link fs-6 active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">
                        A payer
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link fs-6" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">
                        Payé
                    </button>
                </li>

                </ul>
                <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade py-4 show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    @include('admin.transactions._partials.commissions-liste', ['commissions' => $todo])
                </div>
                <div class="tab-pane fade py-4" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    @include('admin.transactions._partials.commissions-liste', ['commissions' => $done])
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <form action="{{ route('transaction_commissions') }}" method="post">
        <div class="modal fade" id="commission" tabindex="-1" aria-labelledby="commissionLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="commissionLabel">Paramètres des commissions</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-4">
                        <label for="com_longtrajet" class="col-4 text-end align-items-center d-flex justify-content-end mb-0 fw-bold">Trajet long</label>
                        <div class="col-4">
                            <div class="input-group">
                                <input type="number" class="form-control text-end" name="com_longtrajet" id="com_longtrajet" value="{{ $parameter->com_longtrajet }}"
                                    aria-label="Pourcentage pour la commission des longs trajets" min="1" max="99" step="any">
                                <span class="input-group-text fw-bold">&percnt;</span>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="com_quotidien" class="col-4 text-end align-items-center d-flex justify-content-end mb-0 fw-bold">Trajet quotidien</label>
                        <div class="col-4">
                            <div class="input-group">
                                <input type="number" class="form-control text-end" name="com_quotidien" id="com_quotidien" value="{{ $parameter->com_quotidien }}"
                                    aria-label="Pourcentage pour la commission des trajets quotidiens" min="1" max="99" step="any">
                                <span class="input-group-text fw-bold">&percnt;</span>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="heure_execution" class="col-4 text-end align-items-center d-flex justify-content-end mb-0 fw-bold">Trajet quotidien</label>
                        <div class="col-4">
                            <div class="input-group">
                                <input type="number" class="form-control text-end" name="heure_execution" id="heure_execution" value="{{ $parameter->heure_execution }}"
                                    aria-label="Pourcentage pour la commission des trajets quotidiens" min="1">
                                <span class="input-group-text fw-bold">secondes</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Annuler
                </button>
                <button type="submit" class="btn btn-primary">
                    Enregistrer
                </button>
                </div>
            </div>
            </div>
        </div>
        @csrf
    </form>

@endsection
