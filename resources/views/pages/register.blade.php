{{-- Register --}}

@extends('_layouts.front')

@section('meta_title')
    Se connecter
@endsection

@section('hero')
    @include('_partials.front.section.breadcrumbs', ['page_title' => 'Se connecter'])
@endsection

@section('main')
    <section class="sptb">
        <div class="container customerpage">
            <div class="row">
                <div class="single-page">
                    <div class="col-lg-5 col-xl-4 col-md-6 d-block mx-auto">
                        <div class="wrapper wrapper2">

                            @include('_partials.front.forms.register-user')

                            @include('_partials.front.section.oauth')

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
