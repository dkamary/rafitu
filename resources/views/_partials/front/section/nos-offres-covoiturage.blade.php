{{-- Nos offres covoiturages --}}

<section class="sptb position-relative ">
    <div class="container">
    <h2 class="mb-4 font-weight-semibold text-dark">Nos offres de covoiturage</h2>
        <div class="row">
            @foreach ($randoms as $destination)
                <div class="col-xl-4 col-lg-4 col-md-12 mb-0">
                    <a href="#" class="btn btn-lg btn-block btn-primary br-ts-md-0 br-bs-md-0 d-inline-flex justify-content-around align-items-center">
                        <span>{{ $destination->departure }}</span>
                        <i class="fa fa-arrow-right" aria-hidden="true"></i>
                        <span>{{ $destination->arrival }}</span>
                        <strong>{{ $destination->getPrice() }}</strong>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
