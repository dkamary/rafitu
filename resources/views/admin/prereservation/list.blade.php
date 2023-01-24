{{-- Préservation List --}}
<section class="list__container">
    <header class="list__header row bg-secondary text-white mx-0 py-3 mt-3 d-none d-md-flex">
        <div class="col-2 col-md-1 d-none d-md-flex">#</div>
        <div class="col-10 col-md-3 mr-auto">Départ</div>
        <div class="col-10 col-md-3 mr-auto">Arrivée</div>
        <div class="col-10 col-md-3 mr-auto">Nom</div>
        <div class="col-10 col-md-2 mr-auto">Actions</div>
    </header>
    <main class="list__main">
        @forelse ($list as $preres)
            <div @class([
                'row', 'border-bottom', 'py-2', 'mx-0',
                'bg-light' => $loop->even,
            ])>
                <div class="col-2 col-md-1 d-none d-md-flex">
                    {{ $preres->id }}
                </div>
                <div class="col-10 col-md-3 mr-auto">
                    <u class="fw-bold d-inline-block d-md-none me-1">Départ: </u>{{ $preres->departure_label }}
                </div>
                <div class="col-10 col-md-3 mr-auto">
                    <u class="fw-bold d-inline-block d-md-none me-1">Arrivée: </u>{{ $preres->arrival_label }}
                </div>
                <div class="col-10 col-md-3 mr-auto">
                    <u class="fw-bold d-inline-block d-md-none me-1">Nom: </u>{{ $preres->fullname }}
                </div>
                <div class="col-10 col-md-2 mr-auto">
                    <a href="{{ route('admin_prereservation_edit', ['prereservation' => $preres->id]) }}" class="btn btn-outline-info">
                        <i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;
                        Editer
                    </a>
                </div>
            </div>
        @empty
            <div class="row mx-0">
                <div class="col-12">
                    <em>Aucune pré-réservation trouvée</em>
                </div>
            </div>
        @endforelse
    </main>
    <footer class="list__footer row mx-0"></footer>
</section>
