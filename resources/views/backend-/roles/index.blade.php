@extends('common.layout')

@section('content')
    <div class="roles-permissions">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-gray-700 uppercase font-bold">Roles &amp; Permissions</h2>
            </div>
            <div class="flex flex-wrap items-center">
                <a href="{{ route('role.create') }}" class="bg-gray-200 text-gray-700 text-sm uppercase py-2 px-4 mr-2 flex items-center rounded">
                    
                    <span class="ml-2 text-xs font-semibold">Role</span>
                </a>
                <a href="{{ route('permission.create') }}" class="bg-gray-200 text-gray-700 text-sm uppercase py-2 px-4 flex items-center rounded">
                    
                    <span class="ml-2 text-xs font-semibold">Permission</span>
                </a>
            </div>
        </div>
        <div class="mt-8 bg-white rounded border-b-4 border-gray-300">
            <div class="flex flex-wrap items-center uppercase text-sm font-semibold bg-gray-300 text-gray-600 rounded-tl rounded-tr">
                <div class="w-3/12 px-4 py-3">Role</div>
                <div class="w-7/12 px-4 py-3">Permissions</div>
                <div class="w-2/12 px-4 py-3 text-right">Edit</div>
            </div>
            @foreach ($roles as $role)
                <div class="flex flex-wrap items-center text-gray-700 border-t-2 border-l-4 border-r-4 border-gray-300">
                    <div class="w-3/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $role->name }}</div>
                    <div class="w-7/12 px-4 py-3 flex flex-wrap">
                        @foreach ($role->permissions as $permission)
                            <span class="bg-gray-200 text-sm mr-1 mb-1 px-2 border rounded-full">{{ $permission->name }}</span>
                        @endforeach
                    </div>
                    <div class="w-2/12 flex justify-end px-3">
                        <a href="{{ route('role.edit',$role->id) }}">
                           
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection