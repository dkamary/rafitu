{{-- User form for Admin --}}

@php
    $isNew = is_null($user->id);
    $action = $isNew ? route('admin_user_new') : route('admin_user_edit', ['user' => $user]);
@endphp

<form action="{{ $action }}" method="post" enctype="multipart/form-data" class="user-admin-form">
    <div class="row my-3">
        <div class="col-12 col-md-6">
            <div class="row mb-3">
                <label for="firstname" class="col-12 col-sm-4 fw-bold">Prénom</label>
                <div class="col-12 col-sm-8 required">
                    <input type="text" class="form-control" id="firstname" name="firstname"
                    value="{{ $isNew ? old('firstname') : $user->firstname }}"
                    placeholder="Saisir le prénom"
                    title="Le Prénom ne doit pas commencer par un chiffre mais de caractères alphabétique"
                    pattern="^[^0-9]+[a-zA-Z]+"
                    required
                    >
                </div>
            </div>
            <div class="row mb-3">
                <label for="lastname" class="col-12 col-sm-4 fw-bold">Nom</label>
                <div class="col-12 col-sm-8 required">
                    <input type="text" class="form-control" id="lastname" name="lastname"
                    value="{{ $isNew ? old('lastname') : $user->lastname }}"
                    placeholder="Saisir le nom"
                    title="Le Nom ne doit pas commencer par un chiffre mais de caractères alphabétique"
                    pattern="^[^0-9]+[a-zA-Z]+"
                    required
                    >
                </div>
            </div>
            <div class="row mb-3">
                <label for="email" class="col-12 col-sm-4 fw-bold">Email</label>
                <div class="col-12 col-sm-8 required">
                    <input type="email" class="form-control" id="email" name="email"
                    value="{{ $isNew ? old('email') : $user->email }}"
                    {{ $isNew ? '' : 'readonly disabled' }}
                    placeholder="Saisir l'adresse email"
                    title="Veuillez une adresse email correct"
                    pattern="^[^\s@]+@[^\s@]+\.[^\s@]+$"
                    required
                    autocomplete="false"
                    >
                </div>
            </div>
            <div class="row mb-3">
                <label for="password" class="col-12 col-sm-4 fw-bold">Mot de passe</label>
                <div class="col-12 col-sm-8 {{ $isNew ? 'required' : '' }}">
                    @if($isNew)

                    <input type="password" class="form-control" name="password" placeholder="Saisir le mot de passe" required autocomplete="false">

                    @else

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-dark my-3" data-bs-toggle="modal" data-bs-target="#udpatePassword">
                        <i class="fa fa-key" aria-hidden="true"></i>&nbsp;
                        Mettre à jour le mot de passe
                    </button>

                    @endif
                </div>
            </div>
            <div class="row mb-3">
                <label for="user_type_id" class="col-12 fw-bold">Type utilisateur</label>
                <div class="col-12">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio"
                        id="user_type_passager"
                        name="user_type_id"
                        value="4" {{ $user->user_type_id == 4 || $isNew ? 'checked' : '' }}
                        >
                        <label class="form-check-label" for="user_type_passager">Passager</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio"
                        id="user_type_chauffeur"
                        name="user_type_id"
                        value="2" {{ $user->user_type_id == 2 ? 'checked' : '' }}
                        >
                        <label class="form-check-label" for="user_type_chauffeur">Chauffeur</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio"
                        id="user_type_admin"
                        name="user_type_id"
                        value="1" {{ $user->user_type_id == 1 ? 'checked' : '' }}
                        >
                        <label class="form-check-label" for="user_type_admin">Administrateur</label>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="sexe_id" class="col-12 fw-bold">Genre</label>
                <div class="col-12">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio"
                        id="user_type_unknow" name="sexe_id"
                        value="3"
                        {{ $user->sexe_id == 3 || $isNew ? 'checked' : '' }}
                        >
                        <label class="form-check-label" for="user_type_unknow">Non spécifié</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio"
                        id="user_type_femme" name="sexe_id"
                        value="2"
                        {{ $user->sexe_id == 2 ? 'checked' : '' }}
                        >
                        <label class="form-check-label" for="user_type_femme">Femme</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio"
                        id="user_type_homme"
                        name="sexe_id"
                        value="1"
                        {{ $user->sexe_id == 1 ? 'checked' : '' }}
                        >
                        <label class="form-check-label" for="user_type_homme">Homme</label>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="birthdate" class="col-12 col-sm-4 fw-bold">Date de naissance</label>
                <div class="col-12 col-sm-8">
                    <input type="date" name="birthdate" id="birthdate" placeholder="jj/mm/aaaa" class="form-control" value="{{ $user->birthdate }}">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12 col-sm-6">
                    <div class="row">
                        <label for="tel" class="col-12 col-sm-4 fw-bold">Téléphone fixe</label>
                        <div class="col-12 col-sm-8">
                            <input type="tel"
                            name="tel"
                            id="tel"
                            placeholder="Numéro de téléphone"
                            class="form-control"
                            value="{{ $user->tel }}"
                            pattern="^\+?\d{1,3}[- ]?\d{3,4}[- ]?\d{4}$"
                            title="Numéro de téléphone valide"
                            >
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="row">
                        <label for="mobile" class="col-12 col-sm-4 fw-bold">Portable</label>
                        <div class="col-12 col-sm-8 required">
                            <input type="tel"
                            name="mobile"
                            id="mobile"
                            placeholder="Numéro de portable"
                            class="form-control"
                            value="{{ $user->mobile }}"
                            pattern="^\+?\d{1,3}[- ]?\d{3,4}[- ]?\d{4}$"
                            title="Numéro de téléphone valide"
                            required
                            >
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3 align-items-end">
                <label for="address_line1" class="col-12 col-sm-4 fw-bold">Adresse</label>
                <div class="col-12 col-sm-8">
                    <input type="text" name="address_line1" id="address_line1" placeholder="Adresse" class="form-control" value="{{ $user->address_line1 }}">
                </div>
            </div>
            <div class="row mb-3">
                <label for="address_line2" class="col-12 col-sm-4 fw-bold">Complément d'adresse</label>
                <div class="col-12 col-sm-8">
                    <input type="text" name="address_line2" id="address_line2" placeholder="Complément d'adresse" class="form-control" value="{{ $user->address_line2 }}">
                </div>
            </div>
            <div class="row mb-3">
                <label for="zip_code" class="col-12 col-sm-4 fw-bold">Code postal</label>
                <div class="col-12 col-sm-8">
                    <input type="text" name="zip_code" id="zip_code" placeholder="Code postal" class="form-control" value="{{ $user->zip_code }}">
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="row mb-3">
                <div class="col-12 d-flex justify-content-center align-items-center flex-column">
                    <img id="img-preview"
                    src="{{ get_avatar($user) }}"
                    alt="{{ $user->firstname.'-'.$user->lastname }}"
                    class="mb-4"
                    style="width: auto; height: 10rem; cursor: pointer;"
                    onclick="document.querySelector('#avatar').click();"
                    >
                    <button type="button" class="btn btn-outline-info my-2" id="change-avatar" onclick="document.querySelector('#avatar').click();">
                        <i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;
                        Changer l'avatar
                    </button>
                    <input type="file" name="avatar" id="avatar" class="form-control w-50 d-none">
                </div>
            </div>
            <div class="row mb-3">
                <label for="biography" class="col-12 fw-bold">Bio</label>
                <div class="col-12 col-md-8">
                    <textarea name="biography" id="biography" class="form-control" rows="5">{{ $user->biography }}</textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="row my-3">
        <div class="col-12 text-center">
            <p class="mb-3 fs-6">
                <em>Les zones de saisie marquées par l'icone <img src="{{ asset('images/medical.png') }}" style="height: 1em; width: auto;" /> sont <strong>obligatoires</strong></em>
            </p>
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-floppy-o fa-2x me-2" aria-hidden="true"></i>&nbsp;
                @if($isNew)
                    Créer le nouvel utilisateur
                @else
                    Enregistrer les modifications
                @endif
            </button>
        </div>
    </div>
    @csrf
    @if (!$isNew)
        <input type="hidden" name="id" value="{{ $user->id }}">
    @endif
</form>

<div class="modal fade" id="udpatePassword" tabindex="-1" aria-labelledby="update-passwordLabel" aria-hidden="true">
    <form class="modal-dialog form password-form" action="{{ route('admin_user_update_password') }}" method="post">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="update-passwordLabel">Mise à jour du mot de passe</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                    <div class="row">
                        <label for="password" class="col-12 fs-5">Nouveau mot de passe</label>
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
@push('head')
    <style>
        .user-admin-form .required {
            position: relative;
        }

        .user-admin-form .required::after {
            content: "";
            position: absolute;
            width: .8rem;
            height: .8rem;
            background-image: url({{ asset('images/medical.png') }});
            background-size: cover;
            right: 1.5rem;
            top: 50%;
            transform: translateY(-50%);
        }
    </style>
@endpush
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
