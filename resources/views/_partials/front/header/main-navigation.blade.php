{{-- Main navigation --}}

<div class="horizontal-main bg-dark-transparent clearfix">
    <div class="horizontal-mainwrapper container clearfix">
        <div class="desktoplogo">
            <a href="{{ route('home') }}"><img src="{{ asset('assets/images/logo/ENTREPRISE.png') }}" alt=""></a>
        </div>
        <div class="desktoplogo-1">
            <a href="{{ route('home') }}"><img src="{{ asset('assets/images/logo/ENTREPRISE.png') }}" alt=""></a>
        </div>
        <!--Nav-->
        <nav class="horizontalMenu clearfix d-md-flex">
            <ul class="horizontalMenu-list">
                <li aria-haspopup="true">
                    <a href="#" class="">Long trajet</a>
                </li>
                <li aria-haspopup="true">
                    <a href="#">Voyage quotidien</a>
                </li>
                <li aria-haspopup="true">
                    <a href="#">Trouver votre trajet</a>
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
                        <a href="#">{{ Auth::user()->email }} <span class="fa fa-caret-down m-0"></span></a>
                        <ul class="sub-menu">
                            <li aria-haspopup="true"><a href="#">Profil</a></li>
                            <li aria-haspopup="true"><a href="{{ route('logout') }}">Déconnexion</a></li>
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
