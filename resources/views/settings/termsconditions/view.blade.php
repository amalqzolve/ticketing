@extends('settings.common.layout')
@section('content')
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="kt-portlet">
			<div class="kt-portlet__head">
				<div class="kt-portlet__head-label">

				<h3 class="kt-portlet__head-title">Terms View</h3>
				</div>
				<a href="#" onclick="window.history.back();" class="btn kt-subheader_btn-primary">
									@lang('app.Back') 
								</a> 
			</div>
		
                  
          <div class="kt-portlet__body">
<table class="table table-striped table-hover table-checkable dataTable no-footer">
@foreach($data as $terms)


	<tr><td>Terms Name :</td>
		<td>{{$terms->term}}</td>
	</tr>
	<tr><td>Notes:</td>
		<td>{!! $terms->description !!}</td>
	</tr>
	
	
    
@endforeach
</table>
		</div>
	</div>
</div>

@endsection