@extends('settings.common.layout')

@section('content')
    <div class="roles-permissions">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-gray-700 uppercase font-bold">Students</h2>
            </div>
            <div class="flex flex-wrap items-center">
                <a href="{{ route('student.create') }}" class="bg-gray-200 text-gray-700 text-sm uppercase py-2 px-4 flex items-center rounded">
                    
                    <span class="ml-2 text-xs font-semibold">Student</span>
                </a>
            </div>
        </div>
        <div class="mt-8 bg-white rounded border-b-4 border-gray-300">
            <div class="flex flex-wrap items-center uppercase text-sm font-semibold bg-gray-300 text-gray-600 rounded-tl rounded-tr">
                <div class="w-3/12 px-4 py-3">Name</div>
                <div class="w-3/12 px-4 py-3">Email</div>
                <div class="w-2/12 px-4 py-3">Class</div>
                <div class="w-2/12 px-4 py-3">Phone</div>
                <div class="w-2/12 px-4 py-3 text-right">Action</div>
            </div>
            @foreach ($students as $student)
                <div class="flex flex-wrap items-center text-gray-700 border-t-2 border-l-4 border-r-4 border-gray-300">
                    <div class="w-3/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $student->user->name }}</div>
                    <div class="w-3/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $student->user->email }}</div>
                    <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $student->class->class_name ?? '' }}</div>
                    <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $student->phone }}</div>
                    <div class="w-2/12 flex items-center justify-end px-3">
                        <a href="{{ route('student.show',$student->id) }}" class="ml-1 bg-gray-600 block p-1 border border-gray-600 rounded-sm" title="assign subject">
                            <svg class="h-3 w-3 fill-current text-gray-100" aria-hidden="true" focusable="false" data-prefix="far" data-icon="eye" class="svg-inline--fa fa-eye fa-w-18" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M288 144a110.94 110.94 0 0 0-31.24 5 55.4 55.4 0 0 1 7.24 27 56 56 0 0 1-56 56 55.4 55.4 0 0 1-27-7.24A111.71 111.71 0 1 0 288 144zm284.52 97.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400c-98.65 0-189.09-55-237.93-144C98.91 167 189.34 112 288 112s189.09 55 237.93 144C477.1 345 386.66 400 288 400z"></path></svg>
                        </a>
                        <a href="{{ route('student.edit',$student->id) }}" class="ml-1">
                           
                        </a>
                        <a href="{{ route('student.destroy', $student->id) }}" data-url="{!! URL::route('student.destroy', $student->id) !!}" class="deletestudent ml-1 bg-gray-600 block p-1 border border-gray-600 rounded-sm">
                            <svg class="h-3 w-3 fill-current text-gray-100" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="trash" class="svg-inline--fa fa-trash fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16zM53.2 467a48 48 0 0 0 47.9 45h245.8a48 48 0 0 0 47.9-45L416 128H32z"></path></svg>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-8">
            {{ $students->links() }}
        </div>

        @include('backend.modals.delete',['name' => 'student'])
    </div>
@endsection

@push('scripts')
<script>
    $(function() {
        $( ".deletestudent" ).on( "click", function(event) {
            event.preventDefault();
            $( "#deletemodal" ).toggleClass( "hidden" );
            var url = $(this).attr('data-url');
            $(".remove-record").attr("action", url);
        })        
        
        $( "#deletemodelclose" ).on( "click", function(event) {
            event.preventDefault();
            $( "#deletemodal" ).toggleClass( "hidden" );
        })
    })
</script>
@endpush