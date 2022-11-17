{{-- Edit Page : Text only --}}

@extends('_layouts.back')

@section('meta_title')
    {{ $page->title }}
@endsection

@section('main')
    @include('_partials.back.section.breadcrumbs', [
        'page_title' => $page->title,
        'page_parents' => [
            ['route' => 'pages_index', 'text' => 'Pages'],
        ]
    ])

    <div class="row">
        <div class="col-12 col-md-6 mx-auto">
            @include('_partials.back.notifications.flash-message')
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            @include('admin.forms.page-edit-text', ['user' => $user, 'route' => $route])
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <table class="table condensed table-striped" id="faq-table">
                <thead>
                    <tr>
                        <th>Question</th>
                        <th>Réponses</th>
                        <th>Rang</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($faq as $row)
                        <tr id="faq-{{ $row->id }}">
                            <td id="question-{{ $row->id }}">{{ $row->question }}</td>
                            <td id="answer-{{ $row->id }}">{{ $row->answer }}</td>
                            <td id="rank-{{ $row->id }}">{{ $row->rank }}</td>
                            <td>
                                <a href="#" class="faq-edit" data-id="{{ $row->id }}">
                                    &Eacute;diter
                                </a>
                                <a href="#" class="faq-delete" data-id="{{ $row->id }}">
                                    Supprimer
                                </a>
                            </td>
                        </tr>
                    @else
                        <tr id="faq-empty">
                            <td colspan="4" class="text-center">
                                La section est encore vide
                            </td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4">
                            Ajouter
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection

@once
    @push('footer')
        <script defer async src="{{ asset('assets/js/faq.js') }}"></script>
    @endpush
@endonce
