{{-- Détails du trajet --}}

@php
    $isAdmin = $isAdmin ?? false;
@endphp

<table style="width: 100%; border-collapse: collapse" border="0">
    <tbody>
        <tr>
            <th style="font-weight: bold;" width="30%">
                Date de départ
            </th>
            <td style="font-weight: normal;" width="60%">
                {{ $ride->getDepartureDate('d/m/Y H:i') }}
            </td>
        </tr>
        <tr>
            <th style="font-weight: bold;">
                Lieu de départ
            </th>
            <td style="font-weight: normal;">
                {{ $ride->departure_label }}
            </td>
        </tr>
        <tr>
            <th style="font-weight: bold;">
                Lieu d'arrivée
            </th>
            <td style="font-weight: normal;">
                {{ $ride->arrival_label }}
            </td>
        </tr>
        <tr>
            <th style="font-weight: bold;">
                Date d'arrivée
            </th>
            <td style="font-weight: normal;">
                {{ $ride->hasArrivalDate() ? $ride->getArrivalDate('d/m/Y H:i') : 'N/A' }}
            </td>
        </tr>
        <tr>
            <th style="font-weight: bold;">
                Distance
            </th>
            <td style="font-weight: normal;">
                {{ $ride->getDistance() }}
            </td>
        </tr>
        <tr>
            <th style="font-weight: bold;">
                Place disponible
            </th>
            <td style="font-weight: normal;">
                {{ $ride->seats_available }}
            </td>
        </tr>
        <tr>
            <th style="font-weight: bold;">
                Femme seulement ?
            </th>
            <td style="font-weight: normal;">
                {{ $ride->woman_only == 1 ? 'Oui' : 'Non' }}
            </td>
        </tr>
        <tr>
            <th style="font-weight: bold;">
                Fumeurs ?
            </th>
            <td style="font-weight: normal;">
                {{ $ride->smokers == 1 ? 'Oui' : 'Non' }}
            </td>
        </tr>
        <tr>
            <th style="font-weight: bold;">
                Animaux ?
            </th>
            <td style="font-weight: normal;">
                {{ $ride->animals == 1 ? 'Oui' : 'Non' }}
            </td>
        </tr>
        <tr>
            <th style="font-weight: bold;">
                Prix par passager
            </th>
            <td style="font-weight: normal;">
                {{ $ride->price }}F CFA
            </td>
        </tr>
    </tbody>
</table>

@isset($reservation)

    <p style="margin-top: 20px; margin-bottom: 20px;">
        @if($isAdmin)
        Pour voir les détails, <a href="{{ route('dashboard_reservation_show', ['reservation' => $reservation]) }}" style="color: #a22402;">cliquez ici</a>
        @else
        Pour voir les détails, <a href="{{ route('dashboard_reservation_show', ['reservation' => $reservation]) }}" style="color: #0a0a81;">cliquez ici</a>
        @endif
    </p>

@endisset
