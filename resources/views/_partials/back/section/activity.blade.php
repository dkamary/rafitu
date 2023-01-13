{{-- Activity --}}

<div class="card">
    <div class="card-header">
        <h3 class="card-title fw-bold">Notifications</h3>
    </div>
    <div class="card-body">
        <div class="activity">
            @forelse (DashboardManager::notifications() as $notification)
                @php
                    $user = $notification->getUser();
                    $avatar = get_avatar($user);
                @endphp
                <img src="{{ $avatar }}" alt="" class="img-activity">
                <div class="time-activity">
                    <div @class([
                        "item-activity",
                        "fw-bold" => $notification->isRead(),
                        "text-" . $notification->notification_type != "error" ? $notification->notification_type : "danger",
                    ])>
                        <p class="mb-0">
                            <a href="{{ $notification->link }}">
                                {{ $notification->title }}
                            </a>
                        </p>
                        <small class="text-muted ">{{ show_date($notification->created_at, 'd/m/Y H:i') }}</small>
                    </div>
                </div>
            @empty
                <em>Il n'y a aucune notification pour l'instant</em>
            @endforelse
        </div>
    </div>
</div>
