{{-- User Info --}}


@php
    $user = Auth::user();
    $avatar = get_avatar($user);
@endphp

<div class="app-sidebar__user clearfix">
    <div class="dropdown user-pro-body">
        <div>
            <img src="{{ $avatar }}" alt="user-img" class="avatar avatar-lg brround">
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
