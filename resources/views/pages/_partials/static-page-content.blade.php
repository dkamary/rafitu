{{-- Static page content --}}

<section class="sptb bg-white">
    <div class="container">
        @if(isset($hasTitle) && $hasTitle)
            <div class="section-title center-block text-center">
                <h2>{{ $page->title }}</h2>
            </div>
        @endif
        <div class="container">
            <div class="row">
                <div class="col-12">
                    {!! $page->content !!}
                </div>
            </div>
        </div>
    </div>
</section>
