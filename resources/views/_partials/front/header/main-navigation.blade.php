{{-- Main navigation --}}

@php
    $user = Auth::user();
@endphp

<div class="rafitu horizontal-main bg-white clearfix">
    <div class="horizontal-mainwrapper container clearfix">
        <div class="desktoplogo">
            <a href="{{ route('home') }}"><img src="{{ asset('assets/images/logo/rafitu-logo-with-text.png') }}" alt="RAFITU"></a>
        </div>
        <div class="desktoplogo-1">
            <a href="{{ route('home') }}"><img src="{{ asset('assets/images/logo/rafitu-logo-with-text.png') }}" alt="RAFITU"></a>
        </div>
        <!--Nav-->
        <nav class="horizontalMenu clearfix d-md-flex">
            <ul class="horizontalMenu-list pt-md-0 pt-7">
                <li aria-haspopup="true">
                    <a href="{{ route('long_trajet') }}" class="">Long trajet</a>
                </li>
                <li aria-haspopup="true">
                    <a href="{{ route('trajet_quotidien') }}">Voyage quotidien</a>
                </li>
                <li aria-haspopup="true">
                    <a href="{{ route('trouver_trajet') }}">Trouver votre trajet</a>
                </li>
                @guest
                    <li aria-haspopup="true">
                        <a href="{{ route('login') }}">S'identifier</a>
                    </li>
                @endguest
                @auth
                    <li aria-haspopup="true">
                        <a href="{{ route('dashboard_index') }}">{{ Auth::user()->email }} <span class="fa fa-caret-down m-0"></span></a>
                        <ul class="sub-menu">
                            <li aria-haspopup="true">
                                <a href="{{ route('dashboard_user') }}" class="d-flex justify-content-between align-items-center">
                                    Mon compte
                                    <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                                </a>
                            </li>
                            <li aria-haspopup="true">
                                <a href="{{ route('dashboard_reservations') }}" class="d-flex justify-content-between align-items-center">
                                    Mes réservations
                                    <i class="fa fa-bookmark" aria-hidden="true"></i>
                                </a>
                            </li>
                            <li aria-haspopup="true">
                                @php
                                    // $notReads = Messenger::myMessagesCount($user->id);
                                    $notReads = 0;
                                @endphp
                                <a href="{{ route('dashboard_messenger_index') }}" class="d-flex justify-content-between align-items-center">
                                    Ma messagerie
                                    @if($notReads > 0)
                                        <span class="badge bg-primary rounded-pill">{{ $notReads }}</span>
                                    @else
                                        <i class="fa fa-envelope" aria-hidden="true"></i>
                                    @endif
                                </a>
                            </li>
                            @include('_partials.front.header.manage-static-page')

                            @if($user->isAdmin())
                            <li aria-haspopup="true">
                                <a href="{{ route('admin') }}" class="d-flex justify-content-between align-items-start">
                                    Administration
                                    <i class="fa fa-tachometer" aria-hidden="true"></i>
                                </a>
                            </li>
                            @endif

                            <li aria-haspopup="true">
                                <a href="{{ route('logout') }}" class="d-flex justify-content-between align-items-start">
                                    Déconnexion
                                    <i class="fa fa-sign-out" aria-hidden="true"></i>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endauth
                <li aria-haspopup="true" class="d-block d-md-none">
                    <span>
                        <a class="btn btn-orange ad-post mt-3" href="{{ route('ride_add') }}">
                            <i class="fa fa-plus-circle" aria-hidden="true" style="color: #fff"></i>&nbsp;
                            Publier un trajet
                        </a>
                    </span>
                </li>
            </ul>
            <ul class="mb-0">
                <li aria-haspopup="true" class="mt-5 d-none d-lg-block ">
                    <span>
                        <a class="btn btn-orange ad-post " href="{{ route('ride_add') }}">
                            <i class="fa fa-plus-circle" aria-hidden="true" style="color: #fff"></i>&nbsp;
                            Publier un trajet
                        </a>
                    </span>
                </li>
            </ul>
        </nav>
        <!--Nav-->
    </div>
</div>
