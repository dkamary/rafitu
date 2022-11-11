{{-- Reset form --}}

<form action="{{ route('password_reset', ['email' => $user ? $user->email : $email, 'token' => $user ? $user->token : $token,]) }}" method="POST" id="login" class="card-body" tabindex="500">
    <h3>Récupérer son mot de passe</h3>
    <div class="password">
        <input type="password" name="password" value="" required>
        <label>Nouveau mot de passe</label>
    </div>
    <div class="submit">
        <button type="submit" class="btn btn-primary btn-block">Enregistrer</button>
    </div>
    @csrf
    <input type="hidden" name="action" value="reset">
</form>
