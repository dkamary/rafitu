{{-- Cinetpay parameters --}}

<form action="{{ route('transaction_mode_de_paiements_paypal') }}" class="form" method="post">

    <div class="row my-3">
        <label for="" class="col-12 col-sm-3 col-md-2">Mode</label>
        <div class="col-12 col-md-5">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="paypal_mode" id="paypal_mode-sandbox"
                {{ $parameter->paypal_mode == 'sandbox' ? 'checked' : '' }} value="sandbox">
                <label class="form-check-label" for="paypal_mode">Bac à sable</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="paypal_mode" id="paypal_mode-production"
                {{ $parameter->paypal_mode == 'production' ? 'checked' : '' }} value="production">
                <label class="form-check-label" for="paypal_mode">Production</label>
            </div>
        </div>
    </div>

    <div class="row my-3">
        <label for="" class="col-12 col-sm-3 col-md-2">Compte</label>
        <div class="col-12 col-md-5">
            <input type="text" name="paypal_account" id="paypal_account" value="{{ $parameter->paypal_account }}" class="form-control" required>
        </div>
    </div>


    <div class="row my-3">
        <label for="" class="col-12 col-sm-3 col-md-2">Client ID</label>
        <div class="col-12 col-md-5">
            <input type="text" name="paypal_client_id" id="paypal_client_id" value="{{ $parameter->paypal_client_id }}" class="form-control" required>
        </div>
    </div>

    <div class="row my-3">
        <label for="" class="col-12 col-sm-3 col-md-2">Clé Secrète</label>
        <div class="col-12 col-md-5">
            <input type="text" name="paypal_secret" id="paypal_secret" value="{{ $parameter->paypal_secret }}" class="form-control" required>
        </div>
    </div>

    <div class="row my-3">
        <label for="" class="col-12 col-sm-3 col-md-2">BN Code</label>
        <div class="col-12 col-md-5">
            <input type="text" name="paypal_bn_code" id="paypal_bn_code" value="{{ $parameter->paypal_bn_code }}" class="form-control" >
        </div>
    </div>

    <div class="row my-3">
        <label for="" class="col-12 col-sm-3 col-md-2">Plateform Partner App ID</label>
        <div class="col-12 col-md-5">
            <input type="text" name="paypal_plateform_partner_app" id="paypal_plateform_partner_app" value="{{ $parameter->paypal_plateform_partner_app }}" class="form-control" >
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
