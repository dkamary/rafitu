{{-- User Menu --}}

@php
    $user = isset($user) && !is_null($user) ? $user : Auth::user();
    $userAvatar = !is_null($user->avatar) ? $user->avatar : asset('assets/images/default/user.svg');
@endphp

<div class="dropdown">
    <a href="#" class="nav-link pe-0 leading-none user-img" data-bs-toggle="dropdown">
        <img src="{{ $userAvatar }}" alt="profile-img" class="avatar avatar-md brround">
    </a>
    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow ">
        <a class="dropdown-item" href="#">
            <i class="dropdown-icon icon icon-user"></i> Mon Profil
        </a>
        <a class="dropdown-item" href="#">
            <i class="dropdown-icon icon icon-speech"></i> Boîte de réception
        </a>
        <a class="dropdown-item" href="#">
            <i class="dropdown-icon  icon icon-settings"></i> Paramètres
        </a>
        <a class="dropdown-item" href="{{ route('logout') }}">
            <i class="dropdown-icon icon icon-power"></i> Déconnexion
        </a>
    </div>
</div>
