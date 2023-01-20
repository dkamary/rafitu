{{-- Admin Ride list --}}

@extends('_layouts.back')

@section('meta_title')
    Trajets
@endsection

@section('main')
    @include('_partials.back.section.breadcrumbs', ['page_title' => 'Trajets'])

    @include('_partials.back.notifications.flash-message')

    <div class="row">
        <div class="col-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th width="5%" class="text-center">#</th>
                        <th width="35%" class="text-start">Trajet</th>
                        <th width="20%" class="text-center">Date de départ</th>
                        <th width="20%" class="text-center">Statut</th>
                        <th width="20%" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse ($rides as $ride)
                        <tr id="ride-{{ $ride->id }}">
                            <td>
                                {{ $ride->id }}
                            </td>
                            <td>
                                <p class="mb-1">
                                    <strong>Départ :</strong>
                                    <em>{{ $ride->departure_label }}</em>
                                </p>
                                <p class="mb-1">
                                    <strong>Arrivée :</strong>
                                    <em>{{ $ride->arrival_label }}</em>
                                </p>
                            </td>
                            <td class="text-center">
                                {{ display_date($ride->departure_date, 'H:i') }}
                            </td>
                            <td class="text-center">
                                <strong @class([
                                    'text-success' => $ride->ride_status_id == 1,
                                    'text-info' => $ride->ride_status_id == 2,
                                    'text-danger' => $ride->ride_status_id == 4,
                                    'text-warning' => $ride->ride_status_id == 5
                                ])>
                                    {{ ride_status($ride->ride_status_id) }}
                                </strong>
                            </td>
                            <td>
                                <div class="d-flex flex-wrap justify-content-center align-items-center">
                                    <a href="{{ route('admin_ride_show', ['ride' => $ride->id]) }}" class="btn btn-outline-info me-1">
                                        <i class="fa fa-check-square-o" aria-hidden="true"></i>&nbsp;
                                        Voir
                                    </a>

                                    @if ($ride->isToValidate())
                                    <form action="{{ route('admin_ride_validate') }}" method="post" class="validate-ride-form ms-1">
                                        <button type="submit" class="btn btn-outline-dark">
                                            <i class="fa fa-check-square-o" aria-hidden="true"></i>&nbsp;
                                            Valider
                                        </button>
                                        <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" id="id" name="id" value="{{ $ride->id }}">
                                    </form>
                                    @endif

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                Il n'y a pas encore de trajet dans la base de données.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5">
                            <div class="d-flex w-100 flex-wrap justify-content-center align-items-center">
                                {!! $rides->links() !!}
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
        <script>
            window.addEventListener("DOMContentLoaded", event => {
                const validateForms = document.querySelectorAll(".validate-ride-form");
                if(validateForms && validateForms.length) {
                    validateForms.forEach(form => {
                        form.addEventListener("submit", e => {
                            e.preventDefault();
                            if(!confirm("Voulez-vous valider ce trajet ?")) return;

                            const id = form.querySelector("#id");
                            const token = form.querySelector('#token');
                            const status = 1;

                            const $ = window.jQuery;
                            $.ajax({
                                type: 'post',
                                url: form.action,
                                data: {
                                    id: id.value,
                                    token: token.value,
                                    ride_status_id: status
                                }
                            })
                            .done(response => {
                                if(response.done) {
                                    window.location.reload();
                                } else {
                                    alert(response.message);
                                }
                            })
                            .fail(xhr => {
                                alert(`${xhr.status} - ${xhr.statusText}`);
                            })
                            ;
                        })
                    });
                }
            });
        </script>
    @endpush

@endonce
