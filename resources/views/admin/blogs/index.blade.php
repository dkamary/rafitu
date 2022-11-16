{{-- Admin blog index --}}

@extends('_layouts.back')

@section('meta_title')
    Blog
@endsection

@section('main')
    @include('_partials.back.section.breadcrumbs', ['page_title' => 'Blog'])

    <div class="row">
        <div class="col-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th width="70%">Titre de l'article</th>
                        <th width="30%">
                            <div class="d-flex justify-content-between">
                                <span>Actions</span>
                                <a href="{{ route('admin_blog_new') }}">
                                    <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;
                                    Ajouter un article
                                </a>
                            </div>

                        </th>
                    </tr>
                </thead>
                <tbody>

                    @forelse ($pages as $p)
                        <tr>
                            <td>
                                <a href="{{ route('admin_blog_edit', ['page' => $p->id]) }}">{{ $p->title }}</a>
                            </td>
                            <td>
                                <a href="{{ route('admin_blog_edit', ['page' => $p->id]) }}">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;
                                    &Eacute;diter
                                </a>
                                &nbsp;
                                <a href="{{ route('admin_blog_delete', ['page' => $p->id]) }}">
                                    <i class="fa fa-trash" aria-hidden="true"></i>&nbsp;
                                    Effacer
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2">
                                Il n'y a pas encore d'article dans le blog
                            </td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2">
                            {!! $pages->links() !!}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
