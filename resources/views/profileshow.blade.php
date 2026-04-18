@extends('components.import')

@section('content')
	@include('components.nav2')
	
	<div class='min-h-screen bg-gray-50 pb-16'>
		<!-- Header Blurred Background -->
		<div class='w-full h-48 bg-gray-900 border-b border-gray-200 relative overflow-hidden'>
			<div class='absolute inset-0 opacity-40'>
				<img src='{{ $user->profile->avatar ?? 'https://ui-avatars.com/api/?name='.urlencode($user->username).'&background=random' }}' class='w-full h-full object-cover blur-3xl' alt='backdrop'>
			</div>
			<!-- Gradient Overlay -->
			<div class='absolute inset-0 bg-gradient-to-t from-gray-900 to-transparent opacity-90'></div>
		</div>

		<div class='max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 -mt-20 relative z-10'>
			<div class='flex flex-col md:flex-row gap-8'>
				
				<!-- Left Sidebar: Avatar -->
				<div class='w-full md:w-auto flex-shrink-0 flex flex-col items-center md:items-start'>
					<div style='width: 200px; height: 200px;' class='rounded-2xl overflow-hidden border-4 border-gray-50 shadow-md bg-white'>
						@if($user->profile && $user->profile->avatar)
							<img src='{{ $user->profile->avatar }}' alt='{{ $user->username }}' class='w-full h-full object-cover'>
						@else
							<div class="w-full h-full flex items-center justify-center bg-blue text-white text-6xl font-bold">
								{{ strtoupper(substr($user->username, 0, 1)) }}
							</div>
						@endif
					</div>
					
					<div class='mt-4 flex flex-col gap-2 w-[200px]'>
						@if(auth()->id() === $user->id)
							<a href='{{ route('profile.edit', auth()->user()->username) }}' class='w-full py-2.5 bg-white text-gray-700 border border-gray-200 font-bold rounded-lg shadow-sm hover:bg-gray-50 transition-colors text-center block'>Edit Profile</a>
						@endif
					</div>
				</div>

				<!-- Right Content: Info -->
				<div class='flex-grow pt-4 md:pt-24'>
					<h1 class='text-4xl font-black text-gray-900 tracking-tight leading-tight mb-2 text-center md:text-left'>
						{{ $user->username }}
					</h1>

					<!-- Bio -->
					<div class='mb-8 text-center md:text-left'>
						<p class='text-gray-600 leading-relaxed max-w-4xl'>
							{{ $user->profile->bio ?? 'This user has not written a bio yet.' }}
						</p>
					</div>

					<!-- Stats Grid -->
					<div class='grid grid-cols-3 gap-3 mb-10'>
						<div class='bg-white p-3 rounded-lg border border-gray-100 shadow-sm text-center md:text-left'>
							<span class='block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-0.5'>Watchlist</span>
							<span class='font-bold text-sm text-gray-800'>{{ $user->watchlists->count() }} Animes</span>
						</div>
						<div class='bg-white p-3 rounded-lg border border-gray-100 shadow-sm text-center md:text-left'>
							<span class='block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-0.5'>Favorites</span>
							<span class='font-bold text-sm text-gray-800'>{{ $user->favorites->count() }} Animes</span>
						</div>
						<div class='bg-white p-3 rounded-lg border border-gray-100 shadow-sm text-center md:text-left'>
							<span class='block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-0.5'>Reviews Written</span>
							<span class='font-bold text-sm text-gray-800'>{{ $user->reviews->count() }}</span>
						</div>
					</div>

					<!-- Recent Reviews -->
					@if($user->reviews->count() > 0)
						<div class='mb-12'>
							<h3 class='text-2xl font-black text-gray-800 mb-6'>Recent Reviews</h3>
							<div class='space-y-4'>
								@foreach($user->reviews->sortByDesc('created_at')->take(5) as $review)
									<div class='bg-white p-5 rounded-xl border border-gray-100 shadow-sm flex flex-col sm:flex-row gap-4'>
										<a href='{{ route('anime.show', $review->anime->title) }}' class='flex-shrink-0 group'>
											<img src='{{ $review->anime->thumbnail }}' class='w-16 h-24 object-cover rounded-md group-hover:opacity-80 transition-opacity'>
										</a>
										<div class='flex-grow'>
											<div class='flex justify-between items-start mb-2'>
												<a href='{{ route('anime.show', $review->anime->title) }}' class='font-bold text-gray-800 hover:text-blue transition-colors'>{{ $review->anime->title }}</a>
												<span class='text-xs text-gray-400 font-bold'>{{ $review->created_at->format('M d, Y') }}</span>
											</div>
											<p class='text-gray-600 text-sm'>{{ $review->body }}</p>
										</div>
									</div>
								@endforeach
							</div>
						</div>
					@endif
					
				</div>
			</div>
		</div>
	</div>
@endsection
