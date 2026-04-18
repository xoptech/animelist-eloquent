@extends('components.import')

@section('content')
@include('components.nav2')
<div class='flex justify-center mt-10 px-4 mb-20'>
	<div class='w-80 bg-white p-6 rounded-lg shadow border border-gray-200'>
		<h2 class='text-xl font-bold text-center mb-6 text-gray-800'>Edit Profile</h2>

		<form action='{{ route('profile.update', auth()->user()->username) }}' method='POST' class='flex flex-col gap-4'>
			@csrf
			
			<div class='flex flex-col gap-1'>
				<label class='text-xs font-bold text-gray-600'>Username</label>
				<input type='text' name='username' placeholder='Choose a username' value='{{ old('username', auth()->user()->username) }}' required 
					   class='px-3 py-2 text-sm bg-gray-50 border border-gray-200 rounded focus:outline-none focus:ring-1 focus:ring-blue'>
			</div>

			<div class='flex flex-col gap-1'>
				<label class='text-xs font-bold text-gray-600'>Avatar URL</label>
				<input type='text' name='avatar' placeholder='https://...' value='{{ old('avatar', auth()->user()->profile->avatar ?? '') }}' 
					   class='px-3 py-2 text-sm bg-gray-50 border border-gray-200 rounded focus:outline-none focus:ring-1 focus:ring-blue'>
			</div>

			<div class='flex flex-col gap-1'>
				<label class='text-xs font-bold text-gray-600'>Biography</label>
				<textarea name='bio' placeholder='Tell everyone about yourself...' rows='4'
					   class='px-3 py-2 text-sm bg-gray-50 border border-gray-200 rounded focus:outline-none focus:ring-1 focus:ring-blue resize-none'>{{ old('bio', auth()->user()->profile->bio ?? '') }}</textarea>
			</div>
			
			@if ($errors->any())
				<div class='text-red-500 text-xs mt-1'>
					@foreach ($errors->all() as $error)
						<p>{{ $error }}</p>
					@endforeach
				</div>
			@endif

			<div class='flex gap-2 mt-4'>
				<a href='{{ route('profile.show', auth()->user()->username) }}' class='w-1/2 py-2 bg-white border border-gray-200 text-gray-600 text-sm flex items-center justify-center font-bold rounded hover:bg-gray-50 transition-colors'>Cancel</a>
				<button type='submit' class='w-1/2 py-2 bg-blue text-white text-sm font-bold rounded hover:opacity-80 transition-opacity'>Save</button>
			</div>
		</form>
		
		<!-- Change Password Link -->
		<div class='mt-4 pt-4 border-t border-gray-100'>
			<a href='{{ route('password.edit', auth()->user()->username) }}' class='block w-full py-2 bg-white border border-gray-200 text-gray-600 text-sm flex items-center justify-center font-bold rounded hover:bg-gray-50 transition-colors'>Change Password</a>
		</div>
	</div>
</div>
@endsection
