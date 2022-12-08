{{-- Advertise --}}

<!--post section-->
<section @class($advertise_classes ?? [])>
    <div class="cover-image sptb bg-background-color" data-bs-image-src="../assets/images/banners/banner4.jpg">
        <div class="content-text mb-0">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 image-container d-flex justify-content-center align-items-center">
                        @isset($advertise_img)
                            <img src="{{ $advertise_img }}" alt="{{ $advertise_title ?? '...' }}">
                        @endisset
                    </div>
                    <div class="col-md-6">
                        <div class="text-center text-white ">

                            @isset($advertise_title)
                                <h2 class="mb-2 display-5">
                                    {!! $advertise_title !!}
                                </h2>
                            @endisset

                            @isset($advertise_text)
                                <p>
                                    {!! $advertise_text !!}
                                </p>
                            @endisset

                            @isset($advertise_link)
                                <div class="mt-5">
                                    <a href="{{ $advertise_link }}" class="btn btn-primary btn-pill">
                                        {!! $advertise_link_text ?? 'En savoir plus' !!}
                                    </a>
                                </div>
                            @endisset

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/post section-->
