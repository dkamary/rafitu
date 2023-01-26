{{-- Marque de véhicule --}}

@extends('_layouts.back')

@section('meta_title')
    Marques de véhicule
@endsection

@section('main')
    @include('_partials.back.section.breadcrumbs', ['page_title' => 'Marques de véhicule'])

    @include('_partials.back.notifications.flash-message')

    <div class="row my-4 py-3 bg-white">
        <div class="col-12 col-md-10 mx-auto">
            <div class="card">
                <h4 class="card-header">Modèles de la marque &nbsp;<strong>{{ $brand->name }}</strong></h4>
                <div class="card-body">

                    <div class="row my-4 pt-3">
                        <div class="col-12 text-end">
                            <a href="{{ route('admin_model_nouveau', ['brand' => $brand]) }}" class="btn btn-secondary">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;
                                Ajouter une nouveau modèle
                            </a>
                        </div>
                    </div>

                    <section class="list__container">
                        <header class="row d-none d-md-flex bg-secondary text-white py-3 my-3">
                            <div class="col-3 fw-bold fs-6">Code</div>
                            <div class="col-5 fw-bold fs-6">Nom du modèle</div>
                            <div class="col-4">&nbsp;</div>
                        </header>
                        <main>
                            @forelse ($models as $model)
                                <div @class([
                                    'row', 'py-5',
                                    'bg-light' => $loop->even,
                                    'border-bottom',
                                ])>
                                    <div class="col-5 col-md-3 mb-3 mb-md-0">
                                        <u class="d-inline-block d-md-none me-1"><strong>Code:</strong></u><br>
                                        {{ $model->code }}
                                    </div>
                                    <div class="col-7 col-md-5 mb-3 mb-md-0">
                                        <u class="d-inline-block d-md-none me-1"><strong>Nom du modèle:</strong></u><br>
                                        {{ $model->label }}
                                    </div>
                                    <div class="col-12 col-md-4 mb-3 mb-md-0">
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
                                    </div>
                                </div>
                            @empty
                                <div class="row py-5 my-2">
                                    <div class="col-md-12" class="text-center">
                                        <p class="my-3">
                                            Il n'y a pas encore de modèle pour cette marque
                                        </p>
                                        <a href="{{ route('admin_model_nouveau', ['brand' => $brand]) }}" class="btn btn-secondary my-4">
                                            <i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;
                                            Ajouter une nouveau modèle
                                        </a>
                                    </div>
                                </tr>
                            @endforelse
                        </main>
                    </section>

                </div>
            </div>
        </div>
    </div>

@endsection

@once

    @push('footer')

        <script>
            window.addEventListener('DOMContentLoaded', event => {
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
