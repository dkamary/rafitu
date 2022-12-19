{{-- Formulaire de vérification --}}

@extends('_layouts.front')

@section('meta_title')
    Votre profil a déjà été vérifié
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
                                Merci de votre sollicitude mais votre profil a déjà été vérifié.
                            </p>
                            <p class="text-center mb-5">
                                merci.
                            </p>

                        </div>
                    </div>
                </div>
            </div> <!-- end row -->
        </div>
    </section>
    <!--/Add posts-section-->
@endsection
