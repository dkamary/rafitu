{{-- CinetPay form --}}

@extends('_layouts.front')

@php
    // $ride = $reservation->getRide();
    // $rideOptions = [
    //     'ride' => $ride,
    //     'loop' => json_decode('{"even": "false"}'),
    //     'showPrice' => false,
    //     'showDetails' => false,
    //     // 'showDate' => false,
    //     'showDistance' => true,
    // ];
    // $user = Auth::user();
    // $driver = $ride->getDriver();
@endphp

@section('meta_title')
    CinetPay
@endsection

@section('hero')
    @include('_partials.front.section.breadcrumbs', ['page_title' => 'CinetPay'])
@endsection

@section('main')
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-8 col-lg-6 mx-auto bg-white my-5 py-3">

                <div class="row">
                    <div class="col-12 py-5">
                        {!! $form !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
