{{-- Marque de véhicule --}}

@extends('_layouts.back')

@section('meta_title')
    Marques de véhicule
@endsection

@section('main')
    @include('_partials.back.section.breadcrumbs', ['page_title' => 'Marques de véhicule'])

    @include('_partials.back.notifications.flash-message')

    <div class="row my-4 py-3 bg-light">
        <div class="col-12 d-flex justify-content-end align-items-center">
            <form action="{{ route('admin_brand_index') }}" method="get" class="me-2 w-25 d-none">
                <div class="row">
                    <div class="col-12">
                        <input type="search" name="search" id="search" class="form-control pe-4" placeholder="Rechercher une marque" aria-label="Rechercher une marque" aria-describedby="btn-search">
                    </div>
                    <div class="col-2 d-none">
                        <button class="btn btn-block btn-outline-secondary" type="submit" id="btn-search">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
            </form>
            <a href="{{ route('admin_brand_nouveau') }}" class="btn btn-secondary rounded-pill">
                <i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;
                Ajouter une nouvelle marque
            </a>
        </div>
    </div>

    <div class="row my-4 py-3 bg-white">
        <div class="col-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th width="60%">Marques</th>
                        <th width="20%" class="text-center">Modèles</th>
                        <th width="20%">
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>

                    @forelse ($brands as $brand)
                        <tr>
                            <td>
                                {{ $brand->name }}
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin_model_index', ['brand' => $brand]) }}" class="btn btn-link btn-outline-secondary" title="Voir les {{ $brand->getModelCount() }} modèles de la marque">
                                    {{ $brand->getModelCount() }}
                                </a>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center align-items-center">
                                    <a href="{{ route('admin_brand_editer', ['brand' => $brand]) }}" class="btn btn-info me-2">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;
                                        &Eacute;diter
                                    </a>
                                    <form action="{{ route('admin_brand_effacer') }}" method="post" class="brand-remove-form">
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fa fa-trash" aria-hidden="true"></i>&nbsp;
                                            Supprimer
                                        </button>
                                        <input type="hidden" name="id" value="{{ $brand->id }}">
                                        @csrf
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">
                                Il n'y a pas encore de marque enregistré.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2">
                            <div class="d-flex justify-content-center align-items-center my-3">
                                {!! $brands->links() !!}
                            </div>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection

@once

    @push('footer')

        @include('admin.vehicle.brand._partials.javascript-index')

    @endpush

@endonce
