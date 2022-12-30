{{-- User created and need confirmation --}}

@extends('_layouts.front')

@section('meta_title')
    Confirmer votre inscription
@endsection

@section('hero')
    @include('_partials.front.section.breadcrumbs', ['page_title' => 'Confirmer votre inscription'])
@endsection

@section('main')
    <section class="sptb">
        <div class="container customerpage">
            <div class="row">
                <div class="single-page">
                    <div class="col-lg-7 col-xl-6 col-md-10 d-block mx-auto">
                        <div class="wrapper wrapper2 pt-3 px-2">

                            <h3>
                                Merci pour votre inscription.
                            </h3>
                            <p class="text-dark fs-5">
                                Encore une dernière étape.<br> Veuillez vérifier votre boîte email <br>
                                <strong><em>{{ $user->email }}</em></strong>.<br>
                            </p>

                            <p class="text-dark fs-5 mt-3">
                                Un email de confirmation vous a été envoyé.
                            </p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
