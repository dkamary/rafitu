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
                                <div class="d-flex justify-content-start">
                                    <a href="#" class="faq-edit mx-1" data-id="{{ $row->id }}" data-bs-toggle="modal" data-bs-target="#faq-modal">
                                        &Eacute;diter
                                    </a>
                                    <a href="{{ route('admin_faq_remove', ['faq' => $row]) }}" class="faq-delete mx-1" data-id="{{ $row->id }}">
                                        Supprimer
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
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
                            <div class="row">
                                <div class="col-12 col-md-6 mx-auto">
                                    <div class="pt-0 pb-3 px-3 border border-secondary rounded">
                                        <div class="row">
                                            <div class="col-12 text-center text-center bg-dark text-white py-2">
                                                <h3>Nouveau FAQ</h3>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 pt-3">
                                                @include('admin.forms.faq', ['faq' => Faq::emptyFaq(), 'button_label' => 'Ajouter'])
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
