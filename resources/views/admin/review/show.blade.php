{{-- Détails --}}

@extends('_layouts.back')

@php
    $title = $title ?? 'Commentaires';
    $reservation = $review->getReservation();
    $ride = $reservation ? $reservation->getRide() : new App\Models\Ride();
@endphp

@section('meta_title')
    {{ $title }}
@endsection

@section('main')
    @include('_partials.back.section.breadcrumbs', ['page_title' => $title])

    @include('_partials.back.notifications.flash-message')

    <div class="row bg-white py-5 my-3">
        <div class="col-12">
            <div class="row">
                <div class="col-12 col-sm-4 col-md-3 d-flex flex-column align-items-center justify-content-center">
                    <div class="d-flex justify-content-center align-items-center" style="max-width: 100%; width: 200px; height: 200px; overflow: hidden; border-radius: 50%; border: solid 2px #fff; box-shadow: 1px 2px 5px 0px rgba(0, 0, 0, .6)">
                        <img src="{{ get_avatar($review->getUser()) }}" alt="" class="img-fluid">
                    </div>
                    <div class="text-center my-3">
                        {!! $review->getUserName() !!}
                    </div>
                </div>
                <div class="col-12 col-sm-5 col-md-4 d-flex flex-column justify-content-center">
                    <div class="fs-italic">{{ $review->comments }}</div>
                    <div class="my-2 fs-5">
                        <u>Note</u>: <strong>{{ $review->note }}</strong> / 5
                    </div>
                </div>
                <div class="col-12 col-sm-3 col-md-2 d-flex flex-column justify-content-center">
                    @if($review->is_active != 1)

                        <form action="{{ route('admin_review_validate') }}" method="post" class="form-validate">
                            <button type="submit" onclick="if(!confirm('Voulez-vous valider le commentaire ?')) return false;"
                            @class([
                                'btn',
                                'btn-outline-success',
                            ])>
                                <i class="fa fa-check" aria-hidden="true"></i>&nbsp;
                                Valider le commentaire
                            </button>
                            @csrf
                            <input type="hidden" name="id" value="{{ $review->id }}">
                        </form>

                    @elseif ($review->is_active == 1)

                        <form action="{{ route('admin_review_deactivate') }}" method="post" class="form-delete">
                            <button type="submit"  onclick="if(!confirm('Voulez-vous effacer le commentaire ?')) return false;"
                            @class([
                                'btn',
                                'btn-outline-danger',
                            ])>
                                <i class="fa fa-trash" aria-hidden="true"></i>&nbsp;
                                Effacer le commentaire
                            </button>
                            @csrf
                            <input type="hidden" name="id" value="{{ $review->id }}">
                        </form>

                    @endif
                </div>
            </div>
            <div class="row my-5">
                <div class="col-12 col-sm-10 col-md-8 mx-auto">
                    <div class="card border-info">
                        <div class="card-header bg-info">
                            <h3 class="fw-bold text-white">Réservation</h3>
                        </div>
                        <div class="card-body">
                            @include('trajet._partials.date', ['ride' => $ride])
                            <hr>
                            @include('trajet._partials.trajet-info', ['ride' => $ride, 'showPlaceLink' => false])
                            <hr>
                            @include('trajet._partials.chauffeur-info-details', ['ride' => $ride, 'showPreferrences' => false])
                            <hr>
                            @include('trajet._partials.trajet-preferrences', ['ride' => $ride])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
