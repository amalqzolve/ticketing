@extends('crm.common.layout')
@section('content')

                                              @php
                                                foreach ($data as $key => $value)
                                                {
                                               $documents =isset($value->documents)? $value->documents :'';
                                                
                                                }


                                                @endphp


<div class="kt-grid__item kt-grid__item--fluid kt-todo__content" id="kt_todo_content">
								
								<div class="kt-portlet">
								    <div class="kt-portlet__head kt-portlet__head--noborder">
								        <div class="kt-portlet__head-label">
								            <h3 class="kt-portlet__head-title">
								            </h3>
								        </div>
								        
								    </div>
								    <div class="kt-portlet__body">

								        <!--begin::Widget -->
								        <div class="kt-widget__files">
								            <div class="kt-widget__media">
								                <img class="kt-widget__img kt-hidden-"
								                    src="{{ URL::asset('assets') }}/media/files/pdf.svg" alt="image">
                                            </div>
                                           @if(isset($documents))
                                            <a href="{{url('download')}}/<?php echo $documents; ?>"
                                                class="kt-widget__desc">
                                                Download
                                            </a>
                                            @endif
								        </div>

								        <!--end::Widget -->
								    </div>
								</div>
								</div>



@endsection