{{-- Front office stylesheets --}}

<link rel="icon" href="{{ asset('assets/images/logo/rafitu-icon.png') }}" type="image/png" />
<link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logo/rafitu-icon.png') }}" />

<!-- Bootstrap Css -->
<link id="style" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />

<!-- Dashboard Css -->
<link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/css/dark-style.css') }}" rel="stylesheet" />

<!-- Font-awesome  Css -->
<link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" />

<!--Select2 Plugin -->
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />

<!--  ratings-2 Plugin -->
<link href="{{ asset('assets/plugins/ratings-2/star-rating-svg.css') }}" rel="stylesheet" />

<!-- Cookie css -->
<link href="{{ asset('assets/plugins/cookie/cookie.css') }}" rel="stylesheet">

<!-- Owl Theme css-->
<link href="{{ asset('assets/plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet" />

<!-- p-scroll bar css-->
<link href="{{ asset('assets/plugins/pscrollbar/pscrollbar.css') }}" rel="stylesheet" />

<!-- COLOR-SKINS -->
<link id="theme" rel="stylesheet" type="text/css" media="all"
    href="{{ asset('assets/webslidemenu/color-skins/color10.css') }}" />

<link rel="stylesheet" href="{{ asset('assets/css/frontoffice.css') }}">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@6.6.6/css/flag-icons.min.css" />

<link rel="stylesheet" href="{{ asset('assets/plugins/EasyAutocomplete/easy-autocomplete.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/EasyAutocomplete/easy-autocomplete.themes.min.css') }}">

<style id="footer-styles">
    .footer-payment-list {
        display: flex;
    }

    .footer-payment-list a {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 2px;
        background-color: #fff;
        margin-right: 1.5%;
        margin-bottom: 1.5%;
    }

    .footer-icon-pay {
        height: 2.5rem !important;
        width: auto !important;
        border: none !important;
        transition: .8s;
    }

    .footer-icon-pay:hover {
        transform: scale(1.2);
    }
</style>

<style id="auto-complete-homepage-style">
    .suggestion__container {
        display: none;
        transition: 1s;
        opacity: 0;
        position: absolute;
        padding: 10px;
        background-color: #fff;
        box-shadow: 0px 5px 5px 0px rgba(0, 0, 0, .3);
        z-index: 10000;
        min-width: 300px;
        min-height: 2rem;
        width: auto;
    }

    .suggestion__container.show{
        display: block;
        opacity: 1;
    }

    .suggestion__container.start-search::after {
        content: '';
        display: block;
        position: absolute;
        right: 0px;
        top: 50%;
        transform: translateY(-50%);
        width: 20px;
        height: 16px;
        background-size: cover;
        background-position: center;
        background-image: url({{ asset('images/loader-1.svg') }});
    }

    .suggestion__container ul {
        list-style: none;
    }

    .suggestion__container ul li {
        display: block;
        width: 100%;
        margin-bottom: .8rem;
        border-bottom: solid 1px rgba(0, 0, 0, .3);
    }

    .suggestion__container ul li:last-child {
        border-bottom: none;
    }

    .suggestion__container ul li a {
        display: block;
        width: 100%;
    }
</style>
