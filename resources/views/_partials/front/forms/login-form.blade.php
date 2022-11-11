{{-- Login form --}}

<form action="{{ route('auth_normal') }}" method="POST" id="login" class="card-body" tabindex="500">
    <h3>Se connecter</h3>
    <div class="mail">
        <input type="email" name="email" value="{{ old('email') }}" required>
        <label>Identifiant ou E-mail</label>
    </div>
    <div class="passwd">
        <input type="password" name="password" required>
        <label>Mot de passe</label>
    </div>
    <div class="submit">
        <button type="submit" class="btn btn-primary btn-block">Se connecter</button>
    </div>
    <p class="mb-2"><a href="{{ route('password_forgot') }}" >Mot de passe oublié</a></p>
    <p class="text-dark mb-0">Vous n'avez pas un compte ? <a href="{{ route('register') }}" class="text-primary ms-1">S'enregistrer</a></p>
    @csrf
</form>
