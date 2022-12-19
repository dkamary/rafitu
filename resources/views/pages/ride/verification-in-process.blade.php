{{-- Formulaire de vérification --}}

@extends('_layouts.front')

@section('meta_title')
    Vérification du profil en cours
@endsection

@section('hero')
    @include('_partials.front.section.breadcrumbs', ['page_title' => 'Vérification du profil en cours'])
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
                                Votre profil est en cours de validation. Vous pouvez continuer vers la publication de votre trajet.
                            </p>
                            <p class="text-center mb-5">
                                Cependant, veuillez noter que le trajet que vous allez soumettre ne sera pas visible tant que votre profil n'a pas été valider.<br>
                                Merci de votre compréhension.
                            </p>

                            {{-- <a class="btn btn-orange ad-post " href="{{ route('ride_add') }}">
                                <i class="fa fa-plus-circle" aria-hidden="true" style="color: #fff"></i>&nbsp;
                                Publier un trajet
                            </a> --}}

                        </div>
                    </div>
                </div>
            </div> <!-- end row -->
        </div>
    </section>
    <!--/Add posts-section-->
@endsection
