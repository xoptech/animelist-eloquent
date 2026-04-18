@extends('components.import')

@section('content')
	@include('components.nav2')
	
	<div class='min-h-screen bg-gray-50 pb-16'>
		<!-- Header Background -->
		<div class='w-full h-96 bg-gray-900 border-b border-gray-200 relative overflow-hidden'>
			<!-- Blurred Background Image layer -->
			<div class='absolute inset-0 opacity-30'>
				<img src='{{ $anime->thumbnail }}' class='w-full h-full object-cover object-top blur-md' alt='backdrop'>
			</div>
			<!-- Gradient Overlay -->
			<div class='absolute inset-0 bg-gradient-to-t from-gray-900 to-transparent'></div>
		</div>

		<div class='max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 -mt-16 relative z-10'>
			<div class='flex flex-col md:flex-row gap-8'>
				
				<!-- Left Sidebar: Poster & Buttons -->
				<div class='w-full md:w-auto flex-shrink-0'>
					<div style='width: 225px; height: 318px;'>
						<img src='{{ $anime->thumbnail }}' alt='{{ $anime->title }}' class='w-full h-full rounded-none border-none'>
					</div>
					
					<div class='mt-4 flex flex-col gap-2' style='width: 225px;' id='actions'>
						<!-- Rating UI -->
						<form action='{{ route('rating.add', $anime->id) }}' method='POST' class='m-0 p-0 block'>
							@csrf
							@php
								$currentRating = auth()->user()->ratings()->where('anime_id', $anime->id)->first()->score ?? null;
							@endphp
							<select name='score' class='font-sans w-full py-2.5 {{ $currentRating ? 'bg-yellow-50 text-yellow-600 border-yellow-200' : 'bg-white text-gray-700 border-gray-200 hover:bg-gray-50' }} border font-bold rounded-lg shadow-sm focus:outline-none focus:ring-0 cursor-pointer transition-colors appearance-none text-center'>
								<option value='' class='font-sans {{ $currentRating ? 'text-gray-500' : 'text-gray-400' }}'>
									{{ $currentRating ? 'Remove Rating' : 'Rate this anime...' }}
								</option>
								@foreach([
									10 => '(10) Masterpiece',
									9  => '(9) Great',
									8  => '(8) Very Good',
									7  => '(7) Good',
									6  => '(6) Fine',
									5  => '(5) Average',
									4  => '(4) Bad',
									3  => '(3) Very Bad',
									2  => '(2) Horrible',
									1  => '(1) Appalling'
								] as $score => $label)
									<option value='{{ $score }}' class='font-sans {{ $currentRating == $score ? 'bg-yellow-50 text-yellow-700 font-bold' : '' }}' {{ $currentRating == $score ? 'selected' : '' }}>
										{{ $label }}
									</option>
								@endforeach
							</select>
						</form>

						<form action='{{ route('watchlist.add', $anime->id) }}' method='POST' class='m-0 p-0 block'>
							@csrf
							@if(auth()->user()->watchlists()->where('anime_id', $anime->id)->exists())
								<button type='submit' class='w-full py-2.5 bg-gray-100 text-gray-500 font-bold rounded-lg shadow-sm hover:bg-gray-200 transition-colors'>Remove from Watchlist</button>
							@else
								<button type='submit' class='w-full py-2.5 bg-blue text-white font-bold rounded-lg shadow-sm hover:opacity-90 transition-opacity'>Add to Watchlist</button>
							@endif
						</form>
						
						<form action='{{ route('favorite.add', $anime->id) }}' method='POST' class='m-0 p-0 block'>
							@csrf
							@if(auth()->user()->favorites()->where('anime_id', $anime->id)->exists())
								<button type='submit' class='w-full py-2.5 bg-red-50 text-red-500 border border-red-200 font-bold rounded-lg shadow-sm hover:bg-red-100 transition-colors'>♥ Favorited</button>
							@else
								<button type='submit' class='w-full py-2.5 bg-white text-gray-700 border border-gray-200 font-bold rounded-lg shadow-sm hover:bg-gray-50 transition-colors'>Add to Favorites</button>
							@endif
						</form>
						<button onclick='history.back()' class='w-full py-2.5 bg-gray-900 text-white text-center font-bold rounded-lg shadow-sm hover:opacity-80 transition-opacity block'>Back</button>
					</div>
				</div>

				<!-- Right Content: Info -->
				<div class='flex-grow pt-4 md:pt-32'>
					<h1 class='text-4xl font-black text-gray-900 tracking-tight leading-tight mb-2'>
						{{ $anime->title }}
					</h1>
					
					<!-- Studio List -->
					@if($anime->studios->count() > 0)
						<p class='text-md font-bold text-blue mb-6'>
							{{ implode(', ', $anime->studios->pluck('name')->toArray()) }}
						</p>
					@endif

					<!-- Stats Grid -->
					<div class='grid grid-cols-2 lg:grid-cols-4 gap-3 mb-8'>
						<div class='bg-white p-3 rounded-lg border border-gray-100 shadow-sm'>
							<span class='block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-0.5'>Episodes</span>
							<span class='font-bold text-sm text-gray-800'>{{ $anime->episode ?? 'Unknown' }}</span>
						</div>
						<div class='bg-white p-3 rounded-lg border border-gray-100 shadow-sm'>
							<span class='block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-0.5'>Status</span>
							<span class='font-bold text-sm text-gray-800'>{{ ucfirst($anime->status) }}</span>
						</div>
						<div class='bg-white p-3 rounded-lg border border-gray-100 shadow-sm'>
							<span class='block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-0.5'>Duration</span>
							<span class='font-bold text-sm text-gray-800'>{{ $anime->duration }}</span>
						</div>
						<div class='bg-white p-3 rounded-lg border border-gray-100 shadow-sm'>
							<span class='block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-0.5'>Genre</span>
							<span class='font-bold text-sm text-gray-800'>{{ $anime->genre }}</span>
						</div>
					</div>

					<!-- Aired Dates -->
					<div class='mb-8'>
						<h3 class='text-sm font-bold text-gray-400 uppercase tracking-wider mb-2'>Aired</h3>
						<p class='text-gray-800 font-semibold'>
							{{ $anime->aired_from ? $anime->aired_from->format('M d, Y') : '?' }} to {{ $anime->aired_to ? $anime->aired_to->format('M d, Y') : '?' }}
						</p>
					</div>

					<!-- Synopsis -->
					<div class='mb-12'>
						<h3 class='text-lg font-black text-gray-800 mb-3'>Synopsis</h3>
						<p class='text-gray-600 leading-relaxed max-w-4xl'>
							{{ $anime->synopsis }}
						</p>
					</div>

					<!-- Reviews Section -->
					<div id='reviews'>
						<h3 class='text-2xl font-black text-gray-800 mb-6'>Reviews</h3>
						
						<!-- Leave a Review Form -->
						<div class='bg-white p-5 rounded-xl border border-gray-100 shadow-sm mb-8'>
							<form action='{{ route('review.add', $anime->id) }}' method='POST'>
								@csrf
								<textarea name='body' rows='3' class='w-full border-gray-200 rounded-lg focus:outline-none focus:ring-0 focus:border-gray-200 resize-none' placeholder='Leave a review...' required></textarea>
								<div class='mt-2 flex justify-end'>
									<button type='submit' class='py-2 px-6 bg-blue text-white font-bold rounded-lg shadow-sm hover:opacity-90 transition-opacity'>Post Review</button>
								</div>
							</form>
						</div>

						<!-- Display Reviews -->
						<div class='space-y-4'>
							@foreach($anime->reviews->sortByDesc('created_at') as $review)
								<div class='bg-white p-5 rounded-xl border border-gray-100 shadow-sm'>
									<div class='flex justify-between items-start mb-3'>
										<div class='flex items-center gap-3'>
											<a href='{{ route('profile.show', $review->user->username) }}' class='w-8 h-8 rounded-full border border-gray-200 overflow-hidden bg-white shadow-sm flex-shrink-0'>
												@if($review->user->profile && $review->user->profile->avatar)
													<img src='{{ $review->user->profile->avatar }}' class='w-full h-full object-cover'>
												@else
													<div class='w-full h-full flex items-center justify-center bg-blue text-white font-bold text-xs'>
														{{ strtoupper(substr($review->user->username, 0, 1)) }}
													</div>
												@endif
											</a>
											<a href='{{ route('profile.show', $review->user->username) }}' class='font-bold text-sm text-gray-800 hover:text-blue transition-colors'>{{ $review->user->username }}</a>
										</div>
										<span class='text-xs text-gray-400 font-bold mt-1'>{{ $review->created_at->format('M d, Y') }}</span>
									</div>
									<p class='text-gray-600 text-sm'>{{ $review->body }}</p>
								</div>
							@endforeach
							
							@if($anime->reviews->count() === 0)
								<p class='text-gray-400 font-medium italic'>No reviews yet. Be the first to share your thoughts!</p>
							@endif
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>

	<!-- Premium Scroll & History Preservation Pipeline -->
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			// 1. Restore exact scroll pixel instantly if returning from an internal background reload
			if (sessionStorage.getItem("frozenScroll")) {
				window.scrollTo(0, sessionStorage.getItem("frozenScroll"));
				sessionStorage.removeItem("frozenScroll");
			}

			// 2. Map the rating dropdown strictly to cast a bubbling submit event so it can be trapped
			const ratingSelect = document.querySelector('select[name="score"]');
			if(ratingSelect) {
				ratingSelect.addEventListener('change', () => {
					ratingSelect.closest('form').dispatchEvent(new Event('submit', {cancelable: true, bubbles: true}));
				});
			}

			// 3. Trap all forms on the page natively (Ratings, Favorites, Watchlist, Reviews)
			document.querySelectorAll('form').forEach(form => {
				form.addEventListener('submit', async (e) => {
					e.preventDefault(); // Stop standard routing
					sessionStorage.setItem("frozenScroll", window.scrollY); // Snapshot scroll state
					
					// Fire the exact same POST sequence directly in the background
					await fetch(form.action, {
						method: form.method,
						body: new FormData(form),
						headers: { 'X-Requested-With': 'XMLHttpRequest' }
					});
					
					// Hard reload state WITHOUT adding to browser history stack. Back button remains pristine.
					window.location.reload(); 
				});
			});
		});
	</script>
@endsection
