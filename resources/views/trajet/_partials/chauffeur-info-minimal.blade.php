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
@endphp

<div class="row trajet-chauffeur my-4 py-2">
    <div class="col-12">
        <div class="row">
            <div class="col-auto">
                <a href="{{ route('ride_driver', ['ride' => $ride]) }}">
                    <img src="{{ $driverAvatar }}" alt="" class="img-fluid border rounded-circle mx-auto" alt="Avatar">
                </a>
            </div>
            <div class="col-auto">
                <div class="row">
                    <div class="col-12">
                        <h3 class="fs-5">
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
            </div>
        </div>
    </div>
</div>

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
