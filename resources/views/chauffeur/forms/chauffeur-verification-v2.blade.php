{{-- Formulaire de vérification chauffeur V2 --}}

@php
    $form_classes = $form_classes ?? 'no-class';
@endphp

<form action="{{ route('driver_verification') }}" method="POST" enctype="multipart/form-data"  @class(["row", "driver-form-verification", $form_classes])>
    <div class="col-12">

        <div class="row my-4 py-3">
            <div class="col-12">
                <h2 class="fw-bold fs-3 txt-rafitu text-center">
                    {{ $form_title ?? 'Vérification chauffeur' }}
                </h2>
            </div>
        </div>

        <div class="row my-4 py-3 border-top border-info">

            <div class="col-12 col-md-5 order-2 order-md-1">
                <img src="{{ asset('images/identity-card.png') }}" alt="" id="piece-preview" class="img-fluid">
                <div class="row my-3">
                    <div class="col-12 text-center">
                        <button class="btn btn-outline-primary my-3" onclick="document.querySelector('#identification_scan').click();">
                            <i class="fa fa-upload" aria-hidden="true"></i>&nbsp;
                            Sélectionner fichier
                        </button>
                        <input type="file" name="identification_scan" id="identification_scan" class="form-control d-none" required>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-7 order-1 order-md-2">

                <div class="row">
                    <div class="col-12">
                        <h3 class="fw-bold fs-5 txt-rafitu mb-3">
                            Type d'identité
                        </h3>

                        <div class="mb-3">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="identification_type_id" id="identification_type_1" value="1" checked>
                                <label class="form-check-label" for="identification_type_1">Carte d'identité</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="identification_type_id" id="identification_type_2" value="2">
                                <label class="form-check-label" for="identification_type_2">Passeport</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <h4 class="fw-bold fs-6 txt-rafitu mb-3">
                            Numéro de la pièce
                        </h4>

                        <div class="row">
                            <div class="col-12 col-md-6">
                                <input type="text" name="identification_number" id="identification_number" class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row my-3">
                    <div class="col-12">
                        <h4 class="fw-bold fs-6 txt-rafitu mb-3">
                            Date d'obtention
                        </h4>

                        <div class="row">
                            <div class="col-12 col-md-6">
                                <input type="date" name="identification_date" id="identification_date" class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <div class="row my-4 py-3 border border-info border-start-0 border-end-0 border-bottom-0">

            <div class="col-12 col-md-5 order-2 order-md-1">
                <img src="{{ asset('images/driver-license.png') }}" alt="" id="permis-preview" class="img-fluid">
                <div class="row my-3">
                    <div class="col-12 text-center">
                        <button class="btn btn-outline-primary my-3" onclick="document.querySelector('#licence_scan').click();">
                            <i class="fa fa-upload" aria-hidden="true"></i>&nbsp;
                            Sélectionner fichier
                        </button>
                        <input type="file" name="licence_scan" id="licence_scan" class="form-control d-none">
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-7 order-1 order-md-2">

                <div class="row">
                    <div class="col-12">
                        <h3 class="fw-bold fs-5 txt-rafitu mb-3">
                            Permis de conduire
                        </h3>

                        <div class="row">
                            <div class="col-12 col-md-6">
                                <input type="text" name="licence_number" id="licence_number" class="form-control" required placeholder="Numéro du permis de conduire">
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <div class="row my-4 py-3 border border-info border-start-0 border-end-0">

            <div class="col-12 col-md-5 order-2 order-md-1">
                <img src="{{ asset('images/parking.png') }}" alt="" id="vehicle-preview" class="img-fluid">
                <div class="row my-3">
                    <div class="col-12 text-center">
                        <button class="btn btn-outline-primary my-3" onclick="document.querySelector('#vehicle_main_image').click();">
                            <i class="fa fa-upload" aria-hidden="true"></i>&nbsp;
                            Sélectionner fichier
                        </button>
                        <input type="file" name="vehicle_main_image" id="vehicle_main_image" class="form-control d-none">
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-7 order-1 order-md-2">

                <div class="row">
                    <div class="col-12">
                        <h3 class="fw-bold fs-5 txt-rafitu mb-3">
                            Véhicule
                        </h3>

                        <div class="row mb-3 d-flex justify-content-center align-items-center">
                            <label for="vehicle_brand" class="col-12 col-md-4 fw-bold">
                                Marque
                            </label>
                            <div class="col-12 col-md-6">
                                <select class="form-select" name="vehicle_brand" id="vehicle_brand" aria-label="Marque du véhicule" required>
                                    <option value="" selected>Marque du véhicule</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3 d-flex justify-content-center align-items-center">
                            <label for="vehicle_model" class="col-12 col-md-4 fw-bold">
                                Modèle
                            </label>
                            <div class="col-12 col-md-6">
                                <select class="form-select" name="vehicle_model" id="vehicle_model" aria-label="Modèle du véhicule" required>
                                    <option value="" selected>Modèle du véhicule</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row my-5 d-none">
                    <div class="col-12">
                        <h3 class="fw-bold fs-5 txt-rafitu mb-3">
                            Galerie photos
                        </h3>

                        <div class="row mb-3" id="vehicle_gallery">
                            <div class="col-12 col-md-3">
                                <button type="button" class="btn btn-secondary btn-block">
                                    Ajouter une photo
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row my-5">

                    <div class="col-12">
                        <h3 class="fw-bold fs-5 txt-rafitu mb-3">
                            Certificat de visite technique en cours
                        </h3>

                        <div class="row mb-3" id="vehicle_gallery">
                            <div class="col-12 col-md-6">
                                <img src="{{ asset('images/checklist.png') }}" alt="" id="technical-preview" class="img-fluid">
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <button class="btn btn-outline-primary my-3" onclick="document.querySelector('#technical_check_scan').click();">
                                            <i class="fa fa-upload" aria-hidden="true"></i>&nbsp;
                                            Sélectionner fichier
                                        </button>
                                        <input type="file" name="technical_check_scan" id="technical_check_scan" class="form-control d-none" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row my-5">

                    <div class="col-12">
                        <h3 class="fw-bold fs-5 txt-rafitu mb-3">
                            Assurance en cours
                        </h3>

                        <div class="row mb-3" id="vehicle_gallery">
                            <div class="col-12 col-md-6">
                                <img src="{{ asset('images/insurance.png') }}" alt="" id="insurrance-preview" class="img-fluid">
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <button class="btn btn-outline-primary my-3" onclick="document.querySelector('#insurrance_scan').click();">
                                            <i class="fa fa-upload" aria-hidden="true"></i>&nbsp;
                                            Sélectionner fichier
                                        </button>
                                        <input type="file" name="insurrance_scan" id="insurrance_scan" class="form-control d-none" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row my-5">

                    <div class="col-12">
                        <h3 class="fw-bold fs-5 txt-rafitu mb-3">
                            Carte grise
                        </h3>

                        <div class="row mb-3" id="vehicle_gallery">
                            <div class="col-12 col-md-6">
                                <img src="{{ asset('images/parking.png') }}" alt="" id="gray-card-preview" class="img-fluid">
                                <div class="row">
                                    <div class="col-12">
                                        <button class="btn btn-outline-primary my-3" onclick="document.querySelector('#gray_card_scan').click();">
                                            <i class="fa fa-upload" aria-hidden="true"></i>&nbsp;
                                            Sélectionner fichier
                                        </button>
                                        <input type="file" name="gray_card_scan" id="gray_card_scan" class="form-control d-none" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>

        <div class="row mb-3">
            <div class="col text-center">
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-check" aria-hidden="true"></i>&nbsp;
                    Soumettre à validation
                </button>
            </div>
        </div>

        @csrf

    </div>
