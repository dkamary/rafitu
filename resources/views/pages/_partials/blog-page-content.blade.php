{{-- Blog page content --}}

<article class="sptb bg-white page-static">
    <section class="container-fluid">
        @if(isset($hasTitle) && $hasTitle)
            <header class="section-title center-block text-center">
                <h2>{{ $page->title }}</h2>
            </header>
        @endif
        <main class="container-fluid">
            <div class="row">
                <div class="col-12 post-content">
                    {!! Shortcode::process($page->content) !!}
                </div>
            </div>
        </main>
    </section>
</article>

@once
    @push('head')
        <style id="page-static-styles">
            .page-static ul {
                list-style-type: disc;
                padding-left: 3rem;
            }

            .page-static ul li {
                margin-bottom: .5rem;
            }

            .page-static p,
            .page-static ul {
                margin-bottom: 1rem;
                font-size: 16px;
                line-height: 180%;
            }

            .page-static h1, .page-static .h1,
            .page-static h2, .page-static .h2,
            .page-static h3, .page-static .h3,
            .page-static h4, .page-static .h4,
            .page-static h5, .page-static .h5,
            .page-static h6, .page-static .h6 {
                border-bottom: solid 1px #4c6dff;
                padding-bottom: .8rem;
                margin-top: 1.6rem;
            }

            .page-static .accordion-header {
                border-bottom: none;
            }

            .page-static .accordion-header button.accordion-button {
                font-size: 24px;
            }

            .post-content img {
                max-width: 100%;
                height: auto;
            }

            @media screen and (max-width: 576px) {
                .page-static h1, .page-static .h1 {
                    font-size: 32px;
                }

                .page-static h2, .page-static .h2 {
                    font-size: 24px;
                }

                .page-static h3, .page-static .h3 {
                    font-size: 20px;
                }

                .page-static h4, .page-static .h4 {
                    font-size: 18px;
                }

                .page-static h5, .page-static .h5 {
                    font-size: 16px;
                }

                .page-static h6, .page-static .h6 {
                    font-size: 14px;
                }
            }

        </style>
    @endpush
@endonce
