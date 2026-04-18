@extends('components.import')

@section('content')
	@include('components.nav2')

	<div class='min-h-screen bg-gray-50/50 py-6 px-4'>
		<div class='max-w-5xl mx-auto'>
			<h1 class='text-2xl font-black text-gray-800 tracking-tight'>Welcome back, {{ auth()->user()->username }}!</h1>
			<p class='text-sm text-gray-500 font-medium mt-1'>Ready to explore some anime today?</p>
			
			<div class='mt-6 grid grid-cols-1 md:grid-cols-3 gap-4'>
				<div class='bg-white p-5 rounded-xl border border-gray-100 shadow-sm'>
					<h3 class='font-bold text-gray-800 text-sm'>Your Watchlist</h3>
					<p class='text-xs text-gray-500 mt-1'>{{ auth()->user()->watchlists()->count() }} items tracking</p>
				</div>
				<div class='bg-white p-5 rounded-xl border border-gray-100 shadow-sm'>
					<h3 class='font-bold text-gray-800 text-sm'>Favorites</h3>
					<p class='text-xs text-gray-500 mt-1'>{{ auth()->user()->favorites()->count() }} animes added</p>
				</div>
				<div class='bg-white p-5 rounded-xl border border-gray-100 shadow-sm'>
					<h3 class='font-bold text-gray-800 text-sm'>Reviews</h3>
					<p class='text-xs text-gray-500 mt-1'>{{ auth()->user()->reviews()->count() }} written</p>
				</div>
			</div>

			@if(auth()->user()->watchlists->count() > 0)
			<div class='mt-10'>
				<h2 class='text-xl font-black text-gray-800 mb-4 tracking-tight'>Currently Watching</h2>
				<div class='flex flex-wrap gap-4'>
					@foreach(auth()->user()->watchlists->sortByDesc('created_at') as $item)
						<a href='{{ route('anime.show', $item->anime->title) }}' style='width: 140px; height: 198px;' class='flex-shrink-0 relative block group border border-gray-200'>
							<img src='{{ $item->anime->thumbnail }}' class='w-full h-full rounded-none border-none group-hover:opacity-90 transition-opacity'>
							<div class='absolute bottom-0 left-0 w-full bg-black/70 text-white text-[10px] font-bold py-1 px-2 text-left truncate'>
								{{ $item->anime->title }}
							</div>
						</a>
					@endforeach
				</div>
			</div>
			@endif

			@if(auth()->user()->favorites->count() > 0)
			<div class='mt-10'>
				<h2 class='text-xl font-black text-gray-800 mb-4 tracking-tight'>Your Favorites</h2>
				<div class='flex flex-wrap gap-4'>
					@foreach(auth()->user()->favorites->sortByDesc('created_at') as $item)
						<a href='{{ route('anime.show', $item->anime->title) }}' style='width: 140px; height: 198px;' class='flex-shrink-0 relative block group border border-gray-200'>
							<img src='{{ $item->anime->thumbnail }}' class='w-full h-full rounded-none border-none group-hover:opacity-90 transition-opacity'>
							<div class='absolute bottom-0 left-0 w-full bg-black/70 text-white text-[10px] font-bold py-1 px-2 text-left truncate'>
								{{ $item->anime->title }}
							</div>
						</a>
					@endforeach
				</div>
			</div>
			@endif
		</div>
	</div>
@endsection