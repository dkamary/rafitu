{{-- Contact confirmation --}}

@extends('_layouts.front')

@section('meta_title')
    Confirmation
@endsection

@section('hero')
    @include('_partials.front.section.breadcrumbs', ['page_title' => 'Confirmation'])
@endsection

@section('main')
    <section class="sptb">
        <div class="container customerpage">
            <div class="row">
                <div class="single-page">
                    <div class="col-12 col-md-8 d-block mx-auto">
                        <div class="wrapper wrapper2 p-5 text-dark">

                            <h5 class="fs-2 mb-0">
                                Merci pour votre aimable attention.
                            </h5>
                            <hr>
                            <p class="fs-4 mt-6">
                                Votre demande de contact a bien été enregistré.<br>
                                Nous reviendrons vers vous le plus tôt possible.
                            </p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
