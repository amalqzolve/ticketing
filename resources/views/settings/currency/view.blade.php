@extends('settings.common.layout')
@section('content')
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="kt-portlet">
			<div class="kt-portlet__head">
				<div class="kt-portlet__head-label">

				<h3 class="kt-portlet__head-title">Currency View</h3>
				</div>
			</div>
		
                  
          <div class="kt-portlet__body">
<table class="table table-striped table-hover table-checkable dataTable no-footer">
@foreach($data as $currency)

	<tr><td>Currency Name :</td>
		<td>{{$currency->currency_name}}</td>
	</tr>
	<tr><td>Value:</td>
		<td>{{$currency->value}}</td>
	</tr>
	<tr><td>Symbol:</td>
		<td>{{$currency->symbol}}</td>
	</tr>
	<tr><td>Currency Default:</td>
		<td>{{$currency->currency_default}}</td>
	</tr>
	<tr><td>Note:</td>
		<td>{{$currency->note}}</td>
	</tr>
	
    
@endforeach
</table>
		</div>
	</div>
</div>

@endsection