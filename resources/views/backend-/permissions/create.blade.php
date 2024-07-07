@extends('settings.common.layout')

@section('content')
    <div class="permissions">

        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-gray-700 uppercase font-bold">Create Permission</h2>
            </div>
            <div class="flex flex-wrap items-center">
                <a href="{{ route('roles-permissions') }}" class="bg-gray-200 text-gray-700 text-sm uppercase py-2 px-4 mr-2 flex items-center rounded">
                    
                    <span class="ml-2 text-xs font-semibold">Back</span>
                </a>
                <a href="{{ route('role.create') }}" class="bg-gray-200 text-gray-700 text-sm uppercase py-2 px-4 flex items-center rounded">
                    
                    <span class="ml-2 text-xs font-semibold">Role</span>
                </a>
            </div>
        </div>

        <div class="mt-8 bg-white rounded">
            <form action="{{ route('permission.store') }}" method="POST" class="w-full max-w-lg px-6 py-12">
                @csrf
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
                            Permission Name
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input name="name" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-red-500" id="inline-full-name" type="text">
                        @error('name')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="md:flex mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
                            Roles
                        </label>
                    </div>
                    <div class="md:w-2/3 block text-gray-600 font-bold">
                        @foreach ($roles as $role)
                            <div class="flex items-center">
                                <label>
                                    <input name="selectedroles[]" class="mr-2 leading-tight" type="checkbox" value="{{ $role->name }}">
                                    <span class="text-sm">
                                        {{ $role->name }}
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
                            Create Permission
                        </button>
                    </div>
                </div>
            </form>        
        </div>

        <div class="mt-8 bg-white rounded border-b-4 border-gray-300">
         <!--    <div class="flex flex-wrap items-center uppercase text-sm font-semibold bg-gray-300 text-gray-600 rounded-tl rounded-tr">
                <div class="w-8/12 px-4 py-3">Permission</div>
                <div class="w-4/12 px-4 py-3 text-right">Edit</div>
            </div> -->
            @foreach ($permissions as $permission)
                <div class="flex flex-wrap items-center text-gray-700 border-t-2 border-l-4 border-r-4 border-gray-300">
                    <div class="w-8/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight"></div>
                    <div class="w-4/12 flex justify-end px-3">
                        <a href="{{ route('permission.edit',$permission->id) }}">
                           {{ $permission->name }}
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
@endsection