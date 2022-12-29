{{-- Edition de Marque de véhicule --}}

@extends('_layouts.back')

@section('meta_title')
    @if($brand->id > 0)
    Marque {{ $brand->name }}
    @else
    Nouvelle marque de véhicule
    @endif
@endsection

@section('main')
    @include('_partials.back.section.breadcrumbs', ['page_title' => ($brand->id > 0) ? ('Marque ' . $brand->name) : 'Nouvelle marque de vehicule'])

    @include('_partials.back.notifications.flash-message')

    <div class="row my-4 py-3 bg-light">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <a href="{{ route('admin_brand_index') }}">
                <i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;
                Revenir à la liste des marques
            </a>
            <button id="btn-save-alias" class="btn btn-primary rounded-pill">
                <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;
                Enregistrer la nouvelle marque
            </button>
        </div>
    </div>

    <div class="row my-4 py-3 bg-white">
        <div class="col-12">

            <form action="{{ route('admin_brand_sauvegarder') }}" method="POST">

                <div class="row mb-3">
                    <label for="code" class="col-12 col-sm-4 col-md-2">Code</label>
                    <div class="col-12 col-sm-6 col-md-4">
                        <input class="form-control" type="text" name="code" id="code" placeholder="Code de la marque" maxlength="10" value="{{ $brand->code }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="code" class="col-12 col-sm-4 col-md-2">Nom</label>
                    <div class="col-12 col-sm-6 col-md-4">
                        <input class="form-control" type="text" name="name" id="name" placeholder="Nom de la marque" maxlength="150" value="{{ $brand->name }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary rounded-pill" id="btn-submit">
                            <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;
                            Enregistrer la nouvelle marque
                        </button>
                    </div>
                </div>

                @if($brand->id > 0)
                <input type="hidden" name="id" value="{{ (int)$brand->id }}">
                @endif

                @csrf

            </form>

        </div>
    </div>

    @if ($brand->id > 0)

    <div class="row my-4 py-3">
        <div class="col-12 col-md-10 mx-auto">
            <div class="card">
                <h4 class="card-header">Modèles de la marque</h4>
                <div class="card-body">

                    <div class="row my-4 pt-3">
                        <div class="col-12 text-end">
                            <a href="{{ route('admin_model_nouveau', ['brand' => $brand]) }}" class="btn btn-secondary">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;
                                Ajouter une nouveau modèle
                            </a>
                        </div>
                    </div>

                    <table class="table table-stripe">
                        <thead>
                            <tr>
                                <th width="20%">Code</th>
                                <th width="50%">Nom du modèle</th>
                                <th width="30%">&nbsp</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($brand->getModels() as $model)
                                <tr>
                                    <td>{{ $model->code }}</td>
                                    <td>{{ $model->label }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center align-items-center">
                                            <a href="{{ route('admin_model_editer', ['brand' => $brand, 'model' => $model]) }}" class="btn btn-info me-2">
                                                <i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;
                                                &Eacute;diter
                                            </a>
                                            <form action="{{ route('admin_model_effacer', ['brand' => $brand]) }}" method="post" class="brand-remove-form">
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>&nbsp;
                                                    Supprimer
                                                </button>
                                                <input type="hidden" name="id" value="{{ $model->id }}">
                                                @csrf
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">
                                        <p class="my-3">
                                            Il n'y a pas encore de modèle pour cette marque
                                        </p>
                                        <a href="{{ route('admin_model_nouveau', ['brand' => $brand]) }}" class="btn btn-secondary">
                                            <i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;
                                            Ajouter une nouveau modèle
                                        </a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @endif

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

                const removeForm = document.querySelectorAll('.brand-remove-form');
                if(removeForm && removeForm.length > 0) {
                    removeForm.forEach(form => {
                        form.addEventListener('submit', e => {
                            if(!confirm("Voulez-vous effacer ce modèle ?")) {
                                e.preventDefault();

                                return false;
                            }
                        });
                    });
                }
            });
        </script>

    @endpush

@endonce
