{{-- Front office JavaScripts --}}

<!-- JQuery js-->
<script src="{{ asset('assets/js/jquery.js') }}"></script>

<!-- Bootstrap js -->
<script src="{{ asset('assets/plugins/bootstrap/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

<!--JQuery Sparkline Js-->
<script src="{{ asset('assets/js/vendors/jquery.sparkline.min.js') }}"></script>

<!-- Circle Progress Js-->
<script src="{{ asset('assets/js/vendors/circle-progress.min.js') }}"></script>

<!-- Star Rating-2 Js-->
<script src="{{ asset('assets/plugins/ratings-2/jquery.star-rating.js') }}"></script>
<script src="{{ asset('assets/plugins/ratings-2/star-rating.js') }}"></script>

<!--Counters -->
<script src="{{ asset('assets/plugins/counters/counterup.min.js') }}"></script>
<script src="{{ asset('assets/plugins/counters/waypoints.min.js') }}"></script>
<script src="{{ asset('assets/plugins/counters/numeric-counter.js') }}"></script>

<!--Owl Carousel js -->
<script src="{{ asset('assets/plugins/owl-carousel/owl.carousel.js') }}"></script>
<script src="{{ asset('assets/js/owl-carousel.js') }}"></script>

<!--Horizontal Menu-->
<script src="{{ asset('assets/plugins/Horizontal2/Horizontal-menu/horizontal.js') }}"></script>

<!--JQuery TouchSwipe js-->
<script src="{{ asset('assets/js/jquery.touchSwipe.min.js') }}"></script>

<!--Select2 js -->
<script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/js/select2.js') }}"></script>

<!-- sticky Js-->
<script src="{{ asset('assets/js/sticky.js') }}"></script>
<script src="{{ asset('assets/js/custom-sticky.js') }}"></script>

<!-- Cookie js -->
<script src="{{ asset('assets/plugins/cookie/jquery.ihavecookies.js') }}"></script>
<script src="{{ asset('assets/plugins/cookie/cookie.js') }}"></script>

<!-- p-scroll bar Js-->
<script src="{{ asset('assets/plugins/pscrollbar/pscrollbar.js') }}"></script>

<!-- Swipe Js-->
<script src="{{ asset('assets/js/swipe.js') }}"></script>

<!-- Custom Js-->
<script src="{{ asset('assets/js/custom.js') }}"></script>

{{-- Google Maps API --}}
<script defer async src="{{ asset('assets/js/ride.js') }}"></script>
<script defer async src="https://maps.googleapis.com/maps/api/js?key={{ Config::get('google.maps.api.key') }}&libraries=places&callback=initMap"></script>
