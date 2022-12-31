{{-- Dashboard Menu --}}

@php
    $user = Auth::user();
    $routeName = Route::currentRouteName();
    $notReads = Messenger::myMessagesCount($user->id);
@endphp

<ul class="list-group list-group-flush">
    <li @class(['list-group-item', 'active' => ('dashboard_index' == $routeName)])>
        <a href="{{ route('dashboard_index') }}">
            <img src="{{ asset('images/dashboard.png') }}" alt="" style="height: 1.2rem; width: auto;">&nbsp;
            Tableau de bord
        </a>
    </li>
    <li @class(['list-group-item', 'active' => ('dashboard_user' == $routeName)])>
        <a href="{{ route('dashboard_user') }}">
            <img src="{{ asset('images/user.png') }}" alt="" style="height: 1.2rem; width: auto;">&nbsp;
            Mon profil
        </a>
    </li>
    <li @class(['list-group-item', 'active' => ('dashboard_reservations' == $routeName)])>
        <a href="{{ route('dashboard_reservations') }}">
            <img src="{{ asset('images/booking-calendar.png') }}" alt="" style="height: 1.2rem; width: auto;">&nbsp;
            Mes réservations
        </a>
    </li>
    <li @class([
        'list-group-item',
        'd-flex justify-content-between align-items-start',
        'active' => ('dashboard_messenger_index' == $routeName)
        ])>
        <a href="{{ route('dashboard_messenger_index') }}">
            <img src="{{ asset('images/messages.png') }}" alt="" style="height: 1.2rem; width: auto;">&nbsp;
            Mes messages
            {{-- @if($notReads > 0)
            <span class="badge bg-primary rounded-pill">{{ $notReads }}</span>
            @endif --}}
        </a>
    </li>
</ul>
