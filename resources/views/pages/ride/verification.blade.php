{{-- Formulaire de vérification --}}

@extends('_layouts.front')

@section('meta_title')
    Vérification profil
@endsection

@section('hero')
    @include('_partials.front.section.breadcrumbs', ['page_title' => 'Vérification profil'])
@endsection

@section('main')
    <section class="sptb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-xl-0">
                        {{-- <div class="card-header">
                            <h3 class="card-title">Publier un trajet</h3>
                        </div> --}}
                        <div class="card-body">
                            <p class="text-center">
                                Avant de pouvoir publier un trajet nous devons procéder à quelques vérification.
                            </p>
                            <p class="text-center mb-5">
                                Veuillez remplir le fomulaire ci-dessous.
                            </p>

                            @include('_partials.front.forms.driver-verification')

                        </div>
                    </div>
                </div>
            </div> <!-- end row -->
        </div>
    </section>
    <!--/Add posts-section-->
@endsection
