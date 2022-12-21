{{-- Dashboard Menu --}}

@php
    $user = Auth::user();
    $routeName = Route::currentRouteName();
    $notReads = Messenger::myMessagesCount($user->id);
@endphp

<ul class="list-group list-group-flush">
    <li @class(['list-group-item', 'active' => ('dashboard_index' == $routeName)])>
        <a href="{{ route('dashboard_index') }}">Tableau de bord</a>
    </li>
    <li @class(['list-group-item', 'active' => ('dashboard_user' == $routeName)])>
        <a href="{{ route('dashboard_user') }}">Mon profil</a>
    </li>
    <li @class(['list-group-item', 'active' => ('dashboard_reservations' == $routeName)])>
        <a href="{{ route('dashboard_reservations') }}">Mes réservations</a>
    </li>
    <li @class([
        'list-group-item',
        'd-flex justify-content-between align-items-start',
        'active' => ('dashboard_messenger_index' == $routeName)
        ])>
        <a href="{{ route('dashboard_messenger_index') }}">
            Mes messages
            @if($notReads > 0)
            <span class="badge bg-primary rounded-pill">{{ $notReads }}</span>
            @endif
        </a>
    </li>
</ul>
