{{-- Alert / Toast --}}

<div class="toast-container position-fixed p-3 bottom-0" id="toast-container-alert">

    @if (session('success'))
        <div class="toast fade show text-white bg-success" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <i class="fa fa-check-circle fa-2x me-2" aria-hidden="true"></i>
                <strong class="me-auto">Succès</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                {!! session('success') !!}
            </div>
        </div>
    @endif

    @if (session('warning'))
        <div class="toast fade show text-white bg-warning" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <i class="fa fa-exclamation-triangle fa-2x me-2" aria-hidden="true"></i>
                <strong class="me-auto">Avertissement</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                {!! session('warning') !!}
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="toast fade show text-white bg-danger" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <i class="fa fa-exclamation-circle fa-2x me-2" aria-hidden="true"></i>
                <strong class="me-auto">Erreur</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                {!! session('error') !!}
            </div>
        </div>
    @endif

</div>

@if(session('success') || session('warning') || session('error'))
    @once
        <script defer>
            window.addEventListener("DOMContentLoaded", event => {
                handleAutoHide();
            });

            function handleAutoHide() {
                const toastContainer = document.querySelector(".toast-container");
                if(!toastContainer) {
                    console.debug("No Toast container found!!!");
                    return;
                }

                const closeButtons = toastContainer.querySelectorAll(".btn-close");
                if(!closeButtons || closeButtons.length == 0) {
                    console.error("No close button found!");
                    return;
                }

                closeButtons.forEach(btn => {
                    setTimeout(() => {
                        console.info("Auto hide alert");
                        btn.click();
                    }, 3000);
                });
            }
        </script>
    @endonce
@endif
