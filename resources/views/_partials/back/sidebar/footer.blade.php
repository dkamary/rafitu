{{-- Sidebar footer --}}

<div class="app-sidebar-footer">
    <a href="{{ route('dashboard_messenger_index') }}"><span class="fa fa-envelope" aria-hidden="true"></span></a>
    <a href="{{ route('admin_user_edit', ['user' => Auth::user()]) }}"><span class="fa fa-user" aria-hidden="true"></span></a>
    <a href="{{ route('admin_ride_parameters') }}"><span class="fa fa-cog" aria-hidden="true"></span></a>
    <a href="{{ route('logout') }}"><span class="fa fa-sign-in" aria-hidden="true"></span></a>
    <a href="{{ route('dashboard_messenger_index') }}"><span class="fa fa-comment" aria-hidden="true"></span></a>
</div>
