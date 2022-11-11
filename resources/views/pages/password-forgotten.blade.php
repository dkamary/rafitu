{{-- Password forgetted --}}
{{-- User email validated --}}

@extends('_layouts.front')

@section('meta_title')
    Mot de passe oublié
@endsection

@section('hero')
    @include('_partials.front.section.breadcrumbs', [
        'page_title' => 'Mot de passe oublié',
    ])
@endsection

@section('main')
    <section class="sptb">
        <div class="container customerpage">
            <div class="row">
                <div class="single-page">
                    <div class="col-lg-5 col-xl-4 col-md-6 d-block mx-auto">
                        <div class="wrapper wrapper2 pt-3 px-2">

                            @if ($error)
                                <div class="alert alert-danger" role="alert">
                                    {!! $message !!}
                                </div>
                            @else
                                @if (isset($email) && !is_null($email))
                                    <p class="text-dark">
                                        {!! $message ?? 'Un email contenant un lien de réinitialisation vous a été envoyé.' !!}
                                    </p>
                                @else
                                    @include('_partials.front.forms.forgotten')
                                @endif
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
