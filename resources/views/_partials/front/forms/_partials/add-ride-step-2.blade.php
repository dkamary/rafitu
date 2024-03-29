{{-- Add Ride - Step 2 --}}

<div class="tab-pane fade" id="second">
    <div class="control-group form-group">
        <div class="form-group">
            <label class="form-label text-dark">Arrivée</label>
            <input type="text" name="arrival_label" id="arrival_label" required
                class="form-control required Title place" placeholder="Où voulez-vous allez?">
            <input type="hidden" name="arrival_lng" id="arrival_lng" value="">
            <input type="hidden" name="arrival_lat" id="arrival_lat" value="">
        </div>
    </div>
    <div class="control-group form-group">
        <div class="mini-map" id="arrival_map"></div>
    </div>
    <div class="control-group form-group d-none">
        <div class="form-group">
            <label class="form-label text-dark">Date et heure d'arrivée</label>
            <input type="datetime-local" name="arrival_date" class="form-control required Title"
                placeholder="">
        </div>
    </div>
    <div class="control-group form-group">
        <div class="d-flex justify-content-between">
            <a href="#second" data-bs-toggle="tab" class="btn btn-secondary bg-dark  mb-0 waves-effect waves-light border-secondary" onclick="document.querySelector('#depart').click();">
                <i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;
                Revenir
            </a>
            <a href="#itineraire" id="next-3" data-bs-toggle="tab" class="btn btn-primary  mb-0 waves-effect waves-light">
                Continuer&nbsp;
                <i class="fa fa-arrow-right" aria-hidden="true"></i>
            </a>
        </div>
    </div>
</div>

@once
    @push('footer')
        <script>
            window.addEventListener('DOMContentLoaded', event => {

                console.debug("Step 2");

                const next3 = document.querySelector('#next-3');
                if(!next3) {
                    console.warn('Unable to select #next-3!');

                    return;
                }

                next3.addEventListener('click', e => {
                    e.preventDefault();
                    const arrivalLabel = document.querySelector('#arrival_label');
                    if(!arrivalLabel) {
                        console.warn('Unable to select #arrival_label!!!');
                    }
                    if(arrivalLabel.value.trim().length == 0) {
                        alert('Veuillez mettre le nom dans l\'emplacement d\'arrivée s\'il vous plaît');
                        return;
                    }

                    const arrival_lng = document.querySelector('#arrival_lng');
                    const arrival_lat = document.querySelector('#arrival_lat');
                    if(arrival_lng.value.length = 0 || arrival_lat.value.length == 0) {
                        alert('Veuillez sélectionner un point géographique sur la carte s\'il vous plaît!');
                        return;
                    }

                    const arrive = document.querySelector('#itineraire');
                    arrive.click();
                });
            });
        </script>
    @endpush
@endonce
