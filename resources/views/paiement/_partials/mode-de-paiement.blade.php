{{-- Mode de paiement --}}

<div class="row my-4">
    <div class="col-12">
        <form action="#" class="mode-de-paiement" id="mode-de-paiement">
            <div class="row">
                <div class="col-12">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment" id="payment_cinetpay" checked>
                        <label class="form-check-label" for="payment_cinetpay">
                            CinetPay
                        </label>
                        <div class="mb-4 d-flex justify-content-start align-items-center pay-icons">
                            <img src="{{ asset('logos/Orange_Money-Logo.wine.svg') }}" alt="Orange Money">
                            <img src="{{ asset('logos/mtn-mobile-money-logo.png') }}" alt="MTN Mobile Money">
                            <img src="{{ asset('logos/moov-money.png') }}" alt="MTN Mobile Money">
                        </div>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment" id="payment_paypal">
                        <label class="form-check-label" for="payment_paypal">
                            Paypal
                        </label>

                        <div class="mb-4 d-flex justify-content-start align-items-center pay-icons">
                            <img src="{{ asset('logos/PayPal-Logo.wine.svg') }}" alt="Paypal">
                            <img src="{{ asset('logos/Visa_Inc.-Logo.wine.svg') }}" alt="Visa">
                            <img src="{{ asset('logos/Mastercard-Logo.wine.svg') }}" alt="Mastercard">
                        </div>
                    </div>

                    <div class="row my-4">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary px-3">
                                <i class="fa fa-credit-card" aria-hidden="true"></i>&nbsp;
                                Procéder au paiement
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


<div class="d-none">
    @include('_partials.front.forms.paypal')
    {{-- @include('_partials.front.forms.cinetpay') --}}
</div>


@once

    @push('head')
        <style>
            .pay-icons img {
                height: 1.5rem;
                width: auto;
                margin-right: 8px;
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
                            alert('Cinetpay!!!');
                        }
                    });
                }
            });
        </script>
    @endpush

@endonce
