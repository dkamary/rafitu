{{-- Edition de Marque de véhicule --}}

@extends('_layouts.back')

@php
    $isNew = $brand->id == 0;
@endphp

@section('meta_title')
    @if(!$isNew)
    Modèle {{ $model->label }}
    @else
    Nouveau modèle pour la marque {{ $brand->name }}
    @endif
@endsection

@section('main')
    @include('_partials.back.section.breadcrumbs', ['page_title' => ($model->id > 0) ? ('Modèle ' . $model->name) : 'Nouveau modèle pour la marque <strong>' . $brand->name . '</strong>'])

    @include('_partials.back.notifications.flash-message')

    <div class="row my-4 py-3 bg-light">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <a href="{{ route('admin_brand_editer', ['brand' => $brand]) }}">
                <i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;
                Revenir à la page d'édition de la marque {{ $brand->name }}
            </a>
            <button id="btn-save-alias" class="btn btn-primary rounded-pill">
                <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;
                Enregistrer
            </button>
        </div>
    </div>

    <div class="row my-4 py-3 bg-white">
        <div class="col-12">

            <form action="{{ route('admin_model_sauvegarder', ['brand' => $brand]) }}" method="POST">

                <div class="row mb-3">
                    <label for="code" class="col-12 col-sm-4 col-md-2">Code</label>
                    <div class="col-12 col-sm-6 col-md-4">
                        <input class="form-control" type="text" name="code" id="code" placeholder="Code du modèle" maxlength="10" value="{{ $model->code }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="code" class="col-12 col-sm-4 col-md-2">Nom</label>
                    <div class="col-12 col-sm-6 col-md-4">
                        <input class="form-control" type="text" name="label" id="label" placeholder="Nom du modèle" maxlength="150" value="{{ $model->label }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary rounded-pill" id="btn-submit">
                            <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;
                            Enregistrer
                        </button>
                    </div>
                </div>

                @if($model->id > 0)
                <input type="hidden" name="id" value="{{ (int)$model->id }}">
                @endif
                <input type="hidden" name="vehicule_brand_id" value="{{ (int)$brand->id }}">

                @csrf

            </form>

        </div>
    </div>

@endsection

@once

    @push('footer')

        <script>
            window.addEventListener('DOMContentLoaded', event => {
                const alias = document.querySelector('#btn-save-alias');
                if(alias) {
                    alias.addEventListener('click', e => {
                        e.preventDefault();
                        const submit = document.querySelector('#btn-submit');
                        if(!submit) {
                            console.error("Le bouton de soumission est introuvable!");
                            return;
                        }

                        submit.click();
                    });
                }
            });
        </script>

    @endpush

@endonce
