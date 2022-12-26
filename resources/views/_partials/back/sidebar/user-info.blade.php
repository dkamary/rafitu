{{-- User Info --}}


@php
    $driver = isset($user) && !is_null($user) ? $user : Auth::user();
    $user = $driver;
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

<div class="app-sidebar__user clearfix">
    <div class="dropdown user-pro-body">
        <div>
            <img src="{{ $driverAvatar }}" alt="user-img" class="avatar avatar-lg brround">
            <a href="{{ route('dashboard_user') }}" class="profile-img bg-light">
                <span class="fa fa-pencil" aria-hidden="true"></span>
            </a>
        </div>
        <div class="user-info">
            <h2>{{ $user->firstname .' ' . $user->lastname }}</h2>
            {{-- <span>Web Designer</span> --}}
        </div>
    </div>
</div>
