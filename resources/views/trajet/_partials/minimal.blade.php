{{-- Info trajet minimaliste --}}

@php
    $showLink = $showLink ?? true;
@endphp

<div class="row trajet trajet__unique minimaliste mb-6 py-3 {{ $loop->even ? 'bg-light' : 'bg-white' }}">
    <div class="col-12">

        <div class="row pb-1 mb-3 border-bottom">
            <div class="col-12">
                <h2 class="fs-5 fw-bold mb-1">{{ DateManager::dateFr($ride->getDateDeparture()) }}</h2>
            </div>
        </div>

        @include('trajet._partials.trajet-info', ['ride' => $ride, 'distances' => $distances ?? []])

        @include('trajet._partials.chauffeur-info-minimal', ['ride' => $ride])

        @if ($showLink)
            @include('trajet._partials.link', ['ride' => $ride])
        @endif
    </div>
</div>
