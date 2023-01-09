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
    <table class="table table-stripe">
        <thead>
            <tr>
                <td class="col-6">Conversations</td>
                <td class="col-2">Date</td>
                <td class="col-2">Statut</td>
                <td class="col-2">&nbsp;</td>
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
                    <td>{{ (new \DateTime($last->date_sent))->format('d/m/Y') }}</td>
                    <td>{{ $last->is_new == 1 ? 'Nouveau' : '' }}</td>
                    <td>
                        <a href="{{ route('dashboard_messenger_show', ['token' => $last->token]) }}">Voir</a>
                    </td>
                </tr>

            @empty
                <tr>
                    <td colspan="4" class="text-center">
                        <em>Vous n'avez pas encore de message pour le moment</em><br>
                        <a href="{{ route('trouver_trajet') }}" class="btn btn-primary my-4">Trouver votre trajet idéal</a>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
