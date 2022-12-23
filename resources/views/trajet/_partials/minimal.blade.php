{{-- Info trajet minimaliste --}}

@php
    $showLink = $showLink ?? true;
    $showDriver = $showDriver ?? true;
    $evenBg = $evenBg ?? 'bg-light';
    $oddBg = $oddBg ?? 'bg-white';
    $showDashboardLinks = $showDashboardLinks ?? false;
@endphp

<div class="row trajet trajet__unique minimaliste mb-6 py-3 {{ $loop->even ? $evenBg : $oddBg }} {{ $trajet_classes ?? '' }}">
    <div class="col-12">

        <div class="row pb-1 mb-3 border-bottom">
            <div class="col-12">
                <h2 class="fs-5 fw-bold mb-1">{{ DateManager::dateFr($ride->getDateDeparture()) }}</h2>
            </div>
        </div>

        @include('trajet._partials.trajet-info', ['ride' => $ride, 'distances' => $distances ?? []])

        @if($showDriver)
            @include('trajet._partials.chauffeur-info-minimal', ['ride' => $ride])
        @endif

        @if ($showLink)
            @include('trajet._partials.link', ['ride' => $ride])
        @endif

        @if($showDashboardLinks)
            @include('trajet._partials.dashboard-links', ['reservation' => $reservation])
        @endif
    </div>
</div>
