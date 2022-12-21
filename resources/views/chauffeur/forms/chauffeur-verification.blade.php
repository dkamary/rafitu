{{-- Formulaire de vérification chauffeur --}}

<form action="{{ route('driver_verification') }}" method="post" enctype="multipart/form-data" class="driver-form-verification">
    <div class="row my-8">
        <div class="col-12 mb-3">
            <h3 class="fs-4 fw-bold pb-1 border-bottom">Pièce d'identité</h3>
        </div>
        <div class="col-12 col-md-5">
            <img src="{{ asset('images/identity-card.png') }}" alt="" id="piece-preview" class="img-fluid">
            <div class="row">
                <div class="col-12 text-center">
                    <button class="btn btn-outline-primary" onclick="document.querySelector('#identification_scan').click();">
                        <i class="fa fa-upload" aria-hidden="true"></i>&nbsp;
                        Sélectionner fichier
                    </button>
                    <input type="file" name="identification_scan" id="identification_scan" class="form-control d-none" required>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-7 d-flex flex-column align-content-center justify-content-center">
            <div class="row">
                <div class="col-12">
                    <h4 class="fs-5 fw-bold">Type</h4>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-12">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="identification_type_id" id="identification_type_1" value="1" checked>
                        <label class="form-check-label" for="identification_type_1">
                            Carte d'identité
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="identification_type_id" id="identification_type_2" value="1">
                        <label class="form-check-label" for="identification_type_2">
                            Passeport
                        </label>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-12">
                    <h4 class="fs-5 fw-bold">Numéro de la pièce</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <input type="text" name="identification_number" id="identification_number" class="form-control" required>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-12">
                    <h4 class="fs-5 fw-bold">Date d'obtention</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <input type="date" name="identification_date" id="identification_date" class="form-control" required>
                </div>
            </div>
        </div>
    </div>

    <div class="row my-8">
        <div class="col-12 mb-3">
            <h3 class="fs-4 fw-bold pb-1 border-bottom">Permis de conduire</h3>
        </div>
        <div class="col-12 col-md-5">
            <img src="{{ asset('images/driver-license.png') }}" alt="" id="permis-preview" class="img-fluid">
            <div class="row">
                <div class="col-12 text-center">
                    <button class="btn btn-outline-primary" onclick="document.querySelector('#licence_scan').click();">
                        <i class="fa fa-upload" aria-hidden="true"></i>&nbsp;
                        Sélectionner fichier
                    </button>
                    <input type="file" name="licence_scan" id="licence_scan" class="form-control d-none">
                </div>
            </div>
        </div>
        <div class="col-12 col-md-7 d-flex flex-column align-content-center justify-content-center">
            <div class="row mb-4">
                <div class="col-12">
                    <h4 class="fs-5 fw-bold">Numéro du permis de conduire</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <input type="text" name="licence_number" id="licence_number" class="form-control" required>
                </div>
            </div>
        </div>
    </div>

    <div class="row my-8">

        <div class="col-12 col-md-4">
            <h3 class="fs-4 fw-bold pb-1 border-bottom text-center">Scan du certificat de <br>visite technique en cours</h3>
            <img src="{{ asset('images/checklist.png') }}" alt="" id="technical-preview" class="img-fluid">
            <div class="row">
                <div class="col-12 text-center">
                    <button class="btn btn-outline-primary" onclick="document.querySelector('#technical_check_scan').click();">
                        <i class="fa fa-upload" aria-hidden="true"></i>&nbsp;
                        Sélectionner fichier
                    </button>
                    <input type="file" name="technical_check_scan" id="technical_check_scan" class="form-control d-none" required>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <h3 class="fs-4 fw-bold pb-1 border-bottom text-center">Scan<br> de l'assurance en cours</h3>
            <img src="{{ asset('images/insurance.png') }}" alt="" id="insurrance-preview" class="img-fluid">
            <div class="row">
                <div class="col-12 text-center">
                    <button class="btn btn-outline-primary" onclick="document.querySelector('#insurrance_scan').click();">
                        <i class="fa fa-upload" aria-hidden="true"></i>&nbsp;
                        Sélectionner fichier
                    </button>
                    <input type="file" name="insurrance_scan" id="insurrance_scan" class="form-control d-none" required>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <h3 class="fs-4 fw-bold pb-1 border-bottom text-center">Scan<br> de la carte grise </h3>
            <img src="{{ asset('images/parking.png') }}" alt="" id="gray-card-preview" class="img-fluid">
            <div class="row">
                <div class="col-12">
                    <button class="btn btn-outline-primary" onclick="document.querySelector('#gray_card_scan').click();">
                        <i class="fa fa-upload" aria-hidden="true"></i>&nbsp;
                        Sélectionner fichier
                    </button>
                    <input type="file" name="gray_card_scan" id="gray_card_scan" class="form-control d-none" required>
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
            });

            const previewUpload = ({ preview, file }) => {
                console.debug({ preview, file });
                const src = URL.createObjectURL(file);
                preview.src = src;
            };
        </script>
    @endpush

@endonce
