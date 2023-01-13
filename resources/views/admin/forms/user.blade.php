{{-- User form new --}}

@php
    $formId = 'form-user-new';
    $isNew = !isset($user) || is_null($user) || is_null($user->id);
    $user = isset($user) ? $user : User::createEmptyUser();
    // dd($isNew);
    $savingRoute = route('admin_user_new');
    if(!$isNew) {
        dd($isNew);
        $savingRoute = route('admin_user_edit', ['user' => $user]);
    }
@endphp

<form action="{{ $savingRoute }}" method="post" id="{{ $formId }}">
    <div class="mb-3">
        <label for="firstname" class="form-label">Prénom</label>
        <input type="text" name="firstname" id="firstname" class="form-control" value="{{ $isNew ? old('firstname') : $user->firstname }}" placeholder="Prénom">
    </div>
    <div class="mb-3">
        <label for="lastname" class="form-label">Nom</label>
        <input type="text" name="lastname" id="lastname" class="form-control" value="{{ $isNew ? old('lastname') : $user->lastname }}" placeholder="Nom">
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" id="email" class="form-control" value="{{ $isNew ? old('email') : $user->email }}" placeholder="Adresse e-mail" {{ $isNew ? '' : 'readonly disabled' }}>
    </div>
    @if($isNew)
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" name="password" id="password" class="form-control" value="" placeholder="Votre mot de passe">
        </div>
    @else
        <div class="mb-3">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-dark my-3" data-bs-toggle="modal" data-bs-target="#udpatePassword">
                <i class="fa fa-key" aria-hidden="true"></i>&nbsp;
                Mettre à jour le mot de passe
            </button>
        </div>
    @endif
    <div class="mb-3">
        <label for="user_type_id" class="form-label">Type utilisateur</label>
        <div class="d-flex">
            <label for="user_type_passager">
                <input type="radio" name="user_type_id" id="user_type_passager" value="4" {{ $user->user_type_id == 4 ? 'checked' : '' }}>&nbsp;
                Passager
            </label>
            <label for="user_type_proprietaire" class="ms-3">
                <input type="radio" name="user_type_id" id="user_type_proprietaire" value="3" {{ $user->user_type_id == 3 ? 'checked' : '' }}>&nbsp;
                Propriétaire
            </label>
            <label for="user_type_administrateur" class="ms-3">
                <input type="radio" name="user_type_id" id="user_type_administrateur" value="1" {{ $user->user_type_id == 1 ? 'checked' : '' }}>&nbsp;
                Administrateur
            </label>
        </div>
    </div>
    <div class="mb-3">
        <label for="sexe_id" class="form-label">Genre</label>
        <div class="d-flex">
            <label for="sexe_non">
                <input type="radio" name="sexe_id" id="sexe_non" value="3" {{ $user->sexe_id == 3 ? 'checked' : '' }}>&nbsp;
                Non spécifié
            </label>
            <label for="sexe_femme" class="ms-3">
                <input type="radio" name="sexe_id" id="sexe_femme" value="2" {{ $user->sexe_id == 2 ? 'checked' : '' }}>&nbsp;
                Femme
            </label>
            <label for="sexe_homme" class="ms-3">
                <input type="radio" name="sexe_id" id="sexe_homme" value="1" {{ $user->sexe_id == 1 ? 'checked' : '' }}>&nbsp;
                Homme
            </label>
        </div>
    </div>
    <div class="mb-3">
        <label for="birthdate" class="form-label">Date de naissance</label>
        <input type="date" name="birthdate" id="birthdate" placeholder="jj/mm/aaaa" class="form-control" value="{{ $user->birthdate }}">
    </div>
    <div class="mb-3">
        <label for="tel" class="form-label">Numéro de téléphone fixe</label>
        <input type="tel" name="tel" id="tel" placeholder="Numéro de téléphone" class="form-control" value="{{ $user->tel }}">
    </div>
    <div class="mb-3">
        <label for="mobile" class="form-label">Numéro de portable</label>
        <input type="tel" name="mobile" id="mobile" placeholder="Numéro de portable" class="form-control" value="{{ $user->mobile }}">
    </div>
    <div class="mb-3">
        <label for="address_line1" class="form-label">Adresse</label>
        <input type="text" name="address_line1" id="address_line1" placeholder="Adresse" class="form-control" value="{{ $user->address_line1 }}">
    </div>
    <div class="mb-3">
        <label for="address_line2" class="form-label">Complément d'adresse</label>
        <input type="text" name="address_line2" id="address_line2" placeholder="Complément d'adresse" class="form-control" value="{{ $user->address_line2 }}">
    </div>
    <div class="mb-3">
        <label for="zip_code" class="form-label">Code postal</label>
        <input type="text" name="zip_code" id="zip_code" placeholder="Code postal" class="form-control" value="{{ $user->zip_code }}">
    </div>
    <div class="mb-3">
        <label for="town_id" class="form-label">Ville</label>
        <select name="town_id" id="town_id" class="form-control">
            <option value="">Sélectionner une ville</option>
            @foreach ($towns as $t)
                <option value="{{ $t->id }}" data-country="{{ $t->country_id }}" {{ $user->town_id == $t->id ? 'checked' : '' }}>
                    {{ $t->label }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="country_id" class="form-label">Pays</label>
        <select name="country_id" id="country_id" class="form-control">
            <option value="">Sélectionner un pays</option>
            @foreach ($countries as $c)
                <option value="{{ $c->id }}" {{ $user->country_id == $c->id ? 'checked' : '' }}>{{ $c->name_fr }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="biography" class="form-label">Biographie</label>
        <textarea name="biography" id="biography" class="form-control" rows="3" placeholder="Courte biographie">{{ $user->biography }}</textarea>
    </div>
    <div class="mb-3">
        <label for="avatar" class="form-label">Avatar</label>
        <input type="file" name="avatar" id="avatar">
        <div class="w-100" id="avatar-preview"></div>
    </div>
    <div class="mb-3">
        <div class="col-12 text-end">
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;
                Enregistrer
            </button>
        </div>
    </div>
    @csrf
</form>

@if (!$isNew)

    <!-- Modal -->
    <div class="modal fade" id="udpatePassword" tabindex="-1" aria-labelledby="updatePasswordLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('admin_user_update_password') }}" method="POST" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updatePasswordLabel">Mettre à jour le mot de passe</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="password" name="password" id="password" placeholder="Votre nouveau mot de passe" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Mettre à jour le mot de passe</button>
                </div>
                @csrf
                <input type="hidden" name="id" value="{{ $user->id }}">
            </form>
        </div>
    </div>

@endif
