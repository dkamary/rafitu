{{-- Admin User Index --}}

@extends('_layouts.back')

@section('meta_title')
    Utilisateurs
@endsection

@section('main')
    @include('_partials.back.section.breadcrumbs', ['page_title' => 'Utilisateurs'])

    @include('_partials.back.notifications.flash-message')

    <div class="row bg-white py-5">
        <div class="col-12">

            <section class="list__container">
                <header class="list__header row bg-secondary text-white mx-0 py-3 mt-3 d-none d-md-flex">
                    <div class="col-6 col-md-2 title">Prénom</div>
                    <div class="col-6 col-md-3 title">Nom</div>
                    <div class="col-4 col-md-3 fw-bold title">E-mail</div>
                    <div class="col-4 col-md-1 fw-bold title">Type</div>
                    <div class="col-4 col-md-3 fw-bold title">
                        <a href="{{ route('admin_user_new') }}" class="btn btn-dark">
                            <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;
                            Ajouter un utilisateur
                        </a>
                    </div>
                </header>
                <main class="list__main">
                    @forelse ($users as $user)
                        <div @class([
                            'row', 'border-bottom', 'py-3', 'mx-0',
                            'my-3', 'my-md-1',
                            'bg-light' => $loop->even,
                        ])>
                            <div class="col-12 col-md-2">
                                <u class="fw-bold d-inline-block d-md-none me-1">Prénom: </u>{{ $user->firstname }}
                            </div>
                            <div class="col-12 col-md-3">
                                <u class="fw-bold d-inline-block d-md-none me-1">Nom: </u>{{ $user->lastname }}
                            </div>
                            <div class="col-12 col-md-3">
                                <u class="fw-bold d-inline-block d-md-none me-1">E-mail: </u>{{ $user->email }}
                            </div>
                            <div class="col-12 col-md-1">
                                <u class="fw-bold d-inline-block d-md-none me-1">Type: </u>{{ $user->getUserTypeName() }}
                            </div>
                            <div class="col-12 col-md-3">
                                <a href="{{ route('admin_user_edit', ['user' => $user->id]) }}" class="btn btn-outline-info">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;
                                    &Eacute;diter
                                </a>
                                &nbsp;
                                <a href="{{ route('admin_user_deactivate', ['user' => $user->id]) }}" class="btn btn-outline-danger">
                                    <i class="fa fa-trash" aria-hidden="true"></i>&nbsp;
                                    Désactiver
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="row mx-0">
                            <div class="col-12">
                                <em>Aucun utilisateur trouvé</em>
                            </div>
                        </div>
                    @endforelse
                </main>
                <footer class="list__footer row mx-0"></footer>
            </section>

        </div>
    </div>
@endsection


@once
    @push('head')
    <style>
        .list__container .title {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            font-weight: bold;
            font-size:  1.2rem;
        }

        .list__main .row > div {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            margin-top: .5rem;
            margin-bottom: .5rem;
        }
    </style>
    @endpush
@endonce
