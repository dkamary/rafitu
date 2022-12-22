{{-- Date trajet --}}

@php
    $departureDate = $ride->getDateDeparture();

@endphp

<div class="row">
    <div class="col-12">
        <h2 class="fs-1 fw-normal text-center">
            {{ DateManager::dateFr($departureDate) }}
        </h2>
    </div>
</div>
