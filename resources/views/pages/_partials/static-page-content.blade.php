{{-- Static page content --}}

<section class="sptb bg-white page-static">
    <div class="container">
        @if(isset($hasTitle) && $hasTitle)
            <div class="section-title center-block text-center">
                <h2>{{ $page->title }}</h2>
            </div>
        @endif
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-10 mx-auto">
                    {!! Shortcode::process($page->content) !!}
                </div>
            </div>
        </div>
    </div>
</section>

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
                line-height: 120%;
            }
        </style>
    @endpush
@endonce
