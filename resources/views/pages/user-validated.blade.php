{{-- User email validated --}}

@extends('_layouts.front')

@section('meta_title')
    @if ($validate)
        Merci d'avoir confirmé votre email
    @else
        Désolé nous n'avons pas pu valider votre email
    @endif
@endsection

@section('hero')
    @include('_partials.front.section.breadcrumbs', [
        'page_title' => $validate
            ? 'Merci d\'avoir confirmé votre email'
            : 'Echec de validation',
    ])
@endsection

@section('main')
    <section class="sptb">
        <div class="container customerpage">
            <div class="row">
                <div class="single-page">
                    <div class="col-lg-5 col-xl-4 col-md-6 d-block mx-auto">
                        <div class="wrapper wrapper2 pt-3 px-2">

                            @if ($validate)
                                <h3>
                                    Merci pour avoir confirmer votre email.
                                </h3>
                                <p class="text-dark">
                                    Vous pouvez maintenant vous connecter et accéder à toute les fonctionnalités de RAFITU.
                                </p>
                                <p class="text-dark pt-2">
                                    Cliquez ici pour vous <a href="{{ route('login') }}" class="text-info">identifier</a>
                                </p>
                            @else
                                <h3>
                                    La confirmation de l'adresse email à échoué
                                </h3>
                                <p class="text-dark">
                                    Malheureusement, nous n'avons pas pu confirmer votre adresse email pour la raison suivante:<br>
                                </p>
                                <p class="pt-2">
                                    <em><strong class="text-danger">{{ $error }}</strong></em>
                                </p>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
