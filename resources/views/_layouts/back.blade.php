{{-- Backoffice layouts --}}
<!doctype html>

<html lang="fr" dir="ltr">
	<head>
		<meta charset="UTF-8">
        <!-- Title -->
        <title>@yield('meta_title') | ADMIN</title>
        <meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		@yield('stylesheets', view('_partials.back.stylesheets'))
        @stack('head')
	</head>

	<body class="app sidebar-mini">

        @yield('loader', view('_partials.back.loader'))

        <div class="page">
			<div class="page-main  h-100">

				<!-- app-header---->
				<div class="app-header1 header py-1 d-flex">
					<div class="container-fluid">
						<div class="d-flex">
							@include('_partials.back.header.brand')

							{{-- @include('_partials.back.header.search') --}}

							<div class="d-flex order-lg-2 ms-auto  header-right">
								{{-- @include('_partials.back.header.search-2') --}}

								<div class="p-0 mb-0 navbar navbar-expand-lg  responsive-navbar navbar-dark  ">
									<div class="navbar-collapse collapse" id="navbarSupportedContent-4">
										<div class="d-flex">
											@include('_partials.back.header.fullscreen-switcher')

											{{-- @include('_partials.back.header.country-switcher') --}}

											{{-- @include('_partials.back.header.notifications') --}}

											{{-- @include('_partials.back.header.inbox-preview') --}}

											{{-- @include('_partials.back.header.main-app') --}}

											@include('_partials.back.header.user-menu')
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- app-header End---->

				<!-- Sidebar menu-->
				<div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
				<aside class="app-sidebar doc-sidebar">

                    @include('_partials.back.sidebar.user-info')

					@include('_partials.back.sidebar.menu')

					@include('_partials.back.sidebar.footer')

				</aside>
				<!-- Sidebar menu End-->

				<div class="app-content  my-3 my-md-5">
                    <div class="side-app">
                        @yield('main')
                    </div>
				</div>
			</div>

			@include('_partials.back.footer.the-footer')
		</div>

		@yield('javascripts', view('_partials.back.javascripts'))

        @stack('footer')
	</body>
</html>
