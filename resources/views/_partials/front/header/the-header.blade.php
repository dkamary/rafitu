{{-- Top bar --}}

@php
    $topbar = $topbar ?? false;
@endphp

<!--Topbar-->
<div class="header-main">
    @includeWhen($topbar, '_partials.front.header.top-bar')

    @include('_partials.front.header.mobile-header')

    @include('_partials.front.header.main-navigation')
</div>
