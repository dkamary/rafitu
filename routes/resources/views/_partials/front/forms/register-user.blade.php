{{-- Register user --}}

@if ($error = Session::get('error'))
    <div class="alert alert-danger" role="alert">
        {!! $error !!}
    </div>
@endif

<form action="{{ route('user_creation') }}" method="POST" id="Register" class="card-body" tabindex="500">
    <h3>S'enregistrer</h3>
    <div class="name">
        <input type="text" name="firstname" required value="{{ old('firstname') }}">
        <label>Prénom</label>
    </div>
    <div class="name">
        <input type="text" name="lastname" required value="{{ old('lastname') }}">
        <label>Nom</label>
    </div>
    <div class="mail">
        <input type="email" name="email" required value="{{ old('email') }}">
        <label>Adresse email</label>
    </div>
    <div class="passwd">
        <input type="password" name="password" required>
        <label>Mot de passe</label>
    </div>
    <div class="submit">
        <button type="submit" class="btn btn-primary btn-block">S'inscrire</button>
    </div>
    <p class="text-dark mb-0">
        Vous avez déjà un compte ? &nbsp;
        <a href="{{ route('login') }}" class="text-primary ms-1">Se connecter</a>
    </p>
    @csrf
</form>
