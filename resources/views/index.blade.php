@extends('components.import')

@section('content')
	@include('components.nav')
	
	<div class='relative h-[650px] w-full overflow-hidden bg-gray-900 flex items-center justify-center border-b border-gray-800'>
		
		<div class='absolute inset-0 opacity-15 pointer-events-none flex flex-col gap-4 overflow-hidden -rotate-3 scale-110 origin-center select-none'>
			<div class='flex animate-scroll'>
				<div class='flex gap-4 pr-4'>
					@foreach($animeLoop as $anime)
						<img src='{{ $anime->thumbnail }}' class='w-[225px] h-[318px] object-cover rounded-md shadow-lg flex-shrink-0' alt=''>
					@endforeach
				</div>
				<div class='flex gap-4 pr-4'>
					@foreach($animeLoop as $anime)
						<img src='{{ $anime->thumbnail }}' class='w-[225px] h-[318px] object-cover rounded-md shadow-lg flex-shrink-0' alt=''>
					@endforeach
				</div>
			</div>
			<div class='flex animate-scroll' style='animation-direction: reverse; animation-duration: 75s;'>
				<div class='flex gap-4 pr-4'>
					@foreach($animeLoop as $anime)
						<img src='{{ $anime->thumbnail }}' class='w-[225px] h-[318px] object-cover rounded-md shadow-lg flex-shrink-0' alt=''>
					@endforeach
				</div>
				<div class='flex gap-4 pr-4'>
					@foreach($animeLoop as $anime)
						<img src='{{ $anime->thumbnail }}' class='w-[225px] h-[318px] object-cover rounded-md shadow-lg flex-shrink-0' alt=''>
					@endforeach
				</div>
			</div>
		</div>

		<div class='absolute inset-0 bg-gradient-to-t from-gray-900 via-transparent to-gray-900 opacity-90 pointer-events-none'></div>
		<div class='absolute inset-0 bg-gradient-to-r from-gray-900 via-transparent to-gray-900 opacity-90 pointer-events-none'></div>

		<div class='relative z-10 text-center max-w-5xl px-6'>
			<h1 class='text-5xl md:text-7xl font-black text-white tracking-tight mb-6 leading-tight drop-shadow-2xl'>
				Track What You Watch. <span class='text-blue'>Discover What's Next.</span>
			</h1>
			<p class='text-lg text-gray-300 font-medium mb-10 max-w-2xl mx-auto'>
				The ultimate, blazing-fast personal catalog. Never lose your spot, rate your favorites, and see what the community considers a masterpiece.
			</p>
			
			<div class='flex flex-col sm:flex-row gap-4 justify-center items-center'>
				<a href='{{ route('register') }}' class='w-full sm:w-auto px-10 py-4 bg-blue text-white text-lg font-bold rounded-lg shadow-xl hover:opacity-90 transition-opacity'>
					Get Started for Free
				</a>
				<a href='{{ route('login') }}' class='w-full sm:w-auto px-10 py-4 bg-transparent border-2 border-white/10 text-white text-lg font-bold rounded-lg hover:bg-white/5 transition-colors'>
					Sign In
				</a>
			</div>
		</div>
	</div>

	<div class='w-full bg-white flex-grow py-20 overflow-hidden'>
		<div class='max-w-6xl mx-auto px-6'>
			<div class='text-center mb-16'>
				<h2 class='text-3xl font-black text-gray-900 tracking-tight'>Latest Community Reviews</h2>
				<p class='text-gray-500 font-bold mt-2'>See what everyone is talking about right now.</p>
			</div>
		</div>
			
		<div class='relative w-full text-left'>
			<div class='absolute inset-y-0 left-0 w-24 bg-gradient-to-r from-white to-transparent z-10 pointer-events-none'></div>
			<div class='absolute inset-y-0 right-0 w-24 bg-gradient-to-l from-white to-transparent z-10 pointer-events-none'></div>

			<div class='flex animate-scroll-slow hover:[animation-play-state:paused] pb-4'>
				<div class='flex gap-8 pr-8'>
					@foreach($recentReviews as $review)
						<div class='w-[400px] flex-shrink-0 bg-gray-50 p-6 rounded-2xl border border-gray-100 flex flex-col h-full hover:shadow-md transition-shadow cursor-default'>
							<div class='flex items-center gap-4 mb-4 pb-4 border-b border-gray-200'>
								<img src='{{ $review->anime->thumbnail }}' class='w-12 h-16 object-cover rounded shadow-sm' alt=''>
								<div>
									<h4 class='font-black text-gray-900 leading-tight line-clamp-1'>{{ $review->anime->title }}</h4>
									<p class='text-[10px] font-bold text-gray-400 mt-1 uppercase tracking-wider'>Community Review</p>
								</div>
							</div>
							
							<div class='flex-grow mb-6'>
								<p class='text-gray-600 text-sm italic leading-relaxed'>
									"{{ \Illuminate\Support\Str::limit($review->body, 160) }}"
								</p>
							</div>

							<div class='flex items-center justify-between mt-auto pt-4 border-t border-gray-100'>
								<div class='flex items-center gap-3'>
									<div class='w-8 h-8 rounded-full border border-gray-200 overflow-hidden bg-white shadow-sm flex-shrink-0'>
										@if($review->user->profile && $review->user->profile->avatar)
											<img src='{{ $review->user->profile->avatar }}' class='w-full h-full object-cover'>
										@else
											<div class='w-full h-full flex items-center justify-center bg-blue text-white font-bold text-xs'>
												{{ strtoupper(substr($review->user->username, 0, 1)) }}
											</div>
										@endif
									</div>
									<div>
										<p class='text-sm font-bold text-gray-800 leading-none'>{{ $review->user->username }}</p>
										<p class='text-[10px] uppercase font-bold text-gray-400 mt-1 leading-none'>{{ $review->created_at->diffForHumans() }}</p>
									</div>
								</div>
							</div>
						</div>
					@endforeach
				</div>
				<div class='flex gap-8 pr-8'>
					@foreach($recentReviews as $review)
						<div class='w-[400px] flex-shrink-0 bg-gray-50 p-6 rounded-2xl border border-gray-100 flex flex-col h-full hover:shadow-md transition-shadow cursor-default'>
							<div class='flex items-center gap-4 mb-4 pb-4 border-b border-gray-200'>
								<img src='{{ $review->anime->thumbnail }}' class='w-12 h-16 object-cover rounded shadow-sm' alt=''>
								<div>
									<h4 class='font-black text-gray-900 leading-tight line-clamp-1'>{{ $review->anime->title }}</h4>
									<p class='text-[10px] font-bold text-gray-400 mt-1 uppercase tracking-wider'>Community Review</p>
								</div>
							</div>
							
							<div class='flex-grow mb-6'>
								<p class='text-gray-600 text-sm italic leading-relaxed'>
									"{{ \Illuminate\Support\Str::limit($review->body, 160) }}"
								</p>
							</div>

							<div class='flex items-center justify-between mt-auto pt-4 border-t border-gray-100'>
								<div class='flex items-center gap-3'>
									<div class='w-8 h-8 rounded-full border border-gray-200 overflow-hidden bg-white shadow-sm flex-shrink-0'>
										@if($review->user->profile && $review->user->profile->avatar)
											<img src='{{ $review->user->profile->avatar }}' class='w-full h-full object-cover'>
										@else
											<div class='w-full h-full flex items-center justify-center bg-blue text-white font-bold text-xs'>
												{{ strtoupper(substr($review->user->username, 0, 1)) }}
											</div>
										@endif
									</div>
									<div>
										<p class='text-sm font-bold text-gray-800 leading-none'>{{ $review->user->username }}</p>
										<p class='text-[10px] uppercase font-bold text-gray-400 mt-1 leading-none'>{{ $review->created_at->diffForHumans() }}</p>
									</div>
								</div>
							</div>
						</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
@endsection