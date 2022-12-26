{{-- User Menu --}}

@php
    $driver = isset($user) && !is_null($user) ? $user : Auth::user();
    $avatar = $driver->getAvatar();
    $driverAvatar = $avatar;
    if($avatar) {
        if(strpos($avatar, 'http') !== false) {
            $driverAvatar = $avatar;
        } else {
            $driverAvatar = asset('avatars/' . $avatar);
        }
    } else {
        $driverAvatar = asset('avatars/user-01.svg');
    }
@endphp

<div class="dropdown">
    <a href="#" class="nav-link pe-0 leading-none user-img" data-bs-toggle="dropdown">
        <img src="{{ $driverAvatar }}" alt="profile-img" class="avatar avatar-md brround bg-light">
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
