{{-- Login form --}}

@php
    $showLoginTitle = $showLoginTitle ?? true;
@endphp

<form action="{{ route('auth_normal') }}" method="POST" id="login" class="card-body login-form" tabindex="500">
    @if($showLoginTitle)
        <h3>{{ $loginTitle ?? 'Se connecter' }}</h3>
    @endif
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

    <p class="my-3 text-center" id="login-notification"></p>

    <p class="mb-2"><a href="{{ route('password_forgot') }}" >Mot de passe oublié</a></p>
    <p class="text-dark mb-0">Vous n'avez pas un compte ? <a href="{{ route('register') }}" class="text-primary ms-1">S'enregistrer</a></p>
    @csrf
</form>

@if(isset($ajaxLogin) && $ajaxLogin == true)

    @once

        @push('footer')
            <script>

                window.addEventListener("DOMContentLoaded", event => {
                    const loginForm = document.querySelector('#login');
                    loginForm.addEventListener("submit", e => {
                        e.preventDefault();
                        const data = new FormData(loginForm);

                        fetch("{{ route('auth_normal') }}", {
                            method: "POST",
                            mode: "same-origin",
                            credentials: "same-origin",
                            body: data,
                            headers: {
                                'X-login-source': 'ajax',
                            }
                        })
                        .then(response => response.json())
                        .then(jsonResponse => {
                            if(jsonResponse.authentified) {
                                const notification  = document.querySelector('#login-notification');
                                const message = document.createElement('span');
                                message.classList.add('text-succcess', 'fs-6', 'fw-bold');
                                message.innerHTML = "Information de connexion correct. <br>La page va se rafraichir!";
                                notification.innerHTML = "";
                                notification.appendChild(message);

                                window.location.reload();
                            } else {
                                const notification  = document.querySelector('#login-notification');
                                const message = document.createElement('span');
                                message.classList.add('text-danger', 'fs-6', 'fw-bold');
                                message.innerHTML = "Le mot de passe ou l'adresse email est incorrect!";
                                notification.innerHTML = "";
                                notification.appendChild(message);

                            }
                        });
                    });
                });

            </script>
        @endpush

    @endonce

@endif
