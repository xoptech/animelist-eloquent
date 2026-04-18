<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>@yield('title', 'MyAnimeList')</title>
	@vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex flex-col min-h-screen bg-gray-50 text-gray-900 font-sans">
	<div class="flex-grow flex flex-col">
		@yield('content')
	</div>
	@include('components.footer')
</body>
</html>