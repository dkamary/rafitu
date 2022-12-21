{{-- Statut du trajet --}}

<div class="row">
    <div class="col-12">
        @if ($ride->ride_status_id == 1)
            <p class="fs-5 text-success text-center">
                <i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp;
                <span>Ce trajet est toujours planifié</span>
            </p>
        @endif
    </div>
</div>
