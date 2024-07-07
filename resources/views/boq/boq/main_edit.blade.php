@extends('boq.common.layout')
@section('content')
<?php
foreach ($boqs as $boq) {
  $id = $boq->id;
  $projectname = $boq->projectname;
  $category_name = $boq->category_name;
  $description = $boq->description;
  $client = $boq->client;
  $type = $boq->type;
  $tender_id = $boq->tender_id;
  $date = ($boq->date != '') ? date('d-m-Y', strtotime($boq->date)) : date('d-m-Y');
}
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="{{ URL::asset('assets') }}/js/select2.min.js"></script>
<script src="{{ URL::asset('assets') }}/dist/spin.min.js"></script>
<script src="{{ URL::asset('assets') }}/dist/ladda.min.js"></script>
<link href="{{ URL::asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
  <br />
  <div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
      <div class="kt-portlet__head-label">
        <span class="kt-portlet__head-icon">
          <i class="kt-font-brand flaticon-home-2"></i>
        </span>
        <h3 class="kt-portlet__head-title">
          BOQ -Edit
        </h3>
      </div>
    </div>
    <div class="kt-portlet__body">
      <form class="kt-form">
        <div class="row" style="padding-bottom: 6px;">
          <input type="hidden" name="id" id="id" value="{{$id}}">

          <div class="col-lg-6">
            <div class="form-group row pl-0">
              <div class="col-md-4">
                <label>BOQ Type<span style="color: red">*</span></label>
              </div>
              <div class="col-md-8 input-group input-group-sm">
                <select class="form-control single-select kt-selectpicker" name="boq_type" id="boq_type">
                  <option value="">Select</option>
                  <option value="1" {{($type==1)?'selected':''}}>Tender</option>
                  <option value="2" {{($type==2)?'selected':''}}>Project</option>
                </select>
              </div>
            </div>
          </div>


          <div class="col-lg-6">
            <div class="form-group row pl-0">
              <div class="col-md-4">
                <label>Select Client<span style="color: red">*</span></label>
              </div>
              <div class="col-md-8 input-group input-group-sm">
                <select class="form-control single-select kt-selectpicker" name="client" id="client">
                  @foreach ($customers as $key => $value)
                  <option value="{{$value->id}}" {{($client == $value->id)?'selected':''}}>{{$value->cust_name}}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <!--  -->
            <div class="form-group row pl-0 tenderDiv" style="display: {{($type==1)?'':'none'}};">
              <div class="col-md-4">
                <label>Tender<span style="color: red">*</span></label>
              </div>
              <div class="col-md-8 input-group input-group-sm">
                <select class="form-control single-select kt-selectpicker" name="tender" id="tender">
                  <option value="">Select</option>
                  @foreach ($tender as $key => $value)
                  <option value="{{$value->id}}" {{($value->id==$tender_id)?'selected':''}}>TNDR {{$value->id}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <!--  -->
            <div class="form-group row pl-0 projectDiv" style="display: {{($type==2)?'':'none'}};">
              <div class="col-md-4">
                <label>Select Project<span style="color: red">*</span></label>
              </div>
              <div class="col-md-8 input-group input-group-sm">
                <select class="form-control single-select kt-selectpicker" name="projectname" id="projectname">
                  @foreach ($projects as $key => $value)
                  <option value="{{$value->id}}">{{$value->projectname}}</option>
                  @endforeach
                </select>
              </div>
            </div>

          </div>

          <div class="col-lg-6">
            <div class="form-group row pr-md-1">
              <div class="col-md-4">
                <label style="text-align: left;">BOQ Date<span style="color: red">*</span></label>
              </div>
              <div class="col-md-8">
                <div class="input-group  input-group-sm">
                  <input type="text" class="form-control kt_datetimepickerr" placeholder="" id="date" name="date" autocomplete="off" value="{{$date}}">
                </div>
              </div>
            </div>
          </div>


          <div class="col-lg-6">
            <div class="form-group row  pr-md-3">
              <div class="col-md-4">
                <label>Name</label>
              </div>
              <div class="col-md-8 input-group input-group-sm">
                <input type="text" class="form-control name" name="category_name" id="category_name" value="{{$category_name}}">
              </div>
            </div>
          </div>


          <div class="col-lg-6">
            <div class="form-group row pr-md-3">
              <div class="col-md-4">
                <label>Description</label>
              </div>
              <div class="col-md-8">
                <div class="input-group input-group-sm">
                  <textarea class="form-control" name="description" id="description" autocomplete="off">{{$description}}
                  </textarea>
                </div>
              </div>
            </div>
          </div>


        </div>

        <input type="hidden" name="main_id" id="main_id" value="{{$id}}">
        <div class="kt-portlet__foot">
          <div class="kt-form__actions">
            <div class="row">
              <div class="col-lg-6">
              </div>
              <div class="col-lg-6 kt-align-right">

                <button type="button" class="btn btn-secondary mr-2 backHome">
                  <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x icon-16">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                  </svg>
                  {{ __('app.Cancel') }}
                </button>
                <button id="mainupdate" class="btn btn-primary  float-right">
                  <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                  </svg>
                  {{ __('product.Update') }}
                </button>

              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<style type="text/css">
  .hideButton {
    display: none
  }

  .error {
    color: red
  }
</style>
@endsection
@section('script')
<script type="text/javascript">
  $('.list-boq').addClass('kt-menu__item--active');

  function goPrev() {
    window.history.back();
  }
  $(document).on('change', '#boq_type', function(e) {
    if ($(this).val() == 1) {
      $('.projectDiv').hide();
      $('.tenderDiv').show();
      $('#projectname').val('');
      $('#tender').val('');
    } else {
      $('.projectDiv').show();
      $('.tenderDiv').hide();
      $('#projectname').val('');
      $('#tender').val('');
    }
  });
  $(document).on('change', '#client', function() {
    var id = $(this).val();
    $.ajax({
      type: "POST",
      url: "load-project-from-client",
      dataType: "json",
      data: {
        _token: $('#token').val(),
        id: id,
      },
      success: function(data) {
        $('#projectname').empty().trigger("change");
        var newOption = new Option('--select--', '', false, false);
        if (data.status == 1) {
          $('#projectname').append(newOption).trigger('change');
          $.each(data.data, function(i, val) {
            var newOption = new Option(val.projectname, val.id, false, false);
            $('#projectname').append(newOption).trigger('change');
          });
        } else
          console.log('Error !!');

      },
      error: function(jqXhr, json, errorThrown) {
        console.log('Error !!');
      }
    });
  });

  $(document).on('click', '#mainupdate', function(e) {
    e.preventDefault();
    var error = 0;
    if ($('#boq_type').val() == "") {
      $('#boq_type').next().find('.select2-selection').addClass('select-dropdown-error');
      error++;
    } else
      $('#boq_type').next().find('.select2-selection').removeClass('select-dropdown-error');

    if ($('#boq_type').val() == 1) {
      if ($('#tender').val() == "") {
        $('#tender').next().find('.select2-selection').addClass('select-dropdown-error');
        error++;
      } else
        $('#tender').next().find('.select2-selection').removeClass('select-dropdown-error');
    } else {
      if ($('#projectname').val() == "") {
        $('#projectname').next().find('.select2-selection').addClass('select-dropdown-error');
        error++;
      } else
        $('#projectname').next().find('.select2-selection').removeClass('select-dropdown-error');
    }

    if ($('#client').val() == "") {
      $('#client').next().find('.select2-selection').addClass('select-dropdown-error');
      error++;
    } else
      $('#client').next().find('.select2-selection').removeClass('select-dropdown-error');

    if ($('#name').val() == "") {
      $('#name').addClass('is-invalid');
      error++;
    } else
      $('#name').removeClass('is-invalid');


    if (error == 0) {
      $(this).addClass('kt-spinner');
      $(this).prop("disabled", true);
      if ($('#id').val())
        var sucess_msg = 'Updated';
      else
        var sucess_msg = 'Created';
      $.ajax({
        type: "POST",
        url: "mainboqupdate",
        dataType: "json",
        data: {
          _token: $('#token').val(),
          id: $('#main_id').val(),
          category_name: $('#category_name').val(),
          name: $('#name').val(),
          description: $('#description').val(),
          projectname: $('#projectname').val(),
          client: $('#client').val(),
          type: $('#boq_type').val(),
          tender_id: $('#tender').val(),
          date: $('#date').val()
        },
        success: function(data) {
          $('#mainupdate').removeClass('kt-spinner');
          $('#mainupdate').prop("disabled", false);
          toastr.success('Updated successfuly');
          window.location = "{{url('/list-boq')}}";
        },
        error: function(jqXhr, json, errorThrown) {
          console.log('Error !!');
        }
      });
    } else
      toastr.warning("Please Fill mandatory Fields !!");

  });
</script>

<script src="{{url('/')}}/resources/js/inventory/select2.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/resources/js/inventory/select2.js" type="text/javascript"></script>
<script src="{{ URL::asset('assets') }}/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js" type="text/javascript"></script>

@endsection