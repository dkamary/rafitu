{{-- Info chauffeur minimal --}}

@php
    $driver = $ride->getDriver();
    $avatar = $driver->getAvatar();
    $driverAvatar = $avatar;
    if($avatar) {
        if(strpos($avatar, 'http') !== false) {
            $driverAvatar = $avatar;
        } else {
            $driverAvatar = asset('avatars/' . $avatar);
        }
    } else {
        $driverAvatar = asset('avatars/user-01.svg');
    }

    $showPreferrences = $showPreferrences ?? true;
@endphp

<div class="row trajet-chauffeur my-4 py-2">
    <div class="col-12">
        <div class="row">
            <div class="col-8">

                <div class="row">
                    <div class="col-12">
                        <h3 class="fs-4">
                            <a href="{{ route('ride_driver', ['ride' => $ride]) }}"><strong>{{ $driver ? $driver->firstname : '' }}</strong></a>
                        </h3>
                        @if ($driver->isVerified())
                            <div class="d-flex justify-content-start align-items-center">
                                <img src="{{ asset('assets/images/icons/certified-icon.svg') }}" alt="" style="height: 2rem; width: auto;">
                                <span>Chauffeur certifié</span>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <em class="text-black-50">Aucun avis pour le moment</em>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 pt-4 pb-1">
                        <img src="{{ asset('images/comments.png') }}" alt="" style="height: 2rem; width: auto">&nbsp;
                        <a href="#" class="fs-5">Contacter {{ $driver->firstname }}</a>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="d-flex justify-content-end align-items-center">
                    <a href="{{ route('ride_driver', ['ride' => $ride]) }}">
                        <img src="{{ $driverAvatar }}" alt="" class="img-fluid border rounded-circle me-3" alt="Avatar">
                    </a>

                    <a href="{{ route('ride_driver', ['ride' => $ride]) }}" class="txt-rafitu">
                        <i class="fa fa-chevron-right fa-2x" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@if ($showPreferrences)

    <hr>
    @include('trajet._partials.trajet-preferrences', ['ride' => $ride, 'preferrence_title' => 'Les préférences du trajet'])

@endif

@once

    @push('head')
        <style id="chauffeur-minimal-styles">
            .trajet-chauffeur .img-fluid.rounded-circle {
                height: 5rem;
                width: auto;
            }
        </style>
    @endpush

@endonce
