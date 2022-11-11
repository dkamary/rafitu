<!doctype html>

<html class="no-js" lang="en">

	<head>
		<meta charset="UTF-8">

        <!-- Title -->
        <title>@yield('meta_title') | RAFITU</title>

		@include('_partials.front.metadata')

		@include('_partials.front.stylesheets')

	</head>

	<body class="main-body">

		@include('_partials.front.loader')

		@include('_partials.front.header.the-header')

		@include('_partials.front.section.hero')

		@include('_partials.front.section.category-slider')

		@include('_partials.front.section.ads-latest')

		@include('_partials.front.section.ads-featured')

		@include('_partials.front.section.statistics')

		@include('_partials.front.section.locations')

		@include('_partials.front.section.testimonials')

		@include('_partials.front.section.blog-preview')

		@include('_partials.front.footer.the-footer')

		@include('_partials.front.javascripts')

	</body>
</html>
