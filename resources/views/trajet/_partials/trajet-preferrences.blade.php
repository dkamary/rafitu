{{-- Trajet préférrences --}}

<div class="row">
    <div class="col-12 my-3">
        <h3 class="fw-bold fs-5">
            {{ $preferrence_title ?? 'Préférences' }}
        </h3>
    </div>
    <div class="col-12">
        <div class="row my-3 py-5 d-flex justify-content-between trajet-preferences-icons">

            @if($ride->talking == 1)
            <div class="col d-flex justify-content-center align-items-center icon-and-text">
                <span class="text-info fw-bold">
                    <img src="{{ asset('images/conversation.svg') }}" alt="" class="indicator-icon"> &nbsp;
                    Aime bien discuter durant le trajet
                </span>
            </div>
            @endif

            @if ($ride->woman_only == 1)
            <div class="col d-flex justify-content-center align-items-center icon-and-text">
                <span class="text-info fw-bold">
                    <img src="{{ asset('assets/images/icons/woman-group.svg') }}" alt="" class="indicator-icon"> &nbsp;
                    Pour femme uniquement
                </span>
            </div>
            @endif

            <div class="col d-flex justify-content-center align-items-center icon-and-text">
                <span class="text-info fw-bold">
                    @if ($ride->smokers == 1)
                        <img src="{{ asset('assets/images/icons/smoking-area-icon.svg') }}" alt="Fumeurs" class="indicator-icon">&nbsp;
                        Fumeurs autorisés
                    @else
                        <img src="{{ asset('assets/images/icons/no-smoking-area-icon.svg') }}" alt="Non-fumeurs" class="indicator-icon">&nbsp;
                        Non fumeurs
                    @endif
                </span>
            </div>

            <div class="col d-flex justify-content-center align-items-center icon-and-text">
                <span class="text-info fw-bold">
                    @if ($ride->animals == 1)
                        <img src="{{ asset('assets/images/icons/pets-allowed-icon.svg') }}" alt="Animaux autorisés" class="indicator-icon">&nbsp;
                        Animaux autorisés
                    @else
                        <img src="{{ asset('assets/images/icons/no-pets-allowed-icon.svg') }}" alt="Animaux non autorisés" class="indicator-icon">&nbsp;
                        Animaux non autorisés
                    @endif
                </span>
            </div>

            @if($ride->vaccing == 1)
            <div class="col d-flex justify-content-center align-items-center icon-and-text">
                <span class="text-info fw-bold">
                    <img src="{{ asset('images/healthcare.svg') }}" alt="" class="indicator-icon"> &nbsp;
                    Peut montrer un pass vaccinal
                </span>
            </div>
            @endif

        </div>
    </div>
</div>

@once

    @push('head')
    <style id="trajet-preferences-styles">
        @media screen and (max-width: 576px) {
            .trajet-preferences-icons .icon-and-text span {
                display: flex;
                flex-direction: column;
                justify-content: flex-start;
                align-items: center;
                text-align: center;
            }
        }
    </style>
    @endpush

@endonce
