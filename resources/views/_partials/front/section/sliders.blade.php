{{-- Hero Sliders --}}

<!--Sliders Section-->
<section>
    <div class="banner1  relative slider-images">
        <div class="container-fuild">
            <!-- Carousel -->
            <div class="owl-carousel testimonial-owl-carousel2 slider slider-header ">
                <div class="item">
                    <img  alt="first slide" src="{{ asset('assets/images/slides/slide-001-croped.webp') }}" >
                </div>
                <div class="item">
                    <img  alt="first slide" src="{{ asset('assets/images/slides/slide-002-croped.webp') }}" >
                </div>
                <div class="item">
                    <img  alt="first slide" src="{{ asset('assets/images/slides/slide-003-croped.webp') }}" >
                </div>
                <div class="item cover-image" data-bs-image-src="{{ asset('assets/images/slides/slide-004.webp') }}">
                    <img  alt="first slide" src="{{ asset('assets/images/slides/slide-empty.webp') }}" >
                </div>
                <div class="item cover-image" data-bs-image-src="{{ asset('assets/images/slides/slide-005.webp') }}">
                    <img  alt="first slide" src="{{ asset('assets/images/slides/slide-empty.webp') }}" >
                </div>
                <div class="item cover-image" data-bs-image-src="{{ asset('assets/images/slides/slide-006.webp') }}">
                    <img  alt="first slide" src="{{ asset('assets/images/slides/slide-empty.webp') }}" >
                </div>
            </div>
            <div class="header-text slide-header-text mt-0 mb-0">
                <div class="col-xl-8 col-lg-8 col-md-8 d-block mx-auto">
                    <div class="search-background bg-transparent input-field">
                        <div class="text-center text-white  mb-6 ">
                            <h1 class="mb-1 d-none d-md-block">Trouver votre trajet idéal</h1>
                            <p class="d-none d-md-block">Voyager à petit prix</p>
                        </div>
                        @include('_partials.front.forms.search-ride-hero-section')
                    </div>
                </div>
            </div><!-- /header-text -->
        </div>
    </div>
</section>
<!--Sliders Section-->
