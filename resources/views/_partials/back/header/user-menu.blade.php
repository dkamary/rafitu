{{-- User Menu --}}

@php
    $user = Auth::user();
    $driverAvatar = get_avatar($user);
@endphp

<div class="dropdown">
    <a href="#" class="nav-link pe-0 leading-none user-img" data-bs-toggle="dropdown">
        <img src="{{ $driverAvatar }}" alt="profile-img" class="avatar avatar-md brround bg-light">
    </a>
    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow ">
        <a class="dropdown-item" href="{{ route('home') }}">
            <i class="dropdown-icon icon icon-home"></i>&nbsp;
            Site
        </a>
        <a class="dropdown-item" href="{{ route('admin_user_edit', ['user' => $user]) }}">
            <i class="dropdown-icon icon icon-user"></i>&nbsp;
            Mon Profil
        </a>
        <a class="dropdown-item" href="{{ route('dashboard_messenger_index') }}">
            <i class="dropdown-icon icon icon-speech"></i>&nbsp;
            Boîte de réception
        </a>
        <a class="dropdown-item" href="{{ route('admin_parameters_index') }}">
            <i class="dropdown-icon  icon icon-settings"></i>&nbsp;
            Paramètres
        </a>
        <a class="dropdown-item" href="{{ route('logout') }}">
            <i class="dropdown-icon icon icon-power"></i>&nbsp;
            Déconnexion
        </a>
    </div>
</div>

