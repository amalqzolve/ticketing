@extends('settings.common.layout')
@section('content')
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="kt-portlet">
			<div class="kt-portlet__head">
				<div class="kt-portlet__head-label">

					<h3 class="kt-portlet__head-title">{{ __('settings.Tax Group List View') }}</h3>
				</div>
			</div>
		
                  
          <div class="kt-portlet__body">
<table class="table table-striped table-hover table-checkable dataTable no-footer">
@foreach($data as $group)

	<tr><td>{{ __('settings.Tax Group Name') }} :</td>
		<td>{{$group->taxgroup_name}}</td>
	</tr>
	<tr><td>{{ __('settings.Tax Percentage') }}:</td>
		<td>{{$group->total}}</td>
	</tr>
	<tr><td>{{ __('settings.Note') }}:</td>
		<td>{{$group->description}}</td>
	</tr>
	
    
@endforeach
</table>
		</div>
	</div>
</div>
@endsection