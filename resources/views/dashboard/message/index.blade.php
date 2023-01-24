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
    {{-- @dd($messages) --}}
    <table class="table table-stripe">
        <thead>
            <tr>
                <td class="col-4">Conversations</td>
                <td class="col-3">Date</td>
                {{-- <td class="col-2">Statut</td> --}}
                <td class="col-5">&nbsp;</td>
            </tr>
        </thead>
        <tbody>
            @forelse ($messages as $last)

                <tr>
                    <td @class(['fw-bold' => $last->is_new == 1 ])>
                        <a href="{{ route('dashboard_messenger_show', ['token' => $last->token]) }}">
                            {{ $last->sender == $user->id ? 'Vous' : ( $last->sender == null ? 'RAFITU' : Messenger::getUserName($last->sender, 'N/A') ) }} &nbsp;-&nbsp;
                            <span @class(['fw-bold' => ($last->is_seen == 0)])>{{ $last->content }}</span>
                        </a>
                    </td>
                    {{-- <td>{{ (new \DateTime($last->date_sent))->format('d/m/Y') }}</td> --}}
                    <td class="text-center">{{ $last->displayDate('H:i') }}</td>
                    {{-- <td class="text-center">{!! $last->is_new == 1 ? 'Nouveau' : '&hellip;' !!}</td> --}}
                    <td class="text-center">
                        <div class="d-flex justify-content-center align-items-center">
                            <a href="{{ route('dashboard_messenger_show', ['token' => $last->token]) }}" class="btn text-info">
                                <i class="fa fa-eye" aria-hidden="true"></i>&nbsp;
                                <div class="d-none d-sm-inline-block">Voir</div>
                            </a>

                            <form action="{{ route('dashboard_messenger_remove') }}" method="post" class="conversation-remove-form">
                                <button type="submit" class="btn text-danger">
                                    <i class="fa fa-times" aria-hidden="true"></i>&nbsp;
                                    <div class="d-none d-sm-inline-block">Effacer</div>
                                </button>
                                <input type="hidden" name="token" value="{{ $last->token }}">
                                @csrf
                            </form>
                        </div>
                    </td>
                </tr>

            @empty
                <tr>
                    <td colspan="3" class="text-center">
                        <em>Vous n'avez pas encore de message pour le moment</em><br>
                        <a href="{{ route('trouver_trajet') }}" class="btn btn-primary my-4">Trouver votre trajet idéal</a>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
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
