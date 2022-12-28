{{-- Social network --}}

@php
    $socialParameter = SocialNetworkManager::getParameter();
@endphp

<ul class="list-unstyled list-inline mt-3">

    @if($socialParameter->hasFacebook())
    <li class="list-inline-item">
        <a href="{{ $socialParameter->facebook }}" class="btn-floating btn-sm rgba-white-slight mx-1 waves-effect waves-light">
            <i class="fa fa-facebook bg-facebook"></i>
        </a>
    </li>
    @endif

    @if($socialParameter->hasTwitter())
    <li class="list-inline-item">
        <a href="{{ $socialParameter->twitter }}" class="btn-floating btn-sm rgba-white-slight mx-1 waves-effect waves-light">
            <i class="fa fa-twitter bg-info"></i>
        </a>
    </li>
    @endif

    @if($socialParameter->hasLinkedin())
    <li class="list-inline-item">
        <a href="{{ $socialParameter->linkedin }}" class="btn-floating btn-sm rgba-white-slight mx-1 waves-effect waves-light">
            <i class="fa fa-linkedin bg-linkedin"></i>
        </a>
    </li>
    @endif

</ul>
