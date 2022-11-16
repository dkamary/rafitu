{{-- Admin User Index --}}

@extends('_layouts.back')

@section('meta_title')
    Utilisateurs
@endsection

@section('main')
    @include('_partials.back.section.breadcrumbs', ['page_title' => 'Utilisateurs'])

    @include('_partials.back.notifications.flash-message')

    <div class="row">
        <div class="col-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th width="20%">Prénom</th>
                        <th width="20%">Nom</th>
                        <th width="20%">E-mail</th>
                        <th width="10%">Type</th>
                        <th width="30%">
                            <div class="d-flex justify-content-between">
                                <span>Actions</span>
                                <a href="{{ route('admin_blog_new') }}">
                                    <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;
                                    Ajouter un article
                                </a>
                            </div>

                        </th>
                    </tr>
                </thead>
                <tbody>

                    @forelse ($users as $u)
                        <tr>
                            <td>
                                {{ $u->firstname }}
                            </td>
                            <td>
                                {{ $u->lastname }}
                            </td>
                            <td>
                                {{ $u->email }}
                            </td>
                            <td>
                                {{ $u->getUserTypeName() }}
                            </td>
                            <td>
                                <a href="{{ route('admin_user_edit', ['user' => $u->id]) }}">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;
                                    &Eacute;diter
                                </a>
                                &nbsp;
                                <a href="{{ route('admin_user_deactivate', ['user' => $u->id]) }}">
                                    <i class="fa fa-trash" aria-hidden="true"></i>&nbsp;
                                    Désactiver
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2">
                                Il n'y a pas encore d'utilisateur.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2">
                            {!! $users->links() !!}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
