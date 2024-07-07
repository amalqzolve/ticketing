@extends('settings.common.layout')
@section('content')
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="kt-portlet">
			<div class="kt-portlet__head">
				<div class="kt-portlet__head-label">

					<h3 class="kt-portlet__head-title">{{ __('settings.Tax List View') }}</h3>
				</div>
			</div>
		
                  
          <div class="kt-portlet__body">
<table class="table table-striped table-hover table-checkable dataTable no-footer">
@foreach($data as $settings)

	<tr><td>{{ __('app.Tax Name') }}:</td>
		<td>{{$settings->taxname}}</td>
	</tr>
	<tr><td>{{ __('settings.Tax Percentage') }}:</td>
		<td>{{$settings->tax_percentage}}</td>
	</tr>
	
    
@endforeach
</table>
		</div>
	</div>
</div>
@endsection