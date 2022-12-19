{{-- Driver display --}}

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

<div class="row">
    <div class="col-4 col-md-2">
        <img src="{{ $driver->avatar }}" alt="" class="img-fluid border rounded-circle" alt="Avatar">
    </div>
    <div class="col">
        <div class="fs-6">{{ $driver ? $driver->getFullname() : '' }}</div>
        <div class="my-2"><em>Aucun avis pour le moment</em></div>
        <div class="row">
            <div class="col-12">
                @if ($driver && $driver->biography)
                    <em class="text-info">{!! $driver->biography !!}</em>
                @else
                    <em class="fw-bold">Le conducteur n'a pas encore partager sa bio.</em>
                @endif
            </div>
        </div>
    </div>

    @if ($driver->isVerified())
    <div class="col-12 my-4 d-flex justify-content-start align-items-center text-info fw-bolder">
        <img src="{{ asset('assets/images/icons/certified-icon.svg') }}" alt="certified" style="height: 2.5rem; width: auto;">&nbsp;
        Chauffeur confirmé
    </div>
    @else
    <em>non vérifié</em>
    @endif

    <div class="col-12">
        <div class="row">
            <div class="col-auto">
                <a href="#" id="messenger" class="btn btn-outline-info my-3 d-flex justify-content-center align-items-center">
                    <i class="fa fa-envelope fa-2x" aria-hidden="true"></i>
                    <span class="ml-2">
                        &nbsp;
                        Contacter {{ $driver ? $driver->getFullname() : '' }}
                    </span>
                </a>
            </div>
        </div>
    </div>
</div>
