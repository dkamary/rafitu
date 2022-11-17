{{-- Breadcrumbs --}}

@php
    $header_image = $header_image ?? asset('assets/images/banners/banner.webp');
    if(isset($page) && (strlen(trim($page->preview_image)) > 3)) {
        $header_image = asset('assets/images/uploads/' . $page->preview_image);
    }
@endphp

<!--Breadcrumb-->
<section>
    <div class="bannerimg cover-image bg-background3 sptb-2" data-bs-image-src="{{ $header_image }}">
        <div class="header-text mb-0">
            <div class="container">
                <div class="text-center text-white ">
                    <h1 class="">{!! $page_title ?? 'Titre' !!}</h1>
                    <ol class="breadcrumb text-center">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">{!! $page_title ?? 'Titre' !!}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/Breadcrumb-->
