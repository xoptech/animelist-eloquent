@extends('components.import')

@section('content')
@include('components.nav2')
<div class='flex justify-center mt-10 px-4 mb-20 min-h-[101vh]'>
	<div class='w-80 bg-white p-6 rounded-lg shadow border border-gray-200 h-fit'>
		<h2 class='text-xl font-bold text-center mb-6 text-gray-800'>Change Password</h2>

		<form action='{{ route('password.update', auth()->user()->username) }}' method='POST' class='flex flex-col gap-4'>
			@csrf
			
			<div class='flex flex-col gap-1'>
				<label class='text-xs font-bold text-gray-600'>New Password</label>
				<input type='password' name='password' placeholder='Create a password' required 
					   class='px-3 py-2 text-sm bg-gray-50 border border-gray-200 rounded focus:outline-none focus:ring-1 focus:ring-blue'>
			</div>

			<div class='flex flex-col gap-1'>
				<label class='text-xs font-bold text-gray-600'>Confirm Password</label>
				<input type='password' name='password_confirmation' placeholder='Confirm your password' required 
					   class='px-3 py-2 text-sm bg-gray-50 border border-gray-200 rounded focus:outline-none focus:ring-1 focus:ring-blue'>
			</div>

			@if ($errors->any())
				<div class='text-red-500 text-xs mt-1'>
					@foreach ($errors->all() as $error)
						<p>{{ $error }}</p>
					@endforeach
				</div>
			@endif

			<div class='flex gap-2 mt-4'>
				<a href='{{ route('profile.edit', auth()->user()->username) }}' class='w-1/2 py-2 bg-white border border-gray-200 text-gray-600 text-sm flex items-center justify-center font-bold rounded hover:bg-gray-50 transition-colors'>Back</a>
				<button type='submit' class='w-1/2 py-2 bg-blue text-white text-sm font-bold rounded hover:opacity-80 transition-opacity'>Update</button>
			</div>
		</form>
	</div>
</div>
@endsection
