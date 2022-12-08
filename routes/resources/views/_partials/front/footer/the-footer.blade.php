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
                            <li><a href="{{ route('static_pages', ['slug' => 'faq']) }}">Page FAQ</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-4 col-md-12">
                        <h6 class="text-capita">À propos</h6>
                        <hr class="deep-purple  text-primary accent-2 mb-4 mt-0 d-inline-block mx-auto">
                        <ul class="list-unstyled mb-0">
                            <li>
                                <a href="{{ route('static_pages', ['slug' => 'qui-sommes-nous']) }}">Qui sommes-nous</a>
                            </li>
                            <li>
                                <a href="{{ route('static_pages', ['slug' => 'contact']) }}">Contact</a>
                            </li>
                            <li>
                                <a href="{{ route('static_pages', ['slug' => 'newsletter']) }}">Newsletter</a>
                            </li>
                            <li>
                                <a href="{{ route('static_pages', ['slug' => 'nos-valeurs']) }}">Nos valeurs, nos métiers</a>
                            </li>
                        </ul>
                        <ul class="list-unstyled list-inline mt-3">
                            <li class="list-inline-item">
                                <a class="btn-floating btn-sm rgba-white-slight mx-1 waves-effect waves-light">
                                    <i class="fa fa-facebook bg-facebook"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a class="btn-floating btn-sm rgba-white-slight mx-1 waves-effect waves-light">
                                    <i class="fa fa-twitter bg-info"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a class="btn-floating btn-sm rgba-white-slight mx-1 waves-effect waves-light">
                                    <i class="fa fa-google-plus bg-danger"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a class="btn-floating btn-sm rgba-white-slight mx-1 waves-effect waves-light">
                                    <i class="fa fa-linkedin bg-linkedin"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <h6>Newsletter</h6>
                        <hr class="deep-purple  text-primary accent-2 mb-4 mt-0 d-inline-block mx-auto">
                        <div class="clearfix"></div>
                        <div class="input-group w-70">
                            <input type="text" class="form-control br-ts-3  br-bs-3 " placeholder="Email">
                            <div class=" ">
                                <button type="button" class="btn btn-primary br-ts-0  br-bs-0"> Souscrire </button>
                            </div>
                        </div>
                        <h6 class="mb-0 mt-5">Paiements</h6>
                        <hr class="deep-purple  text-primary accent-2 mb-2 mt-3 d-inline-block mx-auto">
                        <div class="clearfix"></div>
                        <ul class="footer-payments">
                            <li class="ps-0"><a href="#"><i class="fa fa-credit-card-alt text-muted"
                                        aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-paypal text-muted" aria-hidden="true"></i></a></li>
                        </ul>
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
<a href="#top" id="back-to-top"><i class="fa fa-rocket"></i></a>
