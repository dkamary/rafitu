{{-- Bootstrap Slider --}}

<section class="hero-slider position-relative">
    <div id="home-slider" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('assets/images/slides/slide-01-3200x1200.webp') }}" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('assets/images/slides/slide-02-3200x1200.webp') }}" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('assets/images/slides/slide-03-3200x1200.webp') }}" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#home-slider" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#home-slider" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="header-text slide-header-text mt-0 mb-0 position-absolute">
        <div class="d-block mx-auto">
            <div class="search-background bg-transparent input-field overflow-visible">
                <div class="text-center text-white mb-6 ">
                    <h1 class="mb-1 d-none d-md-block text-white">Trouver votre trajet idéal</h1>
                    <p class="d-none d-md-block text-white">Voyager à petit prix</p>
                </div>

                @if(!is_mobile())

                <div class="row">
                    <div class="col-12">
                        @include('_partials.front.forms.search-ride-hero-section')
                    </div>
                </div>

                @endif
            </div>
        </div>
    </div>

    @if(is_mobile())
        <div class="row bg-dark py-5">
            <div class="col-12">
                <div class="mobile-search-container">
                    @include('_partials.front.forms.search-ride-hero-section', [
                        'search_button_text' => '&nbsp;Rechercher un trajet',
                    ])
                </div>
            </div>
        </div>
    @endif

</section>

{{-- @includeWhen(is_mobile(), '_partials.front.forms.search-ride-hero-mobile') --}}

@once
    @push('head')
        <style id="bs-slider">
            .hero-slider .header-text.position-absolute {
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
            }
        </style>

        <style id="mobile-search-style">
            @media screen and (max-width: 576px) {
                .mobile-search-container {
                    width: 90%;
                    background-color: #ffffff;
                    padding: .5rem;
                    border-radius: .2rem;
                    margin-top: -3rem;
                    margin-left: auto;
                    margin-right: auto;
                }

                .mobile-search-container #form-search-ride-hero .form-group {
                    margin-bottom: .5rem !important;
                }
            }
        </style>
    @endpush
@endonce
