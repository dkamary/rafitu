{{-- Add Ride - Step 4 --}}

<div class="tab-pane fade" id="fourth">
    <div class="control-group form-group">
        <div class="form-group">
            <label class="form-label text-dark">Prix</label>
            <input type="number" name="price" class="form-control required Title" min="1"
                max="100" placeholder="">
        </div>
    </div>
    <div class="form-group">
        <label class="form-label text-dark">Moyen de paiement</label>
        <select name="payment_method" class="form-control form-select required category select2">
            <option value="0">Sélectionner le moyen de paiement</option>
            <option value="1">Carte Bancaire</option>
            <option value="2">Paypal</option>
            <option value="3">Orange Money</option>
        </select>
    </div>
    <div class="form-group row clearfix">
        <div class="col-lg-12">
            <div class="checkbox checkbox-info">
                <label class="custom-control mt-4 form-checkbox">
                    <input name="consent" type="checkbox" required class="custom-control-input" />
                    <span class="custom-control-label text-dark ps-2">J'accepte les termes et
                        conditions</span>
                </label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="text-end">
            <button type="submit" class="btn btn-primary  mb-0 waves-effect waves-light">Publier votre trajet</button>
        </div>
    </div>
</div>
