{{-- Pages Index --}}

@extends('_layouts.back')

@section('meta_title')
    Pages
@endsection

@section('main')
    @include('_partials.back.section.breadcrumbs', ['page_title' => 'Pages'])

    <div class="row">
        <div class="col-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Titre de la page</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <a href="{{ route('pages_condition_utilisation') }}">Conditions d'utilisation</a>
                        </td>
                        <td>
                            <a href="{{ route('pages_condition_utilisation') }}">
                                <i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;
                                &Eacute;diter
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="{{ route('pages_charte_cookie') }}">Chartes de confidentialité et cookies</a>
                        </td>
                        <td>
                            <a href="{{ route('pages_charte_cookie') }}">
                                <i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;
                                &Eacute;diter
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="{{ route('pages_contact') }}">Contact</a>
                        </td>
                        <td>
                            <a href="{{ route('pages_contact') }}">
                                <i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;
                                &Eacute;diter
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="{{ route('pages_newsletter') }}">Newsletter</a>
                        </td>
                        <td>
                            <a href="{{ route('pages_newsletter') }}">
                                <i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;
                                &Eacute;diter
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="{{ route('pages_nosValeurs') }}">Nos valeurs</a>
                        </td>
                        <td>
                            <a href="{{ route('pages_nosValeurs') }}">
                                <i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;
                                &Eacute;diter
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="{{ route('pages_qui_sommes_nous') }}">Qui sommes-nous</a>
                        </td>
                        <td>
                            <a href="{{ route('pages_qui_sommes_nous') }}">
                                <i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;
                                &Eacute;diter
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="{{ route('pages_reglement_trajet') }}">Règlements des trajets</a>
                        </td>
                        <td>
                            <a href="{{ route('pages_reglement_trajet') }}">
                                <i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;
                                &Eacute;diter
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
