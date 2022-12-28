{{-- Cinetpay parameters --}}

<form action="{{ route('transaction_mode_de_paiements_cinetpay') }}" class="form" method="post">

    <div class="row my-3">
        <label for="" class="col-12 col-sm-3 col-md-2">Mode</label>
        <div class="col-12 col-md-5">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="cinetpay_mode" id="cinetpay_mode-sandbox"
                {{ $parameter->cinetpay_mode == 'SANDBOX' ? 'checked' : '' }} value="SANDBOX">
                <label class="form-check-label" for="cinetpay_mode-sandbox">Bac à sable</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="cinetpay_mode" id="cinetpay_mode-production"
                    {{ $parameter->cinetpay_mode == 'PRODUCTION' ? 'checked' : '' }} value="PRODUCTION">
                <label class="form-check-label" for="cinetpay_mode-production">Production</label>
            </div>
        </div>
    </div>

    <div class="row my-3">
        <label for="" class="col-12 col-sm-3 col-md-2">Clé API</label>
        <div class="col-12 col-md-5">
            <input type="text" name="cinetpay_api" id="cinetpay_api" value="{{ $parameter->cinetpay_api }}" class="form-control" required>
        </div>
    </div>


    <div class="row my-3">
        <label for="" class="col-12 col-sm-3 col-md-2">Site ID</label>
        <div class="col-12 col-md-5">
            <input type="text" name="cinetpay_site_id" id="cinetpay_site_id" value="{{ $parameter->cinetpay_site_id }}" class="form-control" required>
        </div>
    </div>

    <div class="row my-3">
        <label for="" class="col-12 col-sm-3 col-md-2">Clé Secrète</label>
        <div class="col-12 col-md-5">
            <input type="text" name="cinetpay_secret" id="cinetpay_secret" value="{{ $parameter->cinetpay_secret }}" class="form-control" required>
        </div>
    </div>

    <div class="row my-3">
        <label for="" class="col-12 col-sm-3 col-md-2">Monnaie</label>
        <div class="col-12 col-md-5">
            <select name="cinetpay_currency" id="cinetpay_currency" class="form-select" required>
                <option value="">Sélectionner une monnaie</option>
                <option value="XOF" {{ $parameter->cinetpay_currency == 'XOF' ? 'selected' : '' }}>Franc CFA (F CFA)</option>
                <option value="EUR" {{ $parameter->cinetpay_currency == 'EUR' ? 'selected' : '' }}>Euro (€)</option>
                <option value="USD" {{ $parameter->cinetpay_currency == 'USD' ? 'selected' : '' }}>Dollar ($)</option>
            </select>
        </div>
    </div>

    <div class="row my-3">
        <label for="" class="col-12 col-sm-3 col-md-2">Langue</label>
        <div class="col-12 col-md-5">
            <select name="cinetpay_lang" id="cinetpay_lang" class="form-select" required>
                <option value="">Sélectionner une langue</option>
                <option value="fr" {{ $parameter->cinetpay_lang == 'fr' ? 'selected' : '' }}>Français</option>
                <option value="en" {{ $parameter->cinetpay_lang == 'en' ? 'selected' : '' }}>Anglais</option>
            </select>
        </div>
    </div>

    <div class="row my-3">
        <div class="col-12 d-flex justify-content-center align-items-center">
            <button type="submit" class="btn btn-secondary d-flex align-item-centers justify-content-center">
                <i class="fa fa-floppy-o fa-2x" aria-hidden="true"></i>&nbsp;
                Enregistrer
            </button>
        </div>
    </div>

    @csrf

</form>
