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
                                <div class="d-flex justify-content-start align-items-center">
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
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">
                                Il n'y a pas encore de chauffeur à valider.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4">
                            &nbsp;
                        </td>
                    </tr>
                </tfoot>
            </table>
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
