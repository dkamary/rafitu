{{-- Espace client --}}

@extends('_layouts.front')

@section('main')
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-4 py-3">
                <div class="card">
                    <div class="card-body">
                        @yield('dashboard_menu', view('dashboard._partials.menu'))
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-8 py-3">
                <div class="card">
                    <div class="card-body">
                        @yield('dashboard_content')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
