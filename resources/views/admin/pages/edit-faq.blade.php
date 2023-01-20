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

    <div class="row py-5 bg-white">
        <div class="col-12">
            <table class="table condensed table-striped" id="faq-table">
                <thead>
                    <tr>
                        <th>Question</th>
                        <th>Réponses</th>
                        <th class="text-center">Rang</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($faq as $row)
                        <tr id="faq-{{ $row->id }}">
                            <td id="question-{{ $row->id }}">{{ $row->question }}</td>
                            <td id="answer-{{ $row->id }}">{{ $row->answer }}</td>
                            <td id="rank-{{ $row->id }}" class="text-center">{{ $row->rank }}</td>
                            <td>
                                <div class="d-flex justify-content-start">
                                    <a href="#" class="faq-edit mx-1" data-id="{{ $row->id }}" data-bs-toggle="modal" data-bs-target="#faq-modal" onclick="showModal({ id: {{ $row->id }} });">
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

    <!-- Modal -->
    <div class="modal fade" id="faq-modal" tabindex="-1" aria-labelledby="faq-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="faq-modalLabel">Edition du FAQ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="{{ route('admin_faq_save') }}" method="post" id="faq-edit-form">
                    <div class="mb-3">
                        <label for="question" class="form-label">Question</label>
                        <input type="text" class="form-control" name="question" id="question" placeholder="La question" value="">
                    </div>
                    <div class="mb-3">
                        <label for="answer" class="form-label">Réponse</label>
                        <textarea name="answer" id="answer" class="form-control" placeholder="La réponse" rows="5"></textarea>
                    </div>
                    <div class="mb-3 w-25">
                        <label for="rank" class="form-label">Position</label>
                        <input type="number" class="form-control" name="rank" id="rank" min="1" max="255" value="">
                    </div>
                    <div class="mb-3">
                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;
                                {{ $button_label ?? 'Enregistrer' }}
                            </button>
                        </div>
                    </div>
                    <input type="hidden" id="token" name="_token" value="">
                    <input type="hidden" id="id" name="id" value="">
                </form>

            </div>
            {{-- <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                <i class="fa fa-times" aria-hidden="true"></i>&nbsp;
                Annuler
            </button>
            <button type="button" class="btn btn-primary">
                <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;
                Enregistrer
            </button>
            </div> --}}
        </div>
        </div>
    </div>
@endsection

@once
    @push('footer')
        <script defer>
            // FAQ Script

            window.addEventListener("DOMContentLoaded", event => {
                console.debug("faq.js - DOMContentLoaded");
                const removers = document.querySelectorAll('.faq-delete');
                if(removers) {
                    removers.entries(link => {
                        link.addEventListener("click", e => {
                            if(!confirm("Voulez-vous effacer cette question et sa réponse?")) {
                                e.preventDefault();

                                return false;
                            }
                        });
                    });
                }
            });

            const saveFAQ = ({ formId }) => {
                console.debug("calling SaveFAQ!");

                const form = document.querySelector(formId);
                if (!form) {
                    console.debug("`%s` form not found", formId);

                    return false;
                }

                fetch(form.action, {
                    body: new FormData(form),
                    method: "POST",
                    mode: "cors",
                    cache: "no-cache"
                }).then(response => {
                    return response.json();
                }).then(response => {
                    if (response.done) {
                        if(response.insert) insertTable({ faq: response.faq, message: response.message });
                        else if(response.update) updateTable({ faq: response.faq, message: response.message });
                    }
                }).catch(err => {
                    console.error(err);
                });

                return false;
            };

            const insertTable = ({ faq, message }) => {
                window.location.reload();

                return false;

                // Récupération de la table
                const table = document.querySelector('#faq-table');
                // SI la table n'existe pas alors on sort de la fonction
                if(!table) {
                    console.debug("La table des FAQ n'a pas été trouvé!!!");
                    return false;
                }
                // Si la table existe alors il faut cacher le #faq-empty (display none)
                const emptyRow = document.querySelector("#faq-empty");
                if(emptyRow) {
                    emptyRow.style.display = "none";
                }
                // Créer le TR avec un ID
                const tr = document.createElement('tr');
                tr.id = `faq-${faq.id}`;
                // Créer les TD question, answer, rank et action
                const question = document.createElement('td');
                question.id = `question-${faq.id}`;
                question.innerHTML = faq.question;
                tr.appendChild(question);

                const answer = document.createElement('td');
                answer.id = `answer-${faq.id}`;
                answer.innerHTML = faq.answer;
                tr.appendChild(answer);
                // Ajouter les informations dans les TD
                // Créer lien éditions et Suppression
                // Insérer les TD dans le TR, TR dans Table > TBODY
            };

            const updateTable = ({ faq, message }) => {
                window.location.reload();

                return false;

                const table = document.querySelector('#faq-table');
                if(!table) {
                    console.debug("FAQ Table not found!");

                    return;
                }

                // METTRE à jour la table
            };

            const showModal = ({ id, url }) => {
                // Afficher un BS Modal avec un formulaire d'édition
                // Récupérer les informations du FAQ via un fetch
                const $ = window.jQuery;
                $.ajax({
                    type: 'post',
                    url: "{{ route('admin_faq_info') }}",
                    data: {
                        id,
                        _token: "{{ csrf_token() }}"
                    }
                }).done(response => {
                    if(response.done) {
                        const faq = response.faq;
                        const form = document.querySelector("#faq-edit-form");
                        const id = form.querySelector("#id");
                        const question = form.querySelector("#question");
                        const answer = form.querySelector("#answer");
                        const rank = form.querySelector("#rank");
                        const token = form.querySelector("#token");

                        if(id) {
                            id.value = faq.id;
                        }

                        if(question) {
                            question.value = faq.question;
                        }

                        if(answer) {
                            answer.value = faq.answer;
                        }

                        if(rank) {
                            rank.value = faq.rank;
                        }

                        if(token) {
                            token.value = response.token;
                        }
                    }
                })
                .fail(xhr => alert(`${xhr.status} - ${xhr.statusText}`))
                .always(() => {});
                // Une fois les données reçues, remplir les inputs
            };

            const updateFaq = (formId) => {
                saveFAQ(formId);
                // Cacher le BS Modal
            };

        </script>
    @endpush
@endonce
