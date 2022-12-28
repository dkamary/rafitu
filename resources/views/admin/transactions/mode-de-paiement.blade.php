{{-- Mode de paiement --}}
@extends('_layouts.back')

@php
    $page_title = 'Commissions';
@endphp

@section('meta_title')
    {{ $page_title }}
@endsection

@section('main')

    @include('_partials.back.section.breadcrumbs', ['page_title' => $page_title,])

    @include('_partials.back.notifications.flash-message')

    <div class="bg-white py-4 px-2">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="cinetpay-tab" data-bs-toggle="tab" data-bs-target="#cinetpay" type="button"
                    role="tab" aria-controls="cinetpay" aria-selected="true">
                    <img src="{{ asset('logos/cinetpay.png') }}" alt="..." style="height: 2.5rem; width: auto;">&nbsp;
                    <span class="fs-6">Cinetpay</span>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="paypal-tab" data-bs-toggle="tab" data-bs-target="#paypal" type="button"
                    role="tab" aria-controls="paypal" aria-selected="false">
                    <img src="{{ asset('logos/PayPal-Logo.wine.svg') }}" alt="..." style="height: 2.5rem; width: auto;">&nbsp;
                    <span class="fs-6">Paypal</span>
                </button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show py-4 px-2 active" id="cinetpay" role="tabpanel" aria-labelledby="cinetpay-tab">
                @include('admin.transactions.form.parameter-cinetpay', ['parameter' => $parameter])
            </div>
            <div class="tab-pane fade py-4 px-2" id="paypal" role="tabpanel" aria-labelledby="paypal-tab">
                @include('admin.transactions.form.parameter-paypal', ['parameter' => $parameter])
            </div>
        </div>
    </div>

@endsection
