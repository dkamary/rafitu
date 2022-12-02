{{-- Add ride - Step 1 --}}

@php
    $tomorrow = date('d/m/Y 08:00', strtotime('tomorrow'));
@endphp

<div class="tab-pane fade" id="first">
    <div class="control-group form-group">
        <div class="form-group">
            <label class="form-label text-dark">Départ</label>
            <input type="text" name="departure_label" id="departure_label" required
                class="form-control required Title place" placeholder="D'où partez-vous?">
            <input type="hidden" name="departure_lng" id="departure_lng" value="">
            <input type="hidden" name="departure_lat" id="departure_lat" value="">
        </div>
    </div>
    <div class="control-group form-group">
        <label class="form-label text-dark">Définir l'emplacement</label>
        <div class="mini-map" id="departure_map"></div>
    </div>
    <div class="control-group form-group">
        <div class="form-group">
            <label class="form-label text-dark">Date et heure de départ</label>
            <input type="datetime-local" name="departure_date" id="departure_date" class="form-control required Title"
            value="{{ $tomorrow }}" required
                placeholder="dd/mm/aaaa hh:mm">
        </div>
    </div>
    <div class="control-group form-group">
        <div class="text-end">
            <a href="#second" id="next-2" data-bs-toggle="tab" class="btn btn-primary  mb-0 waves-effect waves-light">
                <i class="fa fa-arrow-right" aria-hidden="true"></i>&nbsp;
                Continuer
            </a>
        </div>
    </div>
</div>

@once
    @push('footer')
        <script>
            window.addEventListener('DOMContentLoaded', event => {
                console.debug("Step 1");

                const next2 = document.querySelector('#next-2');
                if(!next2) {
                    console.warn('Unable to select #next-2!');

                    return;
                }

                next2.addEventListener('click', e => {
                    e.preventDefault();
                    const departureLabel = document.querySelector('#departure_label');
                    if(!departureLabel) {
                        console.warn('Unable to select #departure_label!!!');
                        return;
                    }

                    if(departureLabel.value.trim().length == 0) {
                        alert('Veuillez mettre le nom dans l\'emplacement de départ s\'il vous plaît');
                        return;
                    }

                    const departureDate = document.querySelector('#departure_date');
                    if(!departureDate) {
                        console.warn('Unable to select #departure_date!!!');
                        return;
                    }
                    if(departureDate.value.trim().length == 0) {
                        alert('Veuillez mettre la date de départ s\'il vous plaît');
                        return;
                    }

                    const departure_lng = document.querySelector('#departure_lng');
                    const departure_lat = document.querySelector('#departure_lat');
                    if(departure_lng.value.length = 0 || departure_lat.value.length == 0) {
                        alert('Veuillez sélectionner un point géographique sur la carte s\'il vous plaît!');
                        return;
                    }

                    const arrive = document.querySelector('#arrive');
                    arrive.click();
                });
            });
        </script>
    @endpush
@endonce
