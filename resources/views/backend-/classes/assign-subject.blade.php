@extends('settings.common.layout')

@section('content')
    <div class="roles">

        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-gray-700 uppercase font-bold">Assign Subject</h2>
            </div>
            <div class="flex flex-wrap items-center">
                <a href="{{ route('classes.index') }}" class="bg-gray-200 text-gray-700 text-sm uppercase py-2 px-4 flex items-center rounded">
                    
                    <span class="ml-2 text-xs font-semibold">Back</span>
                </a>
            </div>
        </div>

        <div class="table w-full mt-8 bg-white rounded">
            <form action="{{ route('store.class.assign.subject',$classid) }}" method="POST" class="w-full max-w-lg px-6 py-12">
                @csrf
                <div class="md:flex mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                            Assign Subject
                        </label>
                    </div>
                    <div class="md:w-2/3 block text-gray-600 font-bold">
                        @foreach ($subjects as $subject)
                            <div class="flex items-center">
                                <label>
                                    <input name="selectedsubjects[]" class="mr-2 leading-tight" type="checkbox" value="{{ $subject->id }}"
                                        @foreach ($assigned->subjects as $item)
                                            {{ ($item->id === $subject->id) ? 'checked' : '' }}
                                        @endforeach
                                    >
                                    <span class="text-sm">
                                        {{ $subject->name }}
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
                            Assign Subject
                        </button>
                    </div>
                </div>
            </form>        
        </div>

        <div class="w-full py-12">
            <h2 class="text-gray-700 uppercase font-bold my-2">Students</h2>
            <div class="flex items-center bg-gray-200">
                <div class="w-1/4 text-left text-gray-600 py-2 px-4 font-semibold">Name</div>
                <div class="w-1/4 text-left text-gray-600 py-2 px-4 font-semibold">Email</div>
                <div class="w-1/4 text-right text-gray-600 py-2 px-4 font-semibold">Phone</div>
                <div class="w-1/4 text-right text-gray-600 py-2 px-4 font-semibold">Parent</div>
            </div>
            @foreach ($assigned->students as $student)
                <div class="flex items-center justify-between border border-gray-200 mb-px">
                    <div class="w-1/4 text-left text-gray-600 py-2 px-4 font-medium">{{ $student->user->name }}</div>
                    <div class="w-1/4 text-left text-gray-600 py-2 px-4 font-medium">{{ $student->user->email }}</div>
                    <div class="w-1/4 text-right text-gray-600 py-2 px-4 font-medium">{{ $student->phone }}</div>
                    <div class="w-1/4 text-right text-gray-600 py-2 px-4 font-medium">{{ $student->parent->user->name }}</div>
                </div>
            @endforeach
        </div>
    </div>
@endsection