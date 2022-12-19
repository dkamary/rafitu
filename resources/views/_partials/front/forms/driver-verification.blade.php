{{-- formulaire de vérification --}}

<form action="{{ route('driver_verification') }}" method="POST" class="form" enctype="multipart/form-data">

    <div class="row mb-3">
        <div class="col">
            <div class="form-floating">
                <select class="form-select" id="identification_type_id" name="identification_type_id" required
                    aria-label="Type pièce d'identité">
                    <option selected>Sélectionner un type</option>
                    <option value="1">Carte d'identité</option>
                    <option value="2">Passeport</option>
                </select>
                <label for="identification_type_id">Type pièce</label>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col">
            <div class="form-floating">
                <input type="text" class="form-control" id="identification_number" name="identification_number" placeholder="" required>
                <label for="identification_number">Numéro d'identification</label>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col">
            <div class="form-floating">
                <input type="date" class="form-control" id="identification_date" name="identification_date" placeholder="" required>
                <label for="identification_date">Date d'obtention</label>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col">
            <div class="form-floating">
                <input type="file" class="form-control" id="identification_scan" name="identification_scan" placeholder="" required>
                <label for="identification_scan">Scan de la pièce d'identification</label>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col">
            <div class="form-floating">
                <input type="text" class="form-control" id="licence_number" name="licence_number" placeholder="" required>
                <label for="licence_number">Numéro du permis de conduire</label>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col">
            <div class="form-floating">
                <input type="file" class="form-control" id="licence_scan" name="licence_scan" placeholder="" required>
                <label for="licence_scan">Scan du permis de conduire</label>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col">
            <div class="form-floating">
                <input type="file" class="form-control" id="technical_check_scan" name="technical_check_scan" placeholder="" required>
                <label for="technical_check_scan">Scan du certificat de visite technique en cours</label>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col">
            <div class="form-floating">
                <input type="file" class="form-control" id="insurrance_scan" name="insurrance_scan" placeholder="" required>
                <label for="insurrance_scan">Scan de l'assurance en cours</label>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col">
            <div class="form-floating">
                <input type="file" class="form-control" id="gray_card_scan" name="gray_card_scan" placeholder="" required>
                <label for="gray_card_scan">Scan de la carte grise</label>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col text-end">
            <button type="submit" class="btn btn-success">
                <i class="fa fa-check" aria-hidden="true"></i>&nbsp;
                Soumettre à validation
            </button>
        </div>
    </div>

    @csrf

</form>
