{{-- Add Ride --}}

@extends('_layouts.front')

@section('meta_title')
    Votre résultat de recherche
@endsection

@section('hero')
    @include('_partials.front.section.breadcrumbs', ['page_title' => 'Votre résultat de recherche'])
@endsection

@section('main')
    <div class="container">
        <div class="row">
            <div class="col-12">
                {{-- @dump($sql);
                @dump($results)
                @dump($rides)
                @dump($ids) --}}
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body h-100">
                        @forelse ($rides as $ride)
                            <div class="row my-3">
                                <div class="col-12">
                                    <span class="underlined">Trajet</span> : <strong>{{ $ride->departure_label }}</strong> à <strong>{{ $ride->arrival_label }}</strong><br>
                                    <span class="underlined">Horaire</span> : {{ $ride->departure_date }} à {{ $ride->arrival_date }}<br>
                                </div>
                            </div>
                        @empty
                            <div class="row my-3">
                                <div class="col-12">
                                    Aucun trajet ne correspond à votre recherche
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
