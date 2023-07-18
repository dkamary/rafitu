{{-- Admin Ride list --}}

@extends('_layouts.back')

@php
    $filter = $filter ?? 'a-valider';
    $title = '';
    if ($filter == 'planifie') {
        $title = 'Planifié';
    } elseif ($filter == 'a-valider') {
        $title = 'A valider';
    } elseif ($filter == 'efface') {
        $title = 'Effacé';
    } elseif ($filter == 'arrive') {
        $title = 'Arrivé';
    } elseif ($filter == 'annule') {
        $title = 'Annulé';
    }
@endphp

@section('meta_title')
    Trajets {{ $title }}(s)
@endsection

@section('main')
    @include('_partials.back.section.breadcrumbs', ['page_title' => 'Trajets'])

    @include('_partials.back.notifications.flash-message')

    <div class="row py-5 bg-white">
        <div class="col-12">

            <div class="row my-3">
                <div class="col-6 col-md-2">
                    <a @class(['btn', 'btn-block', 'btn-success' => ($filter == 'a-valider'), 'btn-outline-success' => !($filter == 'a-valider')])
                        href="{{ route('admin_ride_index', ['filter' => 'a-valider']) }}">
                        A valider
                    </a>
                </div>
                <div class="col-6 col-md-2">
                    <a @class(['btn', 'btn-block', 'btn-secondary' => ($filter == 'planifie'), 'btn-outline-secondary' => !($filter == 'planifie')])
                        href="{{ route('admin_ride_index', ['filter' => 'planifie']) }}">
                        Planifié
                    </a>
                </div>
                <div class="col-6 col-md-2">
                    <a @class(['btn', 'btn-block', 'btn-warning' => ($filter == 'efface'), 'btn-outline-warning' => !($filter == 'efface')])
                        href="{{ route('admin_ride_index', ['filter' => 'efface']) }}">
                        Effacé
                    </a>
                </div>
                <div class="col-6 col-md-2">
                    <a @class(['btn', 'btn-block', 'btn-danger' => ($filter == 'annule'), 'btn-outline-danger' => !($filter == 'annule')])
                        href="{{ route('admin_ride_index', ['filter' => 'annule']) }}">
                        Annulé
                    </a>
                </div>
            </div>
            <section class="trajet-list my-5">
                <header class="trajet-list__header row py-3 bg-secondary mx-0 text-white">
                    <div class="col-md-1 col-12 d-none d-md-flex fw-bold fs-6">#</div>
                    <div class="col-md-4 col-12 d-none d-md-flex fw-bold fs-6">Trajet</div>
                    <div class="col-md-2 col-12 d-none d-md-flex fw-bold fs-6">Date de départ</div>
                    <div class="col-md-2 col-12 d-none d-md-flex fw-bold fs-6">Statut</div>
                    <div class="col-md-3 col-12 d-none d-md-flex fw-bold fs-6">Action</div>
                </header>
                <main class="trajet-list__main">
                    @forelse ($rides as $ride)
                        <div @class([
                            'row', 'mx-0', 'py-2', 'my-5', 'mx-0',
                            'border-bottom', 'border-black',
                            'bg-light' => $loop->even
                        ])>
                            <div class="col-md-1 col-12 d-none d-md-flex align-items-center py-1">
                                {{ $ride->id }}
                            </div>
                            <div class="col-md-4 col-12 d-flex align-items-center flex-wrap py-1">
                                <p class="mb-1">
                                    <strong><u>Départ</u> :</strong>
                                    <em>{{ $ride->departure_label }}</em>
                                </p>
                                <p class="mb-">
                                    <strong><u>Arrivée</u> :</strong>
                                    <em>{{ $ride->arrival_label }}</em>
                                </p>
                            </div>
                            <div class="col-md-2 col-12 d-flex align-items-center py-1">
                                <u class="fw-bold d-inline-block d-md-none me-1">Date de départ: </u>&nbsp;
                                {{ display_date($ride->departure_date, 'H:i') }}
                            </div>
                            <div class="col-md-2 col-12 d-flex align-items-center py-1">
                                <u class="fw-bold d-inline-block d-md-none me-1">Statut: </u>&nbsp;
                                <strong @class([
                                    'text-success' => $ride->ride_status_id == 1,
                                    'text-info' => $ride->ride_status_id == 2,
                                    'text-danger' => $ride->ride_status_id == 4,
                                    'text-warning' => $ride->ride_status_id == 5
                                ])>
                                    {{ ride_status($ride->ride_status_id) }}
                                </strong>
                            </div>
                            <div class="col-md-3 col-12 d-flex align-items-center py-1">
                                <div class="d-flex flex-wrap justify-content-center align-items-center">

                                    <a href="{{ route('admin_ride_show', ['ride' => $ride->id]) }}" class="btn btn-outline-info ms-1 my-1">
                                        <i class="fa fa-check-square-o" aria-hidden="true"></i>&nbsp;
                                        <span class="">Voir</span>
                                    </a>

                                    <form action="{{ route('admin_ride_remove') }}" method="POST" class="remove-ride-form ms-1 my-1">
                                        <button type="submit" class="btn btn-outline-danger">
                                            <i class="fa fa-times" aria-hidden="true"></i>&nbsp;
                                            <span class="">Effacer</span>
                                        </button>
                                        <input type="hidden" id="id" name="id" value="{{ $ride->id }}">
                                        @csrf
                                    </form>

                                    @if ($ride->isToValidate())
                                    <form action="{{ route('admin_ride_validate') }}" method="post" class="validate-ride-form ms-1 my-1">
                                        <button type="submit" class="btn btn-outline-dark">
                                            <i class="fa fa-check-square-o" aria-hidden="true"></i>&nbsp;
                                            <span class="">Valider</span>
                                        </button>
                                        <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" id="id" name="id" value="{{ $ride->id }}">
                                    </form>
                                    @endif

                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="row">
                            <div class="col-12 pt-5 ps-6">
                                <em>Aucun trajet trouvé dans la base de données</em>
                            </div>
                        </div>
                    @endforelse
                </main>
            </section>
        </div>
    </div>
@endsection

@once

    @push('footer')
        <script>
            window.addEventListener("DOMContentLoaded", event => {
                manageValidateForm();
                manageRemoveForm();
            });

            const manageValidateForm = () => {
                const validateForms = document.querySelectorAll(".validate-ride-form");
                if(!validateForms || validateForms.length == 0) {
                    return;
                }

                validateForms.forEach(form => {
                    form.addEventListener("submit", e => {
                        e.preventDefault();
                        if(!confirm("Voulez-vous valider ce trajet ?")) return;

                        const id = form.querySelector("#id");
                        const token = form.querySelector('#token');
                        const status = 1;

                        const $ = window.jQuery;
                        $.ajax({
                            type: 'post',
                            url: form.action,
                            data: {
                                id: id.value,
                                token: token.value,
                                ride_status_id: status
                            }
                        })
                        .done(response => {
                            if(response.done) {
                                window.location.reload();
                            } else {
                                alert(response.message);
                            }
                        })
                        .fail(xhr => {
                            alert(`${xhr.status} - ${xhr.statusText}`);
                        })
                        ;
                    })
                });
            };

            const manageRemoveForm = () => {
                const removeForms = document.querySelectorAll('.remove-ride-form');
                if(!removeForms || removeForms.length == 0) {
                    return;
                }

                removeForms.forEach(form => {
                    form.addEventListener("submit", e => {
                        if(!confirm("Voulez-vous effacer ce trajet ?")) {
                            e.preventDefault();

                            return;
                        }
                    });
                });
            };
        </script>
    @endpush

@endonce
