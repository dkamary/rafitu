{{-- Liste des commentaires --}}

@extends('_layouts.back')

@php
    $title = $title ?? 'Commentaires';
    $routeName = Route::currentRouteName();
    $type = request()->input('type');
@endphp

@section('meta_title')
    {{ $title }}
@endsection

@section('main')
    @include('_partials.back.section.breadcrumbs', ['page_title' => $title])

    @include('_partials.back.notifications.flash-message')

    <div class="row bg-white border border-rounded pt-3 my-4">
        <div class="col mb-3">
            <a href="{{ route('admin_review_index') }}" @class(['btn', 'btn-block', 'me-2', 'btn-secondary' => !$type, 'btn-outline-secondary' => $type])>Tous les commentaires</a>
        </div>
        <div class="col mb-3">
            <a href="{{ route('admin_review_index', ['type' => 'todo']) }}" @class(['btn', 'btn-block', 'me-2', 'btn-dark' => $type == 'todo', 'btn-outline-dark' => $type != 'todo'])>A valider</a>
        </div>
        <div class="col mb-3">
            <a href="{{ route('admin_review_index', ['type' => 'deactivated']) }}" @class(['btn', 'btn-block', 'me-2', 'btn-warning' => $type == 'deactivated', 'btn-outline-warning' => $type != 'deactivated'])>Non validés</a>
        </div>
    </div>

    <div class="row bg-white py-5 my-3">
        <div class="col-12">

            <section class="list__container">
                <header class="list__header row {{ $bg_header ?? 'bg-secondary' }} text-white mx-0 py-3 mt-3 d-none d-md-flex">
                    <div class="col-2 col-md-1 d-none d-md-flex">#</div>
                    <div class="col-10 col-md-3 mr-auto">Commentaires</div>
                    <div class="col-10 col-md-3 mr-auto">Utilisateur</div>
                    <div class="col-10 col-md-3 mr-auto">Statut</div>
                    <div class="col-10 col-md-2 mr-auto">Actions</div>
                </header>
                <main class="list__main">
                    @forelse ($reviews as $review)
                        <div @class([
                            'row', 'border-bottom', 'py-2', 'mx-0',
                            'bg-light' => $loop->even,
                        ])>
                            <div class="col-2 col-md-1 d-none d-md-flex">
                                {{ $review->id }}
                            </div>
                            <div class="col-10 col-md-3 mr-auto">
                                <u class="fw-bold d-inline-block d-md-none me-1">Commentaire: </u>
                                ({{ $review->note }} &Eacute;toile{{ $review->note > 1 ? 's' : '' }})&nbsp;
                                {{ $review->comments }}
                            </div>
                            <div class="col-10 col-md-3 mr-auto">
                                <u class="fw-bold d-inline-block d-md-none me-1">Utilisateur: </u>{!! $review->getUserName() !!}
                            </div>
                            <div class="col-10 col-md-3 mr-auto">
                                <u class="fw-bold d-inline-block d-md-none me-1">Statut: </u>
                                @if($review->is_active == 1)
                                    <span class="bg-success text-white d-inline-block px-1">Validé</span>
                                @elseif ($review->is_active == 0)
                                    <span class="bg-danger text-white d-inline-block px-1">Non validé</span>
                                @elseif ($review->is_active == 2)
                                    <span class="bg-secondary text-white d-inline-block px-1">A valider</span>
                                @endif
                            </div>
                            <div class="col-10 col-md-2 mr-auto d-flex flex-wrap">
                                <a href="{{ route('admin_review_show', ['review' => $review->id]) }}" class="btn btn-outline-info me-1">
                                    <i class="fa fa-eye" aria-hidden="true"></i>&nbsp;
                                    Détails
                                </a>

                                @if($review->is_active != 1)

                                <form action="{{ route('admin_review_validate') }}" method="post" class="form-validate">
                                    <button type="submit" @class([
                                        'btn',
                                        'btn-outline-success',
                                    ])>
                                        <i class="fa fa-check" aria-hidden="true"></i>&nbsp;
                                        Valider
                                    </button>
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $review->id }}">
                                </form>

                                @elseif ($review->is_active == 1)

                                <form action="{{ route('admin_review_deactivate') }}" method="post" class="form-delete">
                                    <button type="submit" @class([
                                        'btn',
                                        'btn-outline-danger',
                                    ])>
                                        <i class="fa fa-trash" aria-hidden="true"></i>&nbsp;
                                        Effacer
                                    </button>
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $review->id }}">
                                </form>

                                @endif

                            </div>
                        </div>
                    @empty
                        <div class="row mx-0">
                            <div class="col-12 py-5">
                                <em>Aucun commentaire trouvée</em>
                            </div>
                        </div>
                    @endforelse
                </main>
                <footer class="list__footer row mx-0">
                    <div class="col-12 d-flex flex-wrap justify-content-center align-items-center">
                        {!! $reviews->links() !!}
                    </div>
                </footer>
            </section>

        </div>
    </div>

@endsection

@once
    @push('footer')
    <script>
        window.addEventListener("DOMContentLoaded", event => {
            const validates = document.querySelector(".form-validate");
            if(validates && validates.length > 0) {
                validates.forEach(form => {
                    form.addEventListener("submit", e => {
                        if(!confirm("Voulez-vous valider ce commentaire ?")) {
                            e.preventDefault();

                            return;
                        }
                    });
                });
            }

            const deletes = document.querySelector(".form-delete");
            if(deletes && deletes.length > 0) {
                deletes.forEach(form => {
                    form.addEventListener("submit", e => {
                        if(!confirm("Voulez-vous effacer ce commentaire ?")) {
                            e.preventDefault();

                            return;
                        }
                    });
                });
            }
        });
    </script>
    @endpush
@endonce
