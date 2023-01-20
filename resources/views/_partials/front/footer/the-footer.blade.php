{{-- Footer --}}

<!--Footer Section-->
<section class="main-footer">
    <footer class="bg-dark-purple text-white">
        <div class="footer-main">
            <div class="container">
                <div class="row">
                    {{-- <div class="col-lg-3 col-md-12">
                        <h6>à propos</h6>
                        <hr class="deep-purple  accent-2 mb-4 mt-0 d-inline-block mx-auto">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit amet numquam iure provident
                            voluptate essequasi, veritatis totam voluptas nostrum.Lorem ipsum dolor sit amet,
                            consectetur </p>
                        <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum .</p>
                    </div> --}}
                    <div class="col-lg-4 col-md-12">
                        <h6>Fondamentaux</h6>
                        <hr class="deep-purple text-primary accent-2 mb-4 mt-0 d-inline-block mx-auto">
                        <ul class="list-unstyled mb-0">
                            <li><a href="{{ route('static_pages', ['slug' => 'charte-confidentialite-et-cookies']) }}">Charte
                                    de confidentialité et Cookies</a></li>
                            <li><a href="{{ route('static_pages', ['slug' => 'reglement-trajet']) }}">Règlements sur les
                                    trajets</a></li>
                            <li><a href="{{ route('static_pages', ['slug' => 'conditions-utilisation']) }}">Conditions
                                    d'utilisation</a></li>
                            <li><a href="{{ route('static_pages', ['slug' => 'mentions-legales']) }}">Mentions
                                    légales</a></li>
                            <li><a href="{{ route('static_pages', ['slug' => 'faq']) }}">FAQ</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-4 col-md-12">
                        <h6 class="text-capita">À propos</h6>
                        <hr class="deep-purple  text-primary accent-2 mb-4 mt-0 d-inline-block mx-auto">
                        <ul class="list-unstyled mb-0">
                            <li>
                                <a href="{{ route('static_pages', ['slug' => 'qui-sommes-nous']) }}">Qui sommes-nous</a>
                            </li>
                            {{-- <li>
                                <a href="{{ route('static_pages', ['slug' => 'contact']) }}">Contact</a>
                            </li> --}}
                            <li>
                                <a href="{{ route('static_pages', ['slug' => 'newsletter']) }}">Newsletter</a>
                            </li>
                            <li>
                                <a href="{{ route('static_pages', ['slug' => 'nos-valeurs']) }}">Nos valeurs, nos métiers</a>
                            </li>
                        </ul>

                        @include('_partials.front.footer.social-networks')

                    </div>
                    <div class="col-lg-4 col-md-12">
                        <h6>Newsletter</h6>
                        <hr class="deep-purple  text-primary accent-2 mb-4 mt-0 d-inline-block mx-auto">
                        <div class="clearfix"></div>

                        @include('_partials.front.forms.newsletter', ['isInline' => true])

                        <h6 class="mb-0 mt-5">Paiements</h6>
                        <hr class="deep-purple  text-primary accent-2 mb-2 mt-3 d-inline-block mx-auto">
                        <div class="clearfix"></div>
                        <div class="footer-payment-list">
                            <a href="#" class="col">
                                <img src="{{ asset('logos/PayPal-Logo.wine.svg') }}" alt="Paypal" class="footer-icon-pay">
                            </a>
                            <a href="#" class="col">
                                <img src="{{ asset('logos/Visa_Inc.-Logo.wine.svg') }}" alt="Visa" class="footer-icon-pay">
                            </a>
                            <a href="#" class="col">
                                <img src="{{ asset('logos/Mastercard-Logo.wine.svg') }}" alt="Mastercard" class="footer-icon-pay">
                            </a>
                            <a href="#" class="col">
                                <img src="{{ asset('logos/Orange_Money-Logo.wine.svg') }}" alt="Orange Money" class="footer-icon-pay">
                            </a>
                            <a href="#" class="col">
                                <img src="{{ asset('logos/mtn-mobile-money-logo.png') }}" alt="Mastercard" class="footer-icon-pay">
                            </a>
                            <a href="#" class="col">
                                <img src="{{ asset('logos/moov-money.png') }}" alt="Mastercard" class="footer-icon-pay">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-dark-purple text-white p-0">
            <div class="container">
                <div class="row d-flex">
                    <div class="col-lg-12 col-sm-12 mt-3 mb-3 text-center ">
                        Copyright © {{ date('Y') }} <a href="#" class="fs-14 text-primary">Rafitu</a> tous droits
                        réservés.
                    </div>
                </div>
            </div>
        </div>
    </footer>
</section>
<!--Footer Section-->

<!-- Back to top -->
{{-- <a href="#top" id="back-to-top"><i class="fa fa-rocket"></i></a> --}}
