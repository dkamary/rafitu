{{-- Dashboard User --}}

@extends('dashboard._layout.base')

@section('meta_title')
    Mon profil
@endsection

@section('hero')
    @include('_partials.front.section.breadcrumbs', ['page_title' => 'Mon profil'])
@endsection

@section('dashboard_content')
    @if (!$user->isVerified())
    <div class="row">
        <div class="col-12 text-end pb-5">
            <a href="{{ route('driver_verification') }}" class="btn btn-outline-primary fs-6">
                <img src="{{ asset('assets/images/icons/certified-icon.svg') }}" alt="" style="height: 1.3rem; width: auto">&nbsp;
                Faire vérifier mon profil en tant que Chauffeur
            </a>
        </div>
    </div>
    @else
    <div class="row">
        <div class="col-12 text-end pb-5">
            <img src="{{ asset('assets/images/icons/certified-icon.svg') }}" alt="" style="height: 1.3rem; width: auto">&nbsp;
            <em class="text-info fs-6 fw-bold">Profil chauffeur vérifié</em>
        </div>
    </div>
    @endif

    @include('dashboard.forms.user', ['user' => $user])
@endsection
