{{-- Add Ride --}}

@extends('_layouts.front')

@section('meta_title')
    Votre trajet est publié
@endsection

@section('hero')
    @include('_partials.front.section.breadcrumbs', ['page_title' => 'Votre trajet est publié'])
@endsection

@section('main')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body h-100">
                        <div class="border-0">
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab-51">
                                    <div id="profile-log-switch">
                                        <div class="media-heading">
                                            <h5><strong>Information sur votre trajet</strong></h5>
                                        </div>
                                        <div class="table-responsive ">
                                            <table class="table row table-borderless">
                                                <tbody class="col-lg-12 col-xl-6 p-0">
                                                    <tr>
                                                        <td><strong>Départ :</strong> {{ $ride->departure_label }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Date et heure de départ :</strong>
                                                            {{ $ride->departure_date }}</td>
                                                    </tr>

                                                </tbody>
                                                <tbody class="col-lg-12 col-xl-6 p-0">
                                                    <tr>
                                                        <td><strong>Arrivée :</strong> {{ $ride->arrival_label }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Date et heure d'arrivée :</strong>
                                                            {{ $ride->arrival_date }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="row profie-img">
                                            <div class="col-md-12 text-justify">
                                                <div class="media-heading">
                                                    <h5><strong>Détails</strong></h5>
                                                </div>
                                                <p>
                                                    Tarif: <strong class="text-info">{{ $ride->price }} €</strong>
                                                </p>
                                                <p>
                                                    Nombre de sièges disponible: <strong class="text-info">{{ $ride->seats_available }}</strong>
                                                </p>
                                                @if($ride->woman_only)
                                                <p>
                                                    <strong class="text-info">Trajet pour femme uniquement</strong>
                                                </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab-61">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-6">
                                            <img class="img-fluid rounded" src="../assets/images/photos/8.jpg "
                                                alt="banner image">
                                        </div>
                                        <div class="col-lg-3 col-md-6">
                                            <img class="img-fluid rounded" src="../assets/images/photos/10.jpg"
                                                alt="banner image ">
                                        </div>
                                        <div class="col-lg-3 col-md-6">
                                            <img class="img-fluid rounded" src="../assets/images/photos/11.jpg"
                                                alt="banner image ">
                                        </div>
                                        <div class="col-lg-3 col-md-6">
                                            <img class="img-fluid rounded " src="../assets/images/photos/12.jpg"
                                                alt="banner image ">
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab-71">
                                    <div class="wideget-user-followers">
                                        <div class="media m-0 mt-0 ">
                                            <img class="avatar brround avatar-md me-3"
                                                src="../assets/images/faces/male/18.jpg" alt="avatar-img">
                                            <div class="media-body">
                                                <a href="" class="text-default font-weight-semibold">John Paige</a>
                                                <p class="text-muted ">johan@gmail.com</p>
                                            </div>
                                        </div>
                                        <div class="media mt-2 ">
                                            <span class="avatar cover-image avatar-md brround bg-secondary me-3">LQ</span>
                                            <div class="media-body">
                                                <a href="" class="text-default font-weight-semibold">Lillian
                                                    Quinn</a>
                                                <p class="text-muted">lilliangore</p>
                                            </div>
                                        </div>
                                        <div class="media mt-2 ">
                                            <span class="avatar cover-image avatar-md brround me-3">IH</span>
                                            <div class="media-body">
                                                <a href="" class="text-default font-weight-semibold">Irene Harris</a>
                                                <p class="text-muted">ireneharris@gmail.com</p>
                                            </div>
                                        </div>
                                        <div class="media mt-2 ">
                                            <img class="avatar brround avatar-md me-3"
                                                src="../assets/images/faces/female/22.jpg" alt="avatar-img">
                                            <div class="media-body">
                                                <a href="" class="text-default font-weight-semibold">Harry Fisher</a>
                                                <p class="text-muted mb-0">harryuqt</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
