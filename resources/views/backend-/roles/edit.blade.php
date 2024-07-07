@extends('settings.common.layout')

@section('content')
    <div class="roles">

        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-gray-700 uppercase font-bold">Edit Role</h2>
            </div>
            <div class="flex flex-wrap items-center">
                <a href="{{ route('roles-permissions') }}" class="bg-gray-200 text-gray-700 text-sm uppercase py-2 px-4 mr-2 flex items-center rounded">
                    
                    <span class="ml-2 text-xs font-semibold">Back</span>
                </a>
                <a href="{{ route('role.create') }}" class="bg-gray-200 text-gray-700 text-sm uppercase py-2 px-4 mr-2 flex items-center rounded">
                    
                    <span class="ml-2 text-xs font-semibold">Role</span>
                </a>
                <a href="{{ route('permission.create') }}" class="bg-gray-200 text-gray-700 text-sm uppercase py-2 px-4 flex items-center rounded">
                    
                    <span class="ml-2 text-xs font-semibold">Permission</span>
                </a>
            </div>
        </div>

        <div class="table w-full mt-8 bg-white rounded">
            <form action="{{ route('role.update',$role->id) }}" method="POST" class="w-full max-w-lg px-6 py-12">
                @csrf
                @method('PUT')
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
                            Role Name
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input name="name" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-red-500" id="inline-full-name" type="text" value="{{ $role->name }}">
                        @error('name')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="md:flex mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
                            Permissions
                        </label>
                    </div>
                    <div class="md:w-2/3 block text-gray-600 font-bold">
                        @foreach ($permissions as $permission)
                            <div class="flex items-center">
                                <label>
                                    <input name="selectedpermissions[]" class="mr-2 leading-tight" type="checkbox" value="{{ $permission->name }}"
                                        @foreach ($role->permissions as $item)
                                            {{ ($item->id === $permission->id) ? 'checked' : '' }}
                                        @endforeach
                                    >
                                    <span class="text-sm">
                                        {{ $permission->name }}
                                    </span>
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="md:flex md:items-center">
                    <div class="md:w-1/3"></div>
                    <div class="md:w-2/3">
                        <button class="shadow bg-red-500 hover:bg-red-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
                            Update Role
                        </button>
                    </div>
                </div>
            </form>        
        </div>
        
    </div>
@endsection