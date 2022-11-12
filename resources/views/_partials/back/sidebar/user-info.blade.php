{{-- User Info --}}

@php
    $user = isset($user) && !is_null($user) ? $user : Auth::user();
    $userAvatar = !is_null($user->avatar) ? $user->avatar : asset('assets/images/default/user.svg');
@endphp

<div class="app-sidebar__user clearfix">
    <div class="dropdown user-pro-body">
        <div>
            <img src="{{ $userAvatar }}" alt="user-img" class="avatar avatar-lg brround">
            <a href="editprofile.html" class="profile-img">
                <span class="fa fa-pencil" aria-hidden="true"></span>
            </a>
        </div>
        <div class="user-info">
            <h2>{{ $user->firstname .' ' . $user->lastname }}</h2>
            {{-- <span>Web Designer</span> --}}
        </div>
    </div>
</div>