</form>

@once

    @push('footer')
        <script defer>
            window.addEventListener('DOMContentLoaded', event => {
                const identity = document.querySelector('#identification_scan');
                identity.addEventListener('change', e => {
                    previewUpload({
                        preview: document.querySelector("#piece-preview"),
                        file: identity.files[0]
                    });
                });

                const license = document.querySelector('#licence_scan');
                license.addEventListener('change', e => {
                    previewUpload({
                        preview: document.querySelector("#permis-preview"),
                        file: license.files[0]
                    });
                });

                const technical = document.querySelector('#technical_check_scan');
                technical.addEventListener('change', e => {
                    previewUpload({
                        preview: document.querySelector("#technical-preview"),
                        file: technical.files[0]
                    });
                });

                const insurrance = document.querySelector('#insurrance_scan');
                insurrance.addEventListener('change', e => {
                    previewUpload({
                        preview: document.querySelector("#insurrance-preview"),
                        file: insurrance.files[0]
                    });
                });

                const gray = document.querySelector('#gray_card_scan');
                gray.addEventListener('change', e => {
                    previewUpload({
                        preview: document.querySelector("#gray-card-preview"),
                        file: gray.files[0]
                    });
                });

                const vehicle = document.querySelector('#vehicle_main_image');
                vehicle.addEventListener('change', e => {
                    previewUpload({
                        preview: document.querySelector("#vehicle-preview"),
                        file: vehicle.files[0]
                    });
                });

                if(window.jQuery) {
                    const $ = window.jQuery;

                    $.ajax({
                        type: 'get',
                        url: '{{ route('vehicle_brands') }}'
                    }).done(response => {
                        if(!response.brands) return;
                        const brands = $('#vehicle_brand');
                        brands.on("change", e => {
                            const value = brands.val();

                            $.ajax({
                                type: 'get',
                                url: '{{ route('vehicle_models') }}?brand=' + value
                            }).done(response => {
                                const models = $('#vehicle_model');
                                models.html('<option value="" selected>Modèle du véhicule</option>');

                                if(!response.models) {
                                    console.warn("No Models in response");
                                    console.debug(response);
                                    return;
                                }

                                response.models.forEach(model => {
                                    console.debug("Append new model!");
                                    console.debug(model);

                                    models.append(`<option value="${model.id}">${model.name}</option>`)
                                });
                            }).fail(xhr => alert(`${xhr.status} - ${xhr.statusText}`)).always();
                        });
                        response.brands.forEach(brand => {
                            brands.append(`<option value="${brand.id}">${brand.name}</option>`);
                        });
                    }).fail(xhr => alert(`${xhr.status} - ${xhr.statusText}`)).always();

                }
            });

            const previewUpload = ({ preview, file }) => {
                console.debug({ preview, file });
                const src = URL.createObjectURL(file);
                preview.src = src;
            };
        </script>
    @endpush

@endonce
