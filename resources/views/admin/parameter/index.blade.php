{{-- Parameter index --}}

@extends('_layouts.back')

@section('meta_title')
    Paramètres
@endsection

@section('main')
    @include('_partials.back.section.breadcrumbs', ['page_title' => 'Paramètres'])

    @include('_partials.back.notifications.flash-message')

    <div class="row py-5 bg-white">
        <div class="col-12">

            <div class="row">
                <div class="col-12 col-sm-8 col-md-6 mx-auto">
                    <div class="row">
                        <div class="col-12 col-sm-6 my-2">
                            <a href="{{ route('transaction_mode_de_paiements') }}" class="btn btn-outline-primary btn-block">
                                <i class="fa fa-credit-card-alt" aria-hidden="true"></i>&nbsp;
                                Modes de paiement
                            </a>
                        </div>
                        <div class="col-12 col-sm-6 my-2">
                            <a href="{{ route('admin_brand_index') }}" class="btn btn-outline-primary btn-block">
                                <i class="fa fa-car" aria-hidden="true"></i>&nbsp;
                                Marque des véhicules
                            </a>
                        </div>
                        <div class="col-12 col-sm-6 my-2">
                            <a href="{{ route('admin_contact_index') }}" class="btn btn-outline-primary btn-block">
                                <i class="fa fa-users" aria-hidden="true"></i>&nbsp;
                                Contacts
                            </a>
                        </div>
                        <div class="col-12 col-sm-6 my-2">
                            <a href="{{ route('admin_ride_parameters') }}" class="btn btn-outline-primary btn-block">
                                <i class="fa fa-map" aria-hidden="true"></i>&nbsp;
                                Trajets
                            </a>
                        </div>
                        <div class="col-12 col-sm-6 my-2">
                            <a href="{{ route('admin_social_network_parameter_index') }}" class="btn btn-outline-primary btn-block">
                                <i class="fa fa-share-square" aria-hidden="true"></i>&nbsp;
                                Réseaux sociaux
                            </a>
                        </div>
                    </div>
                </div>
            </div>

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
