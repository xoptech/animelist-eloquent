@extends('components.import')

@section('content')
	@include('components.nav2')

	<div class='min-h-screen bg-white py-8 px-4 sm:px-8'>
		<div class='w-full max-w-[1400px] mx-auto'>
			<div class='flex flex-wrap gap-6 justify-center'>
				@foreach($anime as $item)
					<a href='{{ route('anime.show', $item->title) }}' style='width: 225px; height: 318px;' class='flex-shrink-0 relative block group'>
						<img src='{{ $item->thumbnail }}' alt='thumbnail' class='w-full h-full rounded-none border-none group-hover:opacity-90 transition-opacity'>
						<div class='absolute bottom-0 left-0 w-full bg-black/70 text-white text-[11px] font-bold py-1 px-2 text-left truncate'>
							{{ $item->title }}
						</div>
					</a>
				@endforeach
			</div>
		</div>
	</div>
@endsection
