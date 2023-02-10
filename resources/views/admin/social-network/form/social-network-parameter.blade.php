{{-- Social network parameter form --}}

<form action="{{ route('admin_social_network_parameter_save') }}" method="post" class="pt-3">

    <div class="row mb-3">
        <label for="facebook" class="col-12 col-md-3 col-lg-2">Facebook</label>
        <div class="col-12 col-md-6 col-lg-4">
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="facebook" id="facebook" value="{{ $parameter->facebook }}" aria-describedby="facebook-label">
                <span class="input-group-text" id="facebook-label">
                    <i class="fa fa-facebook-official" aria-hidden="true"></i>
                </span>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <label for="instagram" class="col-12 col-md-3 col-lg-2">Instagram</label>
        <div class="col-12 col-md-6 col-lg-4">
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="instagram" id="instagram" value="{{ $parameter->instagram }}" aria-describedby="facebook-label">
                <span class="input-group-text" id="instagram-label">
                    <i class="fa fa-instagram" aria-hidden="true"></i>
                </span>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <label for="twitter" class="col-12 col-md-3 col-lg-2">Twitter</label>
        <div class="col-12 col-md-6 col-lg-4">
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="twitter" id="twitter" value="{{ $parameter->twitter }}" aria-describedby="twitter-label">
                <span class="input-group-text" id="twitter-label">
                    <i class="fa fa-twitter" aria-hidden="true"></i>
                </span>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <label for="linkedin" class="col-12 col-md-3 col-lg-2">Linkedin</label>
        <div class="col-12 col-md-6 col-lg-4">
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="linkedin" id="linkedin" value="{{ $parameter->linkedin }}" aria-describedby="linkedin-label">
                <span class="input-group-text" id="linkedin-label">
                    <i class="fa fa-linkedin" aria-hidden="true"></i>
                </span>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-12 col-md-6 col-lg-4 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;
                Enregistrer
            </button>
        </div>
    </div>

    <input type="hidden" name="id" value="{{ $parameter->id }}">
    @csrf
</form>
