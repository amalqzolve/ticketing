@extends('settings.common.layout')

@section('content')
    <div class="roles-permissions">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-gray-700 uppercase font-bold">Teacher</h2>
            </div>
            <div class="flex flex-wrap items-center">
                <a href="{{ route('teacher.create') }}" class="bg-gray-200 text-gray-700 text-sm uppercase py-2 px-4 flex items-center rounded">
                    
                    <span class="ml-2 text-xs font-semibold">Teacher</span>
                </a>
            </div>
        </div>
        <div class="mt-8 bg-white rounded border-b-4 border-gray-300">
            <div class="flex flex-wrap items-center uppercase text-sm font-semibold bg-gray-300 text-gray-600 rounded-tl rounded-tr">
                <div class="w-2/12 px-4 py-3">Name</div>
                <div class="w-3/12 px-4 py-3">Email</div>
                <div class="w-3/12 px-4 py-3">Subject Code</div>
                <div class="w-2/12 px-4 py-3">Phone</div>
                <div class="w-2/12 px-4 py-3 text-right">Action</div>
            </div>
            @foreach ($teachers as $teacher)
                <div class="flex flex-wrap items-center text-gray-700 border-t-2 border-l-4 border-r-4 border-gray-300">
                    <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $teacher->user->name }}</div>
                    <div class="w-3/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $teacher->user->email }}</div>
                    <div class="w-3/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">
                        @foreach ($teacher->subjects as $subject)
                            <span class="bg-gray-200 text-sm mr-1 mb-1 px-2 border rounded-full">{{ $subject->subject_code }}</span>
                        @endforeach
                    </div>
                    <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $teacher->phone }}</div>
                    <div class="w-2/12 flex items-center justify-end px-3">
                        <a href="{{ route('teacher.edit',$teacher->id) }}">
                           
                        </a>
                        <a href="{{ route('teacher.destroy', $teacher->id) }}" data-url="{{ route('teacher.destroy', $teacher->id) }}" class="deletebtn ml-1 bg-gray-600 block p-1 border border-gray-600 rounded-sm">
                            <svg class="h-3 w-3 fill-current text-gray-100" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="trash" class="svg-inline--fa fa-trash fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16zM53.2 467a48 48 0 0 0 47.9 45h245.8a48 48 0 0 0 47.9-45L416 128H32z"></path></svg>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-8">
            {{ $teachers->links() }}
        </div>

        @include('backend.modals.delete',['name' => 'teacher'])
    </div>
@endsection

@push('scripts')
<script>
    $(function() {
        $( ".deletebtn" ).on( "click", function(event) {
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