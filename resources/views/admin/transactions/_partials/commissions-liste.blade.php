{{-- Commission liste --}}

<table class="table table-stripe">
    <thead>
        <tr>
            <th>
                Date
            </th>
            <th>
                Montant
            </th>
            <th>
                Destinataire
            </th>
            <th>
                Type
            </th>
            <th>
                Statut
            </th>
        </tr>
    </thead>
    <tbody>
    @forelse ($commissions as $com)
    @php
        $owner = $com->getOwner();
        $date = new \DateTime($com->created_at);
        $paidDate = new \DateTime($com->payed_at);
    @endphp
    <tr>
        <td>
            {{ $date->format('d/m/Y H:i') }}
        </td>
        <td>
            {{ $com->amount }}
        </td>
        <td>
            {{ $owner->getFullname() }}
        </td>
        <td>
            {{ $com->label }}
        </td>
        <td>
            @if ($com->isPaid())
                <span class="text-primary">Payé le {{ $paidDate->date('d/m/Y H:i') }}</span>
            @else
                <span class="text-warning">A payer</span>
            @endif
        </td>
    </tr>
    @empty
        <tr>
            <td colspan="5">
                <em>Il n'y a pas encore de commission enregistré</em>
            </td>
        </tr>
    @endforelse
    </tbody>
</table>
