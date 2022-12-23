{{-- Card messages --}}

<div class="card pt-4">
    <a href="{{ route('dashboard_messenger_index') }}" class="d-flex">
        <img src="{{ asset('images/messages.png') }}" class="card-img-top w-90 mx-auto" alt="...">
    </a>
    <div class="card-body text-white bg-primary mt-4">
        <p class="card-text">
            @if ($messages > 0)
                Vous avez {{ $messages }} nouveaux messages.
            @else
                Vous n'avez pas de nouveau message.
            @endif
        </p>
    </div>
</div>
