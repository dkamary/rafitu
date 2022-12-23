{{-- Réservations --}}

@php
    $driver = Auth::user();
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

<div class="card pt-4">

    <a href="{{ route('dashboard_user') }}" class="d-flex">
        <img src="{{ $driverAvatar }}" class="card-img-top w-90 mx-auto" alt="...">
    </a>

    <div class="card-body mt-4 text-white bg-azure-darker">
        <p class="card-text">
            Completez votre profil
        </p>
    </div>
</div>
