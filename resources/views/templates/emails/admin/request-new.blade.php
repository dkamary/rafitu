{{-- Payer une réservation --}}

@extends('templates._layouts.email-base')

@section('email_content')
<h1>
    Vous avez reçu une nouvelle requête
</h1>

<p style="margin-top: 15px  ">
    Une demande de réservation avec les informations suivantes a été faite :
</p>
<div style="margin-top: 15px auto;">
    <table style="width: 100%; border: none" border="0">
        <tbody>
            <tr>
                <th>Nom</th>
                <td>{{ $fullname }}</td>
            </tr>
            <tr>
                <th>Adresse email</th>
                <td>{{ $email }}</td>
            </tr>
            <tr>
                <th>Adresse de départ</th>
                <td>{{ $departure_address }}</td>
            </tr>
            <tr>
                <th>Adresse d'arrivée'</th>
                <td>{{ $arrival_address }}</td>
            </tr>
            <tr>
                <th>Date de départ</th>
                <td>{{ $departure_date }}</td>
            </tr>
            <tr>
                <th>Heure de départ</th>
                <td>{{ $departure_time }}</td>
            </tr>
            <tr>
                <th>Nombre de passage</th>
                <td>{{ $passager }}</td>
            </tr>
        </tbody>
    </table>
</div>

<p style="margin-top: 15px">
    Ces critères là non pas été trouvé dans la base de données des trajets.
</p>

@endsection
