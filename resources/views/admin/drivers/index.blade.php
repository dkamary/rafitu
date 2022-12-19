{{-- Admin User Index --}}

@extends('_layouts.back')

@section('meta_title')
    Chauffeurs
@endsection

@section('main')
    @include('_partials.back.section.breadcrumbs', ['page_title' => 'Chauffeurs'])

    @include('_partials.back.notifications.flash-message')

    <div class="row">
        <div class="col-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th width="20%">Prénom</th>
                        <th width="20%">Nom</th>
                        <th width="30%">Statut</th>
                        <th width="30%">
                            <div class="d-flex justify-content-between">
                                <span>Actions</span>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody>

                    @forelse ($drivers as $u)
                        <tr>
                            <td>
                                {{ $u->firstname }}
                            </td>
                            <td>
                                {{ $u->lastname }}
                            </td>
                            <td>
                                {{ $u->user_status_id != 5 ? 'Non vérifié' : 'Vérifié' }}
                            </td>
                            <td>
                                <a href="{{ route('admin_driver_show', ['driver' => $u->id]) }}">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;
                                    &Eacute;diter
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">
                                Il n'y a pas encore de chauffeur à valider.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3">
                            &nbsp;
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
