{{-- Overview --}}

<div class="row">

    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3 ">
        <div class="card overflow-hidden border border-primary">
            <div class="card-header bg-primary">
                <h3 class="card-title text-white fw-bold">Réservations</h3>
                {{-- <div class="card-options"> <a class="btn btn-sm btn-primary" href="#">Voir</a> </div> --}}
            </div>
            <div class="card-body ">
                <h5 class="">Impayées</h5>
                <h2 class="text-dark  mt-0 ">{{ DashboardManager::reservationImpayees() }}</h2>
                <h5 class="">Payées</h5>
                <h2 class="text-dark  mt-0 ">{{ DashboardManager::reservationPayees() }}</h2>
                {{--
                    <div class="progress progress-sm mt-0 mb-2">
                        <div class="progress-bar bg-primary" style="width: 75%;" role="progressbar"></div>
                    </div>
                    <div class=""><i class="fa fa-caret-up text-green"></i>10% increases</div>
                --}}
            </div>
        </div>
    </div>

    <div class=" col-sm-12 col-md-6 col-lg-6 col-xl-3">
        <div class="card overflow-hidden border border-info">
            <div class="card-header bg-info">
                <h3 class="card-title text-white fw-bold">Commissions</h3>
                {{-- <div class="card-options"> <a class="btn btn-sm btn-secondary" href="#">VOir</a> </div> --}}
            </div>
            <div class="card-body ">
                <h5 class="">Impayées</h5>
                <h2 class="text-dark  mt-0 ">{{ DashboardManager::commissionImpayees() }}F CFA</h2>
                <h5 class="">Payées</h5>
                <h2 class="text-dark  mt-0 ">{{ DashboardManager::commissionPayes() }}F CFA</h2>
                {{--
                <div class="progress progress-sm mt-0 mb-2">
                    <div class="progress-bar bg-secondary" style="width: 45%;" role="progressbar"></div>
                </div>
                <div class=""><i class="fa fa-caret-down text-danger"></i>12% decrease</div>
                --}}
            </div>
        </div>
    </div>

    <div class=" col-sm-12 col-md-6 col-lg-6 col-xl-3">
        <div class="card overflow-hidden border border-orange">
            <div class="card-header bg-orange">
                <h3 class="card-title text-white fw-bold">Trajets</h3>
                {{-- <div class="card-options"> <a class="btn btn-sm btn-warning" href="#">View</a> </div> --}}
            </div>
            <div class="card-body ">
                <h5 class="">Long trajets</h5>
                <h2 class="text-dark  mt-0 ">{{ DashboardManager::trajetsLong() }}</h2>
                <h5 class="">Trajets quotidien</h5>
                <h2 class="text-dark  mt-0 ">{{ DashboardManager::trajetsQuotidien() }}</h2>
                {{--
                <div class="progress progress-sm mt-0 mb-2">
                    <div class="progress-bar bg-warning" style="width: 50%;" role="progressbar"></div>
                </div>
                <div class=""><i class="fa fa-caret-down text-danger"></i>5% decrease</div>
                --}}
            </div>
        </div>
    </div>

    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3 ">
        <div class="card overflow-hidden border border-secondary">
            <div class="card-header bg-secondary">
                <h3 class="card-title text-white fw-bold">Chauffeurs</h3>
                {{-- <div class="card-options"> <a class="btn btn-sm btn-success" href="#">View</a> </div> --}}
            </div>
            <div class="card-body ">
                <h5 class="">A valider</h5>
                <h2 class="text-dark  mt-0  ">{{ DashboardManager::chauffeursAvalider() }}</h2>
                <h5 class="">Validés</h5>
                <h2 class="text-dark  mt-0  ">{{ DashboardManager::chauffeursValidees() }}</h2>
            </div>
        </div>
    </div>

</div>

@once
    @push('head')
        <style id="overview-script">
            .border-orange {
                border: solid #e67605 1px !important;
            }
        </style>
    @endpush
@endonce
