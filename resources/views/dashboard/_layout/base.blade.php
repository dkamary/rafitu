{{-- Espace client --}}

@extends('_layouts.front')

@section('main')
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-4 py-3">
                <div class="card border-dark">
                    <div class="card-header bg-dark">
                        <h2 class="card-title fs-4 text-light my-0">Menu</h2>
                    </div>
                    <div class="card-body px-0 py-2">
                        @yield('dashboard_menu', view('dashboard._partials.menu'))
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-8 py-3">
                <div class="card border-dark">
                    <div class="card-body">
                        @yield('dashboard_content')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
