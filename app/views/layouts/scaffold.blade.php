<!doctype html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />

	    <meta name="description" content=" " />
	    <meta name="keywords" content=" " />

	    <title>
	        @section('title')
	        AcademicEssayWritings :: 
	        @show
	    </title>

	    <!-- Favicons -->
	    <link rel="shortcut icon" type="image/png" href="" />
	    <link rel="shortcut icon" type="image/x-icon" href="" />

		<!-- Style sheets -->
		<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap-combined.min.css" rel="stylesheet">
		<style>
			table form { margin-bottom: 0; }
			form ul { margin-left: 0; list-style: none; }
			.error { color: red; font-style: italic; }
			body { padding-top: 20px; }
		</style>

	    <!-- App UI/UX flow helpers -->
	    @yield('css')
	</head>

	<body>

		<div class="container">
			@if (Session::has('message'))
				<div class="flash alert">
					<p>{{ Session::get('message') }}</p>
				</div>
			@endif

			@yield('main')
		</div>

	</body>

</html>