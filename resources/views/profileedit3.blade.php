@extends('components.import')

@section('content')
@include('components.nav2')
<div class='flex justify-center mt-10 px-4 mb-20 min-h-[101vh]'>
	<div class='w-80 bg-white p-6 rounded-lg shadow border border-red-200 h-fit'>
		<h2 class='text-xl font-bold text-center mb-1 text-gray-800 tracking-tight'>Override Profile</h2>
		<p class='text-xs text-center text-red-500 font-bold mb-6'>MODIFYING PRIVILEGES FOR {{ strtoupper($targetUser->username) }}</p>

		<form action='{{ route('admin.users.update', $targetUser->username) }}' method='POST' class='flex flex-col gap-4'>
			@csrf
			
			<div class='flex flex-col gap-1'>
				<label class='text-xs font-bold text-red-500'>Account Role</label>
				<select name='role' class='font-sans px-3 py-2 text-sm bg-red-50 text-red-700 border border-red-200 font-bold rounded focus:outline-none focus:ring-1 focus:ring-red-400'>
					<option value='user' class='font-sans' {{ $targetUser->role === 'user' ? 'selected' : '' }}>Standard User</option>
					<option value='admin' class='font-sans' {{ $targetUser->role === 'admin' ? 'selected' : '' }}>Administrator</option>
				</select>
			</div>

			<div class='flex flex-col gap-1'>
				<label class='text-xs font-bold text-gray-600'>Username</label>
				<input type='text' name='username' value='{{ old('username', $targetUser->username) }}' required 
					   class='px-3 py-2 text-sm bg-gray-50 border border-gray-200 rounded focus:outline-none focus:ring-1 focus:ring-blue'>
			</div>

			<div class='flex flex-col gap-1'>
				<label class='text-xs font-bold text-gray-600'>Avatar URL</label>
				<input type='text' name='avatar' placeholder='https://...' value='{{ old('avatar', $targetUser->profile->avatar ?? '') }}' 
					   class='px-3 py-2 text-sm bg-gray-50 border border-gray-200 rounded focus:outline-none focus:ring-1 focus:ring-blue'>
			</div>

			<div class='flex flex-col gap-1'>
				<label class='text-xs font-bold text-gray-600'>Biography</label>
				<textarea name='bio' rows='3'
					   class='px-3 py-2 text-sm bg-gray-50 border border-gray-200 rounded focus:outline-none focus:ring-1 focus:ring-blue resize-none'>{{ old('bio', $targetUser->profile->bio ?? '') }}</textarea>
			</div>

			<div class='flex flex-col gap-1'>
				<label class='text-xs font-bold text-gray-600'>Force New Password</label>
				<input type='password' name='password' placeholder='Leave blank to keep current' 
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
				<a href='{{ route('admin.users') }}' class='w-1/2 py-2 bg-white border border-gray-200 text-gray-600 text-sm flex items-center justify-center font-bold rounded hover:bg-gray-50 transition-colors'>Cancel</a>
				<button type='submit' class='w-1/2 py-2 bg-red-500 text-white text-sm font-bold rounded hover:opacity-80 transition-opacity'>Force Save</button>
			</div>
		</form>
	</div>
</div>
@endsection
