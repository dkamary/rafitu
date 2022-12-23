{{-- payment choice --}}

@php
    $buttonOnly = $buttonOnly ?? false;
@endphp

@if($buttonOnly)
<!-- Button trigger modal -->
<button type="button" class="{{ $btn_classes ?? 'btn btn-primary' }}" data-bs-toggle="modal" data-bs-target="#paymentModal">
    @if(isset($btn_icon))
        {!! $btn_icon !!}
    @else
        <i class="fa fa-credit-card" aria-hidden="true"></i>
    @endif
    &nbsp;
    {{ $btn_text ?? 'Procéder au paiement' }}
</button>
@else
<div class="row">
    <div class="col-12 text-center">
        <!-- Button trigger modal -->
        <button type="button" class="{{ $btn_classes ?? 'btn btn-primary' }}" data-bs-toggle="modal" data-bs-target="#paymentModal">
            @if(isset($btn_icon))
                {!! $btn_icon !!}
            @else
                <i class="fa fa-credit-card" aria-hidden="true"></i>
            @endif
            &nbsp;
            {{ $btn_text ?? 'Procéder au paiement' }}
        </button>
    </div>
</div>
@endif

<!-- Modal -->
<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentModalLabel">Mode de paiement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row my-4">
                    <div class="col-12">
                        Veuillez sélectionner votre méthode payement
                    </div>
                </div>
                <div class="row my-4">
                    <div class="col-6">

                        @include('_partials.front.forms.paypal', [
                            'btn_text' => '<i class="fa fa-paypal" aria-hidden="true"></i>&nbsp;Paypal',
                            'btn_classes' => 'btn btn-primary btn-block',
                            'reservation' => $reservation,
                            ])
                        <div class="row my-2">
                            <div class="col-12 d-flex justify-content-center align-items-center icon-payment">
                                <img src="{{ asset('logos/PayPal-Logo.wine.svg') }}" alt="Paypal">
                                <img src="{{ asset('logos/Visa_Inc.-Logo.wine.svg') }}" alt="Visa">
                                <img src="{{ asset('logos/Mastercard-Logo.wine.svg') }}" alt="Mastercard">
                            </div>
                        </div>

                    </div>
                    <div class="col-6">

                        @include('_partials.front.forms.cinetpay', [
                            'btn_text' => '<i class="fa fa-mobile" aria-hidden="true"></i>&nbsp;CinetPay',
                            'btn_classes' => 'btn btn-info btn-block',
                            'reservation' => $reservation,
                            ])
                        <div class="row my-2">
                            <div class="col-12 d-flex justify-content-center align-items-center icon-payment">
                                <img src="{{ asset('logos/Orange_Money-Logo.wine.svg') }}" alt="Orange Money">
                                <img src="{{ asset('logos/mtn-mobile-money-logo.png') }}" alt="MTN Mobile Money">
                                <img src="{{ asset('logos/moov-money.png') }}" alt="MTN Mobile Money">
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
