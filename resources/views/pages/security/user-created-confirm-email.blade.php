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
                    <div class="col-lg-5 col-xl-4 col-md-6 d-block mx-auto">
                        <div class="wrapper wrapper2 pt-3 px-2">

                            <h3>
                                Merci pour votre inscription.
                            </h3>
                            <p class="text-dark">
                                Encore une dernière étape.<br> Veuillez vérifier votre boîte email <strong><em>{{ $user->email }}</em></strong>.<br>
                                Un email de confirmation vous a été envoyé.
                            </p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
