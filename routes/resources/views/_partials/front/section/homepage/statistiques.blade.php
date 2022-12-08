{{-- Statistiques --}}

<section class="sptb statistiques">
    <div class="container">
        <div class="section-title center-block text-center d-flex flex-column">
            <h2 class="order-2">Nos faits amusants</h2>
            <h3 class="order-1">Les chiffres parlent</h3>
        </div>
        <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                <div class="card">
                    <div class="item-card">
                        <div class="item-card-desc">
                            <a href="#"></a>
                            <div class="item-card-img">
                                <img src="{{ asset('assets/images/other/passager-512x512.webp') }}" alt="img" class="br-te-7 br-ts-7">
                            </div>
                            <div class="item-card-text">
                                <h3 style="font-size: 64px"><i class="fa fa-users" aria-hidden="true"></i></h3>
                                <h4 class="mb-0">Passagers<span>(45)</span></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                <div class="card">
                    <div class="item-card">
                        <div class="item-card-desc">
                            <a href="#"></a>
                            <div class="item-card-img">
                                <img src="{{ asset('assets/images/other/conducteur-512x512.webp') }}" alt="img" class="br-te-7 br-ts-7">
                            </div>
                            <div class="item-card-text">
                                <h3 style="font-size: 64px"><i class="fa fa-user" aria-hidden="true"></i></h3>
                                <h4 class="mb-0">Conducteurs<span>(23)</span></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                <div class="card">
                    <div class="item-card">
                        <div class="item-card-desc">
                            <a href="#"></a>
                            <div class="item-card-img">
                                <img src="{{ asset('assets/images/other/satisfaction-512x512.webp') }}" alt="img" class="br-te-7 br-ts-7">
                            </div>
                            <div class="item-card-text">
                                <h3 style="font-size: 64px"><i class="fa fa-smile-o" aria-hidden="true"></i></h3>
                                <h4 class="mb-0">Satisfactions<span>(48)</span></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@once
    @push('head')
        <style id="statistiques-styles">
            .statistiques .item-card .item-card-desc::before {
                background-color: rgba(76, 109, 255, .5);
            }

            .statistiques .item-card:hover .item-card-desc::before {
                background: rgba(26, 66, 243, .5);
            }
        </style>
    @endpush
@endonce
