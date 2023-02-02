{{-- Liste des réservations --}}

@extends('_layouts.back')

@php
    $title = $title ?? 'Réservations';
    $routeName = Route::currentRouteName();
@endphp

@section('meta_title')
    {{ $title }}
@endsection

@section('main')
    @include('_partials.back.section.breadcrumbs', ['page_title' => $title])

    @include('_partials.back.notifications.flash-message')

    <div class="row bg-white border border-rounded pt-3 my-4">
        <div class="col mb-3">
            <a href="{{ route('admin_reservation_all') }}" class="btn btn-block {{ $routeName == 'admin_reservation_all' ? 'btn-secondary' : 'btn-outline-secondary' }} me-2">Toute les réservations</a>
        </div>
        <div class="col mb-3">
            <a href="{{ route('admin_reservation_paid') }}" class="btn btn-block {{ $routeName == 'admin_reservation_paid' ? 'btn-dark' : 'btn-outline-dark' }} me-2">Payées</a>
        </div>
        <div class="col mb-3">
            <a href="{{ route('admin_reservation_unpaid') }}" class="btn btn-block {{ $routeName == 'admin_reservation_unpaid' ? 'btn-info' : 'btn-outline-info' }} me-2">Impayées</a>
        </div>
        <div class="col mb-3">
            <a href="{{ route('admin_reservation_canceled') }}" class="btn btn-block {{ $routeName == 'admin_reservation_canceled' ? 'btn-warning' : 'btn-outline-warning' }} me-2">Annulées</a>
        </div>
        <div class="col mb-3">
            <a href="{{ route('admin_reservation_deleted') }}" class="btn btn-block {{ $routeName == 'admin_reservation_deleted' ? 'btn-danger' : 'btn-outline-danger' }}">Effacées</a>
        </div>
    </div>

    <div class="row bg-white py-5 my-3">
        <div class="col-12">

            <section class="list__container">
                <header class="list__header row {{ $bg_header ?? 'bg-secondary' }} text-white mx-0 py-3 mt-3 d-none d-md-flex">
                    <div class="col-2 col-md-1 d-none d-md-flex">#</div>
                    <div class="col-10 col-md-3 mr-auto">Départ</div>
                    <div class="col-10 col-md-3 mr-auto">Arrivée</div>
                    <div class="col-10 col-md-3 mr-auto">Client</div>
                    <div class="col-10 col-md-2 mr-auto">Actions</div>
                </header>
                <main class="list__main">
                    @forelse ($reservations as $res)
                        <div @class([
                            'row', 'border-bottom', 'py-2', 'mx-0',
                            'bg-light' => $loop->even,
                        ])>
                            <div class="col-2 col-md-1 d-none d-md-flex">
                                {{ $res->id }}
                            </div>
                            <div class="col-10 col-md-3 mr-auto">
                                <u class="fw-bold d-inline-block d-md-none me-1">Départ: </u>{{ $res->getDepartureLabel() }}
                            </div>
                            <div class="col-10 col-md-3 mr-auto">
                                <u class="fw-bold d-inline-block d-md-none me-1">Arrivée: </u>{{ $res->getArrivalLabel() }}
                            </div>
                            <div class="col-10 col-md-3 mr-auto">
                                <u class="fw-bold d-inline-block d-md-none me-1">Client: </u>{{ $res->getUserName() }}
                            </div>
                            <div class="col-10 col-md-2 mr-auto d-flex flex-wrap">
                                <a href="{{ route('admin_reservation_details', ['reservation' => $res->id]) }}" class="btn btn-outline-info me-1">
                                    <i class="fa fa-eye" aria-hidden="true"></i>&nbsp;
                                    Détails
                                </a>

                                @if($res->status == 'paid' || $res->status == 'unpaid')

                                <form action="{{ route('admin_reservation_cancel', ['reservation' => $res->id]) }}" method="post" class="form-cancel">
                                    <button type="submit" @class([
                                        'btn',
                                        'btn-outline-warning',
                                    ])>
                                        <i class="fa fa-ban" aria-hidden="true"></i>&nbsp;
                                        Annuler
                                    </button>
                                    @csrf
                                </form>

                                @elseif ($res->status == 'cancel')

                                <form action="{{ route('admin_reservation_delete', ['reservation' => $res->id]) }}" method="post" class="form-delete">
                                    <button type="submit" @class([
                                        'btn',
                                        'btn-outline-error',
                                    ])>
                                        <i class="fa fa-trash" aria-hidden="true"></i>&nbsp;
                                        Effacer
                                    </button>
                                    @csrf
                                </form>

                                @endif

                            </div>
                        </div>
                    @empty
                        <div class="row mx-0">
                            <div class="col-12 py-5">
                                <em>Aucune réservation trouvée</em>
                            </div>
                        </div>
                    @endforelse
                </main>
                <footer class="list__footer row mx-0">
                    <div class="col-12 d-flex flex-wrap justify-content-center align-items-center">
                        {!! $reservations->links() !!}
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
            const cancels = document.querySelector(".form-cancel");
            if(cancels && cancels.length > 0) {
                cancels.forEach(form => {
                    form.addEventListener("submit", e => {
                        if(!confirm("Voulez-vous annuler cette réservation ?")) {
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
                        if(!confirm("Voulez-vous effacer cette réservation ?")) {
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
