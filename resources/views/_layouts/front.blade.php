@php
    $discussionBalloon = $discussionBalloon ?? true;
    $user = Auth::user();
@endphp

<!doctype html>

<html class="no-js" lang="fr">
	<head>
		<meta charset="UTF-8">
        <!-- Title -->
        <title>@yield('meta_title') | RAFITU</title>
		@yield('meta_data', view('_partials.front.metadata'))
		@yield('stylesheets', view('_partials.front.stylesheets'))
        <!-- Stylesheets Head -->
        @stack('head')
        <!-- End of Stylesheets head -->
	</head>

	<body class="main-body rafitu-body">

        @yield('loader', view('_partials.front.loader'))

        @yield('header', view('_partials.front.header.the-header'))

		@yield('hero')

		@yield('main')

        @include('_partials.front.alert')

        @yield('footer', view('_partials.front.footer.the-footer'))

		@yield('javascripts', view('_partials.front.javascripts'))

        @stack('footer')

        @if(!$user || ($user && !$user->isAdmin()))
            @if($discussionBalloon)
                @include('message._partials.chat')

                @include('message._partials.chat-script')
            @endif
        @endif
	</body>
</html>
