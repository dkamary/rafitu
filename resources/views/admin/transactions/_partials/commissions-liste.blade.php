{{-- Commission liste --}}

<table class="table table-stripe table-responsive">
    <thead>
        <tr>
            <th width="15%">
                Date
            </th>
            <th width="30%">
                Trajet
            </th>
            <th width="15%">
                Montant (F CFA)
            </th>
            <th width="20%">
                Destinataire
            </th>
            <th width="10%">
                Type
            </th>
            <th width="10%">
                Statut
            </th>
        </tr>
    </thead>
    <tbody>
    @forelse ($commissions as $com)
        @php
            $ride = $com->getRide();
        @endphp
        <tr>
            <td>
                {{ display_date($com->created_at) }}
            </td>
            <td>
                @if($ride)
                    <u>Départ</u>: <strong>{{ $ride->departure_label }}</strong><br>
                    <u>Arrivée</u>: <strong>{{ $ride->arrival_label }}</strong><br>
                @else
                    N/A
                @endif
            </td>
            <td>
                <u>Chauffeur</u>: <strong>{{ $com->driver_amount }}</strong><br>
                <u>Rafitu</u>: <strong>{{ $com->rafitu_amount }}</strong>
            </td>
            <td>
                <u>Chauffeur</u>: <em>{{ $com->getRideOwnerName() }}</em><br>
                <u>Tél</u>: <a href="tel:{{ $com->destination }}">{{ $com->destination }}</a>
            </td>
            <td>
                {{ $com->commission_type }} ({{ $com->commission }} &percnt;)
            </td>
            <td>
                @if($com->isPaid())
                <span class="badge bg-info">Payé</span>
                @else
                <span class="badge bg-warning">A payer</span>
                @endif
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="6" class="text-center">
                <em>Il n'y a pas encore de commission enregistré</em>
            </td>
        </tr>
    @endforelse
    </tbody>
</table>
