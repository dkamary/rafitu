{{-- Commission liste --}}

<section class="list__container">
    <header class="row bg-secondary text-white py-3 my-3 d-none d-md-flex">
        <div class="col-1 fw-bold fs-6">Date</div>
        <div class="col-4 fw-bold fs-6">Trajet</div>
        <div class="col-2 fw-bold fs-6">Montant <br>(F CFA)</div>
        <div class="col-2 fw-bold fs-6">Destinataire</div>
        <div class="col-1 fw-bold fs-6">Type</div>
        <div class="col-2 fw-bold fs-6">Statut</div>
    </header>
    <main>
        @forelse ($commissions as $com)
            @php
                $ride = $com->getRide();
            @endphp
            <div @class([
                'bg-light' => $loop->even,
                'border-bottom', 'border-dark',
                'my-5', 'py-2',
                'row',
            ])>
                <div class="col-12 col-md-1 mb-3 mb-md-0">
                    <u class="d-inline-block d-md-none"><strong>Date:</strong></u>&nbsp;
                    {{ display_date($com->created_at) }}
                </div>
                <div class="col-12 col-md-4 mb-3 mb-md-0 d-block align-items-center">
                    <u class="d-inline-block d-md-none"><strong>Trajet:</strong></u><br>
                    @if($ride)
                        <span class="me-5 d-md-none"></span><u>Départ</u>: <strong>{{ $ride->departure_label }}</strong><br>
                        <span class="me-5 d-md-none"></span><u>Arrivée</u>: <strong>{{ $ride->arrival_label }}</strong><br>
                    @else
                        N/A
                    @endif
                </div>
                <div class="col-12 col-md-2 mb-3 mb-md-0">
                    <u class="d-inline-block d-md-none"><strong>Montant (F CFA):</strong></u><br>
                    <span class="me-5 d-md-none"></span><u>Chauffeur</u>: <strong>{{ $com->driver_amount }}</strong><br>
                    <span class="me-5 d-md-none"></span><u>Rafitu</u>: <strong>{{ $com->rafitu_amount }}</strong>
                </div>
                <div class="col-12 col-md-2 mb-3 mb-md-0">
                    <u class="d-inline-block d-md-none"><strong>Destinataire:</strong></u><br>
                    <span class="me-5 d-md-none"></span><u>Chauffeur</u>: <em>{{ $com->getRideOwnerName() }}</em><br>
                    <span class="me-5 d-md-none"></span><u>Tél</u>: <a href="tel:{{ $com->destination }}">{{ $com->destination }}</a>
                </div>
                <div class="col-12 col-md-1 mb-3 mb-md-0 text-start text-md-center d-flex align-items-center">
                    <u class="d-inline-block d-md-none"><strong>Commission:</strong></u>&nbsp;
                    {{ $com->commission_type }} <br class="d-none d-md-block">({{ $com->commission }} &percnt;)
                </div>
                <div class="col-12 col-md-2 mb-3 mb-md-0 text-md-center d-flex align-items-center">
                    <u class="d-inline-block d-md-none"><strong>Statut:</strong></u>&nbsp;
                    @if($com->isPaid())
                        <span class="badge bg-info px-3">Payé</span>
                    @else
                        <span class="badge bg-warning px-3">A payer</span>
                    @endif
                </div>
            </div>
        @empty
            <div class="row my-2 py-2">
                <div class="col-12">
                    <em>Il n'y a pas encore de commission enregistré</em>
                </div>
            </div>
        @endif
    </main>
</section>
