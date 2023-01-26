{{-- Dashboard User --}}

@php
    $user = Auth::user();
    $now = new \DateTime();
@endphp

@extends('dashboard._layout.base')

@section('meta_title')
    Mes messages
@endsection

@section('hero')
    @include('_partials.front.section.breadcrumbs', ['page_title' => 'Mes messages'])
@endsection

@section('dashboard_content')

    <section class="list__container">
        <header class="d-none d-md-flex row py-3 my-3 bg-secondary text-white">
            <div class="col-7 col-md-6 fs-6 fw-bold">Conversation</div>
            <div class="col-5 col-md-3 fs-6 fw-bold">Date</div>
            <div class="col-12 col-md-3 fs-6 fw-bold">&nbsp;</div>
        </header>
        <main>
            @forelse ($messages as $last)
                <div @class([
                    'row',
                    'bg-light' => $loop->even,
                    'border-bottom', 'border-black', 'py-2',
                ])>

                    <div class="col-7 col-md-6">
                        <a @class(['fw-bold' => $last->is_new == 1]) href="{{ route('dashboard_messenger_show', ['token' => $last->token]) }}">
                            {{ $last->sender == $user->id ? 'Vous' : ( $last->sender == null ? 'RAFITU' : Messenger::getUserName($last->sender, 'N/A') ) }} &nbsp;-&nbsp;
                            <span @class(['fw-bold' => ($last->is_seen == 0)])>{{ $last->content }}</span>
                        </a>
                    </div>

                    <div class="col-5 col-md-3">
                        {{ $last->displayDate('H:i') }}
                    </div>

                    <div class="col-12 col-md-3">

                        <div class="d-flex justify-content-center align-items-center">

                            <a href="{{ route('dashboard_messenger_show', ['token' => $last->token]) }}" class="btn text-info">
                                <i class="fa fa-eye" aria-hidden="true"></i>&nbsp;
                                <span>Voir</span>
                            </a>

                            <form action="{{ route('dashboard_messenger_remove') }}" method="post" class="conversation-remove-form">
                                <button type="submit" class="btn text-danger">
                                    <i class="fa fa-times" aria-hidden="true"></i>&nbsp;
                                    <span>Effacer</span>
                                </button>
                                <input type="hidden" name="token" value="{{ $last->token }}">
                                @csrf
                            </form>

                        </div>

                    </div>
                </div>
            @empty
                <div class="row">

                    <div class="col-12 text-center">

                        <em>Vous n'avez pas encore de message pour le moment</em><br>
                        <a href="{{ route('trouver_trajet') }}" class="btn btn-primary my-4">
                            <i class="fa fa-search" aria-hidden="true"></i>&nbsp;
                            Trouver votre trajet idéal
                        </a>

                    </div>

                </div>
            @endforelse
        </main>
    </section>
@endsection


@once

    @push('footer')
        <script id="messenger-index-script">
            window.addEventListener("DOMContentLoaded", event => {
                const removeForms = document.querySelectorAll(".conversation-remove-form");
                if(removeForms && removeForms.length > 0) {
                    removeForms.forEach(form => {
                        form.addEventListener("submit", e => {
                            if(!confirm("Voulez-vous effacer cette conversation ?")) {
                                e.preventDefault();

                                return false;
                            }
                        });
                    });
                }
            });
        </script>
    @endpush

@endonce
