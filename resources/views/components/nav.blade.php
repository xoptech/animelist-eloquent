<nav class='px-6 py-3 border-b border-gray-100 bg-white'>
	<div class='flex justify-between items-center max-w-5xl mx-auto'>
		<div>
			<a href='{{ route('index') }}' class='text-xl font-black tracking-tight text-blue'>MyAnimeList</a>
		</div>

		<div class='flex gap-4 items-center text-sm font-bold'>
			<a href='{{ route('login') }}' class='px-4 py-2 border border-gray-200 text-gray-600 rounded-md hover:border-gray-300 hover:text-blue transition-colors'>Login</a>
			<a href='{{ route('register') }}' class='px-4 py-2 bg-blue text-white rounded-md hover:opacity-80 transition-colors shadow-sm'>Get Started</a>
		</div>
	</div>
</nav>