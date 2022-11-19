{{-- Booking Form --}}

<form action="#" class="form booking-form" method="POST">

    <div class="row">
        <div class="col-12 col-md-6">
            <div class="my-3">
                <input type="text" name="fullname" id="fullname" class="form-control rounded-pill" placeholder="Votre nom" value="" required>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="my-3">
                <input type="email" name="email" id="email" class="form-control rounded-pill" placeholder="Adresse e-mail" value="" required>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-6">
            <div class="my-3">
                <input type="number" name="passager" id="passager" class="form-control rounded-pill" placeholder="Passager" value="" required min="1" max="6">
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="my-3">
                <input type="text" name="arrival_address" id="arrival_address" class="form-control rounded-pill" placeholder="Adresse d'arrivée" value="" required>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-6">
            <div class="my-3">
                <input type="text" name="departure_address" id="departure_address" class="form-control rounded-pill" placeholder="Adresse de départ" value="" required>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="my-3 input-group">
                <input type="date" name="departure_date" id="departure_date" class="form-control rounded-pill" placeholder="Date de départ" value="" required>
                <span class="input-group-text" id="departure_date_icon">
                    <i class="fa fa-calendar-o" aria-hidden="true"></i>
                </span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-6">
            <div class="my-3 input-group">
                <input type="time" name="time" id="departure_time" class="form-control rounded-pill" placeholder="Heure de départ" value="" required  aria-label="Heure de départ" aria-describedby="departure_time_icon">
                <span class="input-group-text" id="basic-addon2">
                    <i class="fa fa-clock-o" aria-hidden="true"></i>
                </span>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="my-3">
                <button type="submit" class="btn btn-warning btn-block rounded-pill">
                    Réserver maintenant
                </button>
            </div>
        </div>
    </div>

</form>