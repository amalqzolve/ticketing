@extends('settings.common.layout')

@section('content')
    <div class="create">

        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-gray-700 uppercase font-bold">Attendance</h2>
            </div>
            <div class="flex flex-wrap items-center">
                <a href="{{ route('home') }}" class="bg-gray-200 text-gray-700 text-sm uppercase py-2 px-4 flex items-center rounded">
                    
                    <span class="ml-2 text-xs font-semibold">Back</span>
                </a>
            </div>
        </div>

        <div class="w-full mt-8 bg-white rounded">
            <div class="flex items-center justify-between px-6 py-6 pb-0">
                <div class="border-l-4 border-gray-600 pl-2">
                    <h2 class="text-gray-700 uppercase font-bold">{{ $attendances[0]->student->user->name ?? '' }}</h2>
                </div>
            </div>

            <div class="w-full px-6 py-6">
                <div class="flex items-center justify-between bg-gray-200 rounded-tl rounded-tr">
                    <div class="w-3/12 text-left text-gray-600 py-2 px-4 font-semibold">Date</div>
                    <div class="w-3/12 text-left text-gray-600 py-2 px-4 font-semibold">Teacher</div>
                    <div class="w-3/12 text-left text-gray-600 py-2 px-4 font-semibold">Class</div>
                    <div class="w-3/12 text-right text-gray-600 py-2 px-4 font-semibold">Attendence</div>
                </div>
                @foreach ($attendances as $attendance)
                    <div class="flex items-center justify-between border border-gray-200">
                        <div class="w-3/12 text-sm text-left text-gray-600 py-2 px-4 font-semibold">{{ $attendance->attendence_date }}</div>
                        <div class="w-3/12 text-sm text-left text-gray-600 py-2 px-4 font-semibold">{{ $attendance->teacher->user->name }}</div>
                        <div class="w-3/12 text-sm text-left text-gray-600 py-2 px-4 font-semibold">{{ $attendance->class->class_name }}</div>
                        <div class="w-3/12 text-xs text-right text-gray-600 py-2 px-4 font-semibold">
                            @if ($attendance->attendence_status)
                                <span class="bg-green-600 text-white px-2 py-1 rounded">Present</span>
                            @else
                                <span class="bg-red-600 text-white px-2 py-1 rounded">Absent</span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>        
        </div>

    </div>
@endsection