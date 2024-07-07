@extends('settings.common.layout')

@section('content')
    <div class="roles-permissions">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-gray-700 uppercase font-bold">Assign Role</h2>
            </div>
            <div class="flex flex-wrap items-center">
                <a href="{{ route('assignrole.create') }}" class="bg-gray-200 text-gray-700 text-sm uppercase py-2 px-4 flex items-center rounded">
                    
                    <span class="ml-2 text-xs font-semibold">User</span>
                </a>
            </div>
        </div>
        <div class="mt-8 bg-white rounded border-b-4 border-gray-300">
            <div class="flex flex-wrap items-center uppercase text-sm font-semibold bg-gray-300 text-gray-600 rounded-tl rounded-tr">
                <div class="w-3/12 px-4 py-3">Name</div>
                <div class="w-5/12 px-4 py-3">Email</div>
                <div class="w-2/12 px-4 py-3">Role</div>
                <div class="w-2/12 px-4 py-3 text-right">Assign</div>
            </div>
            @foreach ($users as $user)
                <div class="flex flex-wrap items-center text-gray-700 border-t-2 border-l-4 border-r-4 border-gray-300">
                    <div class="w-3/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $user->name }}</div>
                    <div class="w-5/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $user->email }}</div>
                    <div class="w-2/12 px-4 py-3 flex flex-wrap">
                        @foreach ($user->roles as $role)
                            <span class="bg-gray-200 text-xs font-semibold text-gray-600 tracking-tight px-3 py-1 border rounded-full">{{ $role->name }}</span>
                        @endforeach
                    </div>
                    <div class="w-2/12 flex justify-end px-3">
                        <a href="{{ route('assignrole.edit',$user->id) }}">
                           
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-8">
            {{ $users->links() }}
        </div>
    </div>
@endsection