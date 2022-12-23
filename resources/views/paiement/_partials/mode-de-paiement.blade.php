{{-- Mode de paiement --}}

<div class="row my-4">
    <h3 class="fw-bold fs-4 mb-5">Choisir le mode de paiement</h3>
    <div class="col-12">
        <form action="#" class="mode-de-paiement" id="mode-de-paiement">
            <div class="row">
                <div class="col">
                    <div class="form-check ps-8">
                        <input class="form-check-input" type="radio" name="payment" id="payment_cinetpay" checked>
                        <label class="form-check-label" for="payment_cinetpay">
                            <h2 class="fw-bold fs-5">CinetPay</h2>
                        </label>
                        <div class="mb-4 d-flex justify-content-start align-items-center pay-icons">
                            <img src="{{ asset('logos/Orange_Money-Logo.wine.svg') }}" alt="Orange Money">
                            <img src="{{ asset('logos/mtn-mobile-money-logo.png') }}" alt="MTN Mobile Money">
                            <img src="{{ asset('logos/moov-money.png') }}" alt="MTN Mobile Money">
                        </div>
                    </div>
                    <div class="form-check ps-8">
                        <input class="form-check-input" type="radio" name="payment" id="payment_paypal">
                        <label class="form-check-label" for="payment_paypal">
                            <h2 class="fw-bold fs-5">Paypal</h2>
                        </label>

                        <div class="mb-4 d-flex justify-content-start align-items-center pay-icons">
                            {{-- <img src="{{ asset('logos/PayPal-Logo.wine.svg') }}" alt="Paypal"> --}}
                            <img src="{{ asset('logos/Visa_Inc.-Logo.wine.svg') }}" alt="Visa">
                            <img src="{{ asset('logos/Mastercard-Logo.wine.svg') }}" alt="Mastercard">
                        </div>
                    </div>

                    <hr>

                    <div class="row my-4">
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary px-3">
                                <i class="fa fa-credit-card" aria-hidden="true"></i>&nbsp;
                                Procéder au paiement de <br>
                                <strong>{{ $reservation->passenger * $reservation->price }}F CFA</strong>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


<div class="d-none" style="display: none;">
    @include('_partials.front.forms.paypal')
    @include('_partials.front.forms.cinetpay')
</div>


@once

    @push('head')
        <style>
            .pay-icons img {
                height: 3rem;
                width: auto;
                margin-right: 8px;
            }
        </style>
        <style>
            .sdk {
                display: block;
                position: absolute;
                background-position: center;
                text-align: center;
                left: 50%;
                top: 50%;
                transform: translate(-50%, -50%);
            }
        </style>
    @endpush

    @push('footer')
        <script defer>
            window.addEventListener("DOMContentLoaded", event => {
                const form = document.querySelector('#mode-de-paiement');
                if(form) {
                    form.addEventListener("submit", e => {
                        e.preventDefault();
                        const paypalPay = document.querySelector('#payment_paypal');
                        const cinetPay = document.querySelector('#payment_cinetpay');

                        if(paypalPay.checked) {
                            document.querySelector('#paypal-form').submit();
                            return;
                        }

                        if(cinetPay.checked) {
                            document.querySelector('#cinetpay-form').submit();
                        }
                    });
                }
            });
        </script>
    @endpush

@endonce
