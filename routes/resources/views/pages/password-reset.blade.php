{{-- Password forgetted --}}
{{-- User email validated --}}

@extends('_layouts.front')

@section('meta_title')
    Réinitialisation du mot de passe
@endsection

@section('hero')
    @include('_partials.front.section.breadcrumbs', [
        'page_title' => 'Réinitialiser votre mot de passe',
    ])
@endsection

@section('main')
    <section class="sptb">
        <div class="container customerpage">
            <div class="row">
                <div class="single-page">
                    <div class="col-lg-5 col-xl-4 col-md-6 d-block mx-auto">
                        <div class="wrapper wrapper2 pt-3 px-2">

                            @if ($done)
                                <div class="alert alert-success" role="alert">
                                    Votre mot de passe a été réinitialisé. <br>
                                    Veuillez vous <a href="{{ route('login') }}">reconnecter</a> avec votre nouveau mot de passe.
                                </div>
                            @else
                                @if ($error)
                                    <div class="alert alert-danger" role="alert">
                                        {!! $message ?? 'Une erreur est survenue!' !!}
                                    </div>
                                @endif

                                @include('_partials.front.forms.reset')

                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
