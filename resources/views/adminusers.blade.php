@extends('components.import')

@section('content')
@include('components.nav2')

<div class='min-h-[100vh] bg-gray-50 py-10 px-4'>
	<div class='max-w-5xl mx-auto'>
		<div class='flex justify-between items-center mb-8'>
			<h2 class='text-2xl font-black text-gray-900 tracking-tight'>Manage Users</h2>
			<span class='px-4 py-2 bg-blue/10 text-blue font-bold text-sm rounded-full'>{{ $users->count() }} Registered</span>
		</div>

		<div class='bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden'>
			<div class='overflow-x-auto'>
				<table class='w-full text-left border-collapse'>
					<thead>
						<tr class='bg-gray-50 border-b border-gray-200'>
							<th class='p-4 text-xs font-bold text-gray-500 uppercase tracking-widest'>User</th>
							<th class='p-4 text-xs font-bold text-gray-500 uppercase tracking-widest'>Email</th>
							<th class='p-4 text-xs font-bold text-gray-500 uppercase tracking-widest'>Role</th>
							<th class='p-4 text-xs font-bold text-gray-500 uppercase tracking-widest'>Joined</th>
							<th class='p-4 text-xs font-bold text-gray-500 uppercase tracking-widest text-right'>Action</th>
						</tr>
					</thead>
					<tbody class='divide-y divide-gray-100'>
						@foreach($users as $u)
						<tr class='hover:bg-gray-50 transition-colors'>
							<td class='p-4'>
								<div class='flex items-center gap-3'>
									<div class='w-10 h-10 rounded-full border border-gray-200 overflow-hidden bg-white shadow-sm'>
										@if($u->profile && $u->profile->avatar)
											<img src='{{ $u->profile->avatar }}' class='w-full h-full object-cover'>
										@else
											<div class="w-full h-full flex items-center justify-center bg-blue text-white font-bold text-lg">
												{{ strtoupper(substr($u->username, 0, 1)) }}
											</div>
										@endif
									</div>
									<a href='{{ route('profile.show', $u->username) }}' class='font-bold text-gray-900 hover:text-blue transition-colors'>{{ $u->username }}</a>
								</div>
							</td>
							<td class='p-4 text-sm font-bold text-gray-500'>{{ $u->email }}</td>
							<td class='p-4'>
								@if($u->role === 'admin')
									<span class='px-2.5 py-1 bg-red-100 text-red-600 text-xs font-bold rounded'>Admin</span>
								@else
									<span class='px-2.5 py-1 bg-gray-100 text-gray-600 text-xs font-bold rounded'>User</span>
								@endif
							</td>
							<td class='p-4 text-sm font-bold text-gray-500'>{{ $u->created_at->format('M d, Y') }}</td>
							<td class='p-4 text-right'>
								<a href='{{ route('admin.users.edit', $u->username) }}' class='inline-block px-4 py-2 bg-white border border-gray-200 text-gray-700 text-xs font-bold rounded shadow-sm hover:bg-gray-50 transition-colors'>Edit</a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

@endsection
