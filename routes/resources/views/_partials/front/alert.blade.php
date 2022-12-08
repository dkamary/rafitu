{{-- Alert / Toast --}}

<div class="toast-container position-fixed p-3 bottom-0 end-0">

    @if (session('success'))
        <div class="toast fade show text-white bg-success" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-body">
                {!! session('success') !!}
            </div>
        </div>
    @endif

    @if (session('warning'))
        <div class="toast fade show text-white bg-warning" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-body">
                {!! session('warning') !!}
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="toast fade show text-white bg-danger" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-body">
                {!! session('error') !!}
            </div>
        </div>
    @endif

</div>
