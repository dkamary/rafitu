{{-- Post Index --}}

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
                    @forelse ($posts as $post)
                    <tr>
                        <td>
                            <a href="{{ route('admin_post_e') }}">Conditions d'utilisation</a>
                        </td>
                        <td>
                            <a href="{{ route('pages_condition_utilisation') }}">
                                <i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;
                                &Eacute;diter
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="2">
                            <em>Il n'y a pas d'artcle pour le moment</em>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
