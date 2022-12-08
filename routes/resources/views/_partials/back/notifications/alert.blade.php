{{-- Alert --}}

<div class="alert alert-dismissible fade show alert-{{ $message_type ?? 'info' }}" role="alert">
    <div class="alert-content text-center fw-bold fs-6">
        {!! $notification !!}
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
