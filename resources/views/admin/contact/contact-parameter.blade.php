@extends('_layouts.back')

@section('meta_title')
    Paramètres de contact
@endsection

@section('main')
    @include('_partials.back.section.breadcrumbs', ['page_title' => 'Paramètre de contact'])

    @include('_partials.back.notifications.flash-message')

    <div class="row my-4 py-3 bg-light">
        <div class="col-12 d-flex justify-content-end align-items-center">

            <button id="btn-save-alias" class="btn btn-primary rounded-pill">
                <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;
                Enregistrer les modifications
            </button>

        </div>
    </div>

    <div class="row my-4 py-3 bg-white">
        <div class="col-12 px-6">
            <form action="{{ route('admin_contact_index') }}" method="POST">

                <div class="row my-5 py-3 px-2 border border-secondary bg-light">
                    <label for="code" class="col-12">Quelle est l'adresse de l'administrateur</label>
                    <div class="col-12 col-sm-6 col-md-4">
                        <input class="form-control mt-2" type="email" name="admin_email" id="admin_emal" placeholder="Saisir une adresse email" value="{{ $parameter->admin_email }}" required>
                    </div>
                </div>

                <div class="row my-5 py-3 px-2 border border-secondary bg-light">
                    <label for="reservation_email" class="col-12">Qui recevra les messages en relation avec les réservations</label>
                    <div class="col-12 col-sm-6 col-md-4">
                        <input class="form-control mt-2" type="email" name="reservation_email" id="reservation_email" placeholder="Saisir une adresse email" value="{{ $parameter->reservation_email }}" required>
                    </div>
                </div>

                <div class="row my-5 py-3 px-2 border border-secondary bg-light">
                    <label for="contact_email" class="col-12">Qui recevra les messages du formulaire de contact</label>
                    <div class="col-12 col-sm-6 col-md-4">
                        <input class="form-control mt-2" type="email" name="contact_email" id="contact_email" placeholder="Saisir une adresse email" value="{{ $parameter->contact_email }}" required>
                    </div>
                </div>

                <div class="row my-5 py-3 px-2 border border-secondary bg-light">
                    <label for="tel" class="col-12">Numéro de téléphone à afficher en bas de page</label>
                    <div class="col-12 col-sm-6 col-md-4">
                        <input class="form-control mt-2" type="tel" name="tel" id="tel" placeholder="Saisir un numéro de téléphone" value="{{ $parameter->tel }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary rounded-pill" id="btn-submit">
                            <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;
                            Enregistrer la nouvelle marque
                        </button>
                    </div>
                </div>

                @csrf

            </form>

        </div>
    </div>

@endsection

@once

    @push('footer')

        <script>
            window.addEventListener('DOMContentLoaded', event => {
                const alias = document.querySelector('#btn-save-alias');
                if(alias) {
                    alias.addEventListener('click', e => {
                        e.preventDefault();
                        const submit = document.querySelector('#btn-submit');
                        if(!submit) {
                            console.error("Le bouton de soumission est introuvable!");
                            return;
                        }

                        submit.click();
                    });
                }

                const removeForm = document.querySelectorAll('.brand-remove-form');
                if(removeForm && removeForm.length > 0) {
                    removeForm.forEach(form => {
                        form.addEventListener('submit', e => {
                            if(!confirm("Voulez-vous effacer ce modèle ?")) {
                                e.preventDefault();

                                return false;
                            }
                        });
                    });
                }
            });
        </script>

    @endpush

@endonce
