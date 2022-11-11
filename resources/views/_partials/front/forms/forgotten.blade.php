{{-- Forgot form --}}

<form action="{{ route('password_forgot') }}" method="POST" id="login" class="card-body" tabindex="500">
    <h3>Récupérer son mot de passe</h3>
    <div class="mail">
        <input type="email" name="email" value="{{ old('email') }}" required>
        <label>Identifiant ou E-mail</label>
    </div>
    <div class="submit">
        <button type="submit" class="btn btn-primary btn-block">Soumettre</button>
    </div>
    @csrf
</form>
