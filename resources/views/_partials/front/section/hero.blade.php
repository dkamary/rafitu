{{-- Hero section --}}

<!--Sliders Section-->
<section>
    <div class="banner-1 cover-image sptb-2 sptb-tab" data-bs-image-src="{{ asset('assets/images/banners/image_header.webp') }}">
        <div class="header-text mb-0">
            <div class="container">
                <div class="text-center text-white mb-7">
                    <h1 class="mb-1">Un vaste choix de trajets à petits prix</h1>
                    {{-- <p>It is a long established fact that a reader will be distracted by the readable.</p> --}}
                </div>
                <div class="row">
                    <div class="col-xl-10 col-lg-12 col-md-12 d-block mx-auto">
                        <div class="search-background bg-transparent">
                            @include('_partials.front.forms.search-ride-hero-section')
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /header-text -->
    </div>
</section>
<!--Sliders Section-->
