<nav class='px-6 py-3 border-b border-gray-100 bg-white'>
	<div class='flex justify-between items-center max-w-5xl mx-auto'>
		<div class='flex items-center gap-8'>
			<a href='{{ route('home') }}' class='text-xl font-black tracking-tight text-blue'>MyAnimeList</a>
			
			<div class='hidden md:flex gap-6 text-sm font-bold text-gray-500'>
				<a href='{{ route('home') }}' class='{{ request()->routeIs('home') ? 'text-gray-800' : 'text-gray-500 hover:text-gray-800' }} transition-colors'>Home</a>
				<a href='{{ route('profile.show', auth()->user()->username) }}' class='{{ request()->routeIs('profile*') ? 'text-gray-800' : 'text-gray-500 hover:text-gray-800' }} transition-colors'>Profile</a>
				<a href='{{ route('anime') }}' class='{{ request()->routeIs('anime*') ? 'text-gray-800' : 'text-gray-500 hover:text-gray-800' }} transition-colors'>Anime</a>
				@if(auth()->user()->role === 'admin')
					<a href='{{ route('admin.users') }}' class='{{ request()->routeIs('admin.users*') ? 'text-gray-800' : 'text-gray-500 hover:text-gray-800' }} transition-colors text-red-500 hover:text-red-700 tracking-tight'>Manage Users</a>
				@endif
			</div>
		</div>

		<div class='flex gap-5 items-center text-sm font-bold'>
			<div class='flex items-center gap-4'>
				<a href='{{ route('profile.show', auth()->user()->username) }}' class='w-10 h-10 rounded-full border-2 border-gray-100 overflow-hidden shadow-sm bg-white block'>
					@if(auth()->user()->profile && auth()->user()->profile->avatar)
						<img src='{{ auth()->user()->profile->avatar }}' class='w-full h-full object-cover' alt='avatar'>
					@else
						<div class="w-full h-full flex items-center justify-center bg-blue text-white font-bold text-lg">
							{{ strtoupper(substr(auth()->user()->username, 0, 1)) }}
						</div>
					@endif
				</a>
				<span class='hidden sm:block tracking-tight'>{{ auth()->user()->username }}</span>
			</div>
			
			<div class='w-px h-4 bg-gray-200'></div>
			
			<form action='{{ route('logout') }}' method='POST' class='m-0'>
				@csrf
				<button type='submit' class='px-4 py-2 bg-red-500 text-white rounded-md hover:opacity-80 transition-colors shadow-sm'>
					Logout
				</button>
			</form>
		</div>
	</div>
</nav>
