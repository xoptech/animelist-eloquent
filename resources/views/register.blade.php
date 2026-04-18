@extends('components.import')

@section('content')
@include('components.nav')
<div class='flex justify-center mt-10 px-4'>
	<div class='w-80 bg-white p-6 rounded-lg shadow border border-gray-200'>
		<h2 class='text-xl font-bold text-center mb-6 text-gray-800'>Create account</h2>

		<form action='{{ route('register') }}' method='POST' class='flex flex-col gap-4'>
			@csrf
			
			<div class='flex flex-col gap-1'>
				<label class='text-xs font-bold text-gray-600'>Username</label>
				<input type='text' name='username' placeholder='Choose a username' value='{{ old('username') }}' required 
					   class='px-3 py-2 text-sm bg-gray-50 border border-gray-200 rounded focus:outline-none focus:ring-1 focus:ring-blue'>
			</div>

			<div class='flex flex-col gap-1'>
				<label class='text-xs font-bold text-gray-600'>Email</label>
				<input type='email' name='email' placeholder='Enter your email' value='{{ old('email') }}' required 
					   class='px-3 py-2 text-sm bg-gray-50 border border-gray-200 rounded focus:outline-none focus:ring-1 focus:ring-blue'>
			</div>

			<div class='flex flex-col gap-1'>
				<label class='text-xs font-bold text-gray-600'>Password</label>
				<input type='password' name='password' placeholder='Create a password' required 
					   class='px-3 py-2 text-sm bg-gray-50 border border-gray-200 rounded focus:outline-none focus:ring-1 focus:ring-blue'>
			</div>

			<div class='flex flex-col gap-1'>
				<label class='text-xs font-bold text-gray-600'>Confirm Password</label>
				<input type='password' name='password_confirmation' placeholder='Confirm your password' required 
					   class='px-3 py-2 text-sm bg-gray-50 border border-gray-200 rounded focus:outline-none focus:ring-1 focus:ring-blue'>
			</div>

			@if ($errors->any())
				<div class='text-red-500 text-xs'>
					@foreach ($errors->all() as $error)
						<p>{{ $error }}</p>
					@endforeach
				</div>
			@endif

			<button type='submit' class='w-full py-2 bg-blue text-white text-sm font-bold rounded hover:opacity-80 transition-opacity'>
				Register
			</button>

			<p class='text-center text-xs text-gray-500'>
				Already have an account? <a href='{{ route('login') }}' class='text-blue font-bold hover:underline'>Sign in</a>
			</p>
		</form>
	</div>
</div>
@endsection