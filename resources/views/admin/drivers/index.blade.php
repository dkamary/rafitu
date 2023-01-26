{{-- Admin User Index --}}

@extends('_layouts.back')

@php
    $pageTitle = $pageTitle ?? 'Chauffeurs';
@endphp

@section('meta_title')
    {{ $pageTitle }}
@endsection

@section('main')
    @include('_partials.back.section.breadcrumbs', ['page_title' => $pageTitle])

    @include('_partials.back.notifications.flash-message')

    <div class="row bg-white py-5">
        <div class="col-12">

            <section class="list">
                <header class="row d-none d-md-flex bg-secondary text-white py-3 my-3">
                    <div class="col-6 fs-6 fw-bold">Nom</div>
                    <div class="col-3 fs-6 fw-bold">Statut</div>
                    <div class="col-3 fs-6 fw-bold text-center">Actions</div>
                </header>
                <main>
                    @forelse ($drivers as $u)
                        <div @class([
                            'bg-light' => $loop->even,
                            'row', 'border-bottom', 'border-black',
                            'py-2', 'my-2'
                        ])>
                            <div class="col-7 col-md-6 fst-italic fw-bold">
                                {{ $u->firstname }} {{ $u->lastname }}
                            </div>
                            <div class="col-5 col-md-3">
                                {!! $u->user_status_id != 5 ? '<span>Non vérifié</span>' : 'Vérifié' !!}
                            </div>
                            <div class="col-12 col-md-3 d-flex justify-content-center justify-content-md-start align-items-center my-2 my-md-0">
                                <a href="{{ route('admin_driver_show', ['driver' => $u->id]) }}" class="btn btn-outline-info m-1">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;
                                    &Eacute;diter
                                </a>

                                <form action="{{ route('admin_driver_remove') }}" method="POST" class="m-1 driver-remove-form">
                                    <button type="submit" class="btn btn-outline-danger">
                                        <i class="fa fa-times" aria-hidden="true"></i>&nbsp;
                                        Effacer
                                    </button>
                                    <input type="hidden" name="id" value="{{ $u->id }}">
                                    <input type="hidden" name="intent" value="{{ $intent ?? 'admin_ride_list' }}">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="row">
                            <div class="col-12 py-3">
                                Il n'y a pas encore de chauffeur à valider.
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
        <script id="driver-index-script">

            window.addEventListener("DOMContentLoaded", event => {
                const removeForms = document.querySelectorAll(".driver-remove-form");
                if(removeForms && removeForms.length > 0) {
                    removeForms.forEach(form => {
                        form.addEventListener("submit", e => {
                            if(!confirm("Voulez-vous effacer ce chauffeur ?")) {
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
