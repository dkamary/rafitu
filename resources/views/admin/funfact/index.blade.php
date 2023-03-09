{{-- Admin Funfact Index --}}

@extends('_layouts.back')

@section('meta_title')
    Nos faits amusants
@endsection

@section('main')
    @include('_partials.back.section.breadcrumbs', ['page_title' => 'Nos faits amusants'])

    @include('_partials.back.notifications.flash-message')

    <div class="row bg-white py-5">
        <div class="col-12">

            <section class="list__container">
                <header class="list__header row bg-secondary text-white mx-0 py-3 mt-3 d-none d-md-flex">
                    <div class="col-6 col-md-4 fw-bold title">Titre</div>
                    <div class="col-6 col-md-4 fw-bold title">Valeur</div>
                    <div class="col-12 col-md-4 fw-bold title">
                        <a href="{{ route('admin_funfact_new') }}" class="btn btn-dark">
                            <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;
                            Ajouter un fait amusant
                        </a>
                    </div>
                </header>
                <main class="list__main">
                    @forelse ($funfacts as $f)
                        <div @class([
                            'row', 'border-bottom', 'py-3', 'mx-0',
                            'my-3', 'my-md-1',
                            'bg-light' => $loop->even,
                        ])>
                            <div class="col-12 col-md-4">
                                <u class="fw-bold d-inline-block d-md-none me-1">Titre: </u>{{ $f->title }}
                            </div>
                            <div class="col-12 col-md-4">
                                <u class="fw-bold d-inline-block d-md-none me-1">Valeur: </u>{{ $f->count }}
                            </div>
                            <div class="col-12 col-md-4">
                                <a href="{{ route('admin_funfact_edit', ['funfact' => $f->id]) }}" class="btn btn-outline-info">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;
                                    &Eacute;diter
                                </a>
                                &nbsp;
                                <form action="{{ route('admin_funfact_remove') }}" method="post">
                                    <button type="submit" class="btn btn-outline-danger" onclick="if(!confirm('Voulez-vous effacer ce fait amusant?')) return false;">
                                        <i class="fa fa-trash" aria-hidden="true"></i>&nbsp;
                                        Désactiver
                                    </button>
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $f->id }}">
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="row mx-0">
                            <div class="col-12">
                                <em>Aucun fait amusant trouvé</em>
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
