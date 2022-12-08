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
            <ul class="horizontalMenu-list">
                <li aria-haspopup="true">
                    <a href="{{ route('long_trajet') }}" class="">Long trajet</a>
                </li>
                <li aria-haspopup="true">
                    <a href="{{ route('trajet_quotidien') }}">Voyage quotidien</a>
                </li>
                <li aria-haspopup="true">
                    <a href="{{ route('trouver_trajet') }}">Trouver votre trajet</a>
                </li>
                {{-- <li aria-haspopup="true"><a href="#">Blog <span class="fa fa-caret-down m-0"></span></a>
                    <ul class="sub-menu">
                        <li aria-haspopup="true">
                            <a href="#">Les dernières nouvelles</a>
                        </li>
                        <li aria-haspopup="true">
                            <a href="#">Catégories</a>
                        </li>
                        <li aria-haspopup="true">
                            <a href="#">Tous les articles</a>
                        </li>
                    </ul>
                </li>
                <li aria-haspopup="true">
                    <a href="contact.html">Contactez-nous</a>
                </li> --}}
                @guest
                    <li aria-haspopup="true">
                        <a href="{{ route('login') }}">S'identifier</a>
                    </li>
                @endguest
                @auth
                    <li aria-haspopup="true">
                        <a href="{{ route('dashboard_index') }}">{{ Auth::user()->email }} <span class="fa fa-caret-down m-0"></span></a>
                        <ul class="sub-menu">
                            <li aria-haspopup="true" class="d-flex justify-content-between align-items-start">
                                <a href="{{ route('dashboard_user') }}">Mon compte</a>
                                {{-- <i class="fa fa-user-circle-o" aria-hidden="true"></i> --}}
                            </li>
                            <li aria-haspopup="true" class="d-flex justify-content-between align-items-start">
                                <a href="{{ route('dashboard_reservations') }}">Mes réservations</a>
                                {{-- <i class="fa fa-bookmark" aria-hidden="true"></i> --}}
                            </li>
                            <li aria-haspopup="true" class="d-flex justify-content-between align-items-start">
                                @php
                                    $notReads = Messenger::myMessagesCount($user->id);
                                @endphp
                                <a href="{{ route('dashboard_messenger_index') }}">Ma messagerie</a>
                                @if($notReads > 0)
                                    <span class="badge bg-primary rounded-pill">{{ $notReads }}</span>
                                @endif
                            </li>
                            @include('_partials.front.header.manage-static-page')
                            <li aria-haspopup="true" class="d-flex justify-content-between align-items-start">
                                <a href="{{ route('logout') }}">Déconnexion</a>
                                {{-- <i class="fa fa-sign-out" aria-hidden="true"></i> --}}
                            </li>
                        </ul>
                    </li>
                @endauth
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
