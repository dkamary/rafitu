{{-- Inbox Preview --}}

@php
    $messenger = Messenger::preview(10);
@endphp

<div class="dropdown d-md-flex">
    <a class="nav-link icon" data-bs-toggle="dropdown">
        <i class="fa fa-envelope-o"></i>
        @if($messenger->notRead > 0)
            <span class=" nav-unread badge badge-warning  badge-pill">{{ $messenger->notRead }}</span>
        @endif
    </a>
    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
        @foreach ($messenger->messages as $msg)
            @php
                $date = new \DateTime($msg->sent_date);
                $now = new \DateTime();
                $diff = $now->diff($date);
                $days = ($diff->y * 365) + ($diff->m * 30) + $diff->d;
                $display = ($days > 0 ? $days .'j ' : '');
                $display .= ($diff->h > 0 ? $diff->h .'h ' : '') .($diff->i > 0 ? $diff->i .'mn ' : '') .($diff->s > 0 ? $diff->s .'s' : '');
            @endphp
            <a href="#" class="dropdown-item d-flex pb-3">
                <img src="assets/images/faces/male/41.jpg" alt="avatar-img" class="avatar brround me-3 align-self-center">
                <div>
                    <strong>{{ $msg->name }}</strong> {{ $msg->subject }}
                    <div class="small text-muted">Il y a {{ $display }}</div>
                </div>
            </a>
        @endforeach
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item text-center">Voir tous les messages</a>
    </div>
</div>
