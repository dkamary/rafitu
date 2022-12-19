{{-- User form --}}

@php
    $avatar = $user->avatar ? asset('avatars/'. $user->getAvatar('small')) : asset('assets/images/faces/male/1.jpg');
@endphp

<form method="POST" enctype="multipart/form-data" action="{{ route('dashboard_user') }}" class="form user-form">
    <div class="row my-3">
        <label for="email" class="col-12 col-md-4">Adresse e-mail</label>
        <div class="col-12 col-md-8 required">
            <input type="email" name="email" id="email" class="form-control disabled" required placeholder="" value="{{ $user->email }}" readonly>
        </div>
    </div>
    <div class="row my-3">
        <label for="firstname" class="col-12 col-md-4">Prénom</label>
        <div class="col-12 col-md-8 required">
            <input type="text" name="firstname" id="firstname" class="form-control" required value="{{ $user->firstname }}" placeholder="Votre prénom">
        </div>
    </div>
    <div class="row my-3">
        <label for="lastname" class="col-12 col-md-4">Nom</label>
        <div class="col-12 col-md-8 required">
            <input type="text" name="lastname" id="lastname" class="form-control" required value="{{ $user->lastname }}"
                placeholder="Votre nom de famille">
        </div>
    </div>
    <div class="row my-3">
        <label for="password" class="col-12 col-md-4">Mot de passe</label>
        <div class="col-12 col-md-8">
            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#update-password">
                <i class="fa fa-key" aria-hidden="true"></i> &nbsp;
                Mettre à jour le mot de passe
            </button>
        </div>
    </div>
    <div class="row my-3">
        <label for="birthdate" class="col-12 col-md-4">Date de naissance</label>
        <div class="col-12 col-md-8">
            <input type="date" name="birthdate" id="birthdate" class="form-control" value="{{ $user->getBirthdate() }}" placeholder="dd/mm/aaaa">
        </div>
    </div>
    <div class="row my-3">
        <label for="tel" class="col-12 col-md-4">Téléphone Fixe</label>
        <div class="col-12 col-md-8">
            <input type="tel" name="tel" id="tel" class="form-control" value="{{ $user->tel }}" placeholder="Votre numéro de téléphone fixe" required>
        </div>
    </div>
    <div class="row my-3">
        <label for="mobile" class="col-12 col-md-4">Téléphone Mobile</label>
        <div class="col-12 col-md-8 required">
            <input type="text" name="mobile" id="mobile" class="form-control" value="{{ $user->mobile }}" required placeholder="Votre numéro de téléphone portable">
        </div>
    </div>
    <div class="row my-3">
        <label for="address_line1" class="col-12 col-md-4">Adresse</label>
        <div class="col-12 col-md-8 required">
            <input type="text" name="address_line1" id="address_line1" class="form-control" value="{{ $user->address_line1 }}" required placeholder="Votre adresse">
        </div>
    </div>
    <div class="row my-3">
        <label for="address_line2" class="col-12 col-md-4">Complément d'adresse</label>
        <div class="col-12 col-md-8">
            <input type="text" name="address_line2" id="address_line2" class="form-control" value="{{ $user->address_line2 }}" placeholder="Complément d'adresse">
        </div>
    </div>
    <div class="row my-3">
        <label for="zip_code" class="col-12 col-md-4">Code Postal</label>
        <div class="col-12 col-md-8 required">
            <input type="text" name="zip_code" id="zip_code" class="form-control" value="{{ $user->zip_code }}" required placeholder="Code Postal">
        </div>
    </div>
    {{-- <div class="row my-3">
        <label for="town_id" class="col-12 col-md-4">Ville</label>
        <div class="col-12 col-md-8">
            <input type="text" name="town_id" id="town_id" class="form-control" value="{{ $user->town_id }}">
        </div>
    </div>
    <div class="row my-3">
        <label for="country_id" class="col-12 col-md-4">Pays</label>
        <div class="col-12 col-md-8">
            <input type="text" name="country_id" id="country_id" class="form-control" value="{{ $user->country_id }}">
        </div>
    </div> --}}
    <div class="row my-3">
        <label for="biography" class="col-12 col-md-4">Bio</label>
        <div class="col-12 col-md-8">
            <textarea name="biography" id="biography" class="form-control" rows="5">{{ $user->biography }}</textarea>
        </div>
    </div>
    <div class="row my-3">
        <label for="avatar" class="col-12 col-md-4">Avatar</label>
        <div class="col-12 col-md-8">
            <img id="img-preview" src="{{ asset($avatar) }}" alt="{{ $user->firstname.'-'.$user->lastname }}" class="mb-4" style="width: auto; height: 10rem; cursor: pointer;">
            <input type="file" name="avatar" id="avatar" class="form-control">
        </div>
    </div>
    <div class="row my-3">
        <div class="col-12 text-end">
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;
                Enregister les modifications
            </button>
        </div>
    </div>
    @csrf
</form>

<div class="modal fade" id="update-password" tabindex="-1" aria-labelledby="update-passwordLabel" aria-hidden="true">
    <form class="modal-dialog form password-form" action="{{ route('dashboard_update_password') }}" method="post">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="update-passwordLabel">Mise à jour du mot de passe</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                    <div class="row">
                        <label for="password" class="col-12">Nouveau mot de passe</label>
                        <div class="col-12">
                            <input type="password" name="password" id="password" class="form-control"
                                required placeholder="Mot de passe">
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fa fa-times" aria-hidden="true"></i>&nbsp;
                    Annuler
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-key" aria-hidden="true"></i> &nbsp;
                    Mettre à jour le mot de passe
                </button>
            </div>
        </div>
        @csrf
        <input type="hidden" name="id" value="{{ $user->id }}">
    </form>
</div>

@once
    @push('footer')
        <script id="form-user-edit">
            window.addEventListener("DOMContentLoaded", event => {
                const imgPreview = document.querySelector("#img-preview");
                if(!imgPreview) {
                    imgPreview.addEventListener("click", e => {
                        e.preventDefault();
                        const avatar = document.querySelector("#avatar");

                        if(avatart) avatar.click();
                    });
                } else {
                    console.warn("No IMG preview!");
                }

                const avatar = document.querySelector('#avatar');
                if(avatar) {
                    avatar.addEventListener('change', e => {
                        if(e.target.files.length > 0){
                            var src = URL.createObjectURL(e.target.files[0]);
                            imgPreview.src = src;
                            imgPreview.style.display = "block";
                        }
                    });
                } else {
                    console.warn("No avatar!!!");
                }
            });
        </script>
    @endpush
@endonce
