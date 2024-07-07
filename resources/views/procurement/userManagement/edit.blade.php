@extends('procurement.common.layout')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="{{ URL::asset('assets') }}/plugins/custom/uppy/uppy.bundle.css" rel="stylesheet" type="text/css" />
<script src="{{ URL::asset('assets') }}/plugins/custom/uppy/uppy.bundle.js" type="text/javascript"></script>

<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
  <br />
  <div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
      <div class="kt-portlet__head-label">
        <span class="kt-portlet__head-icon">
          <i class="kt-font-brand flaticon2-line-chart"></i>
        </span>
        <h3 class="kt-portlet__head-title">
          Approval Synthesis Users
        </h3>
      </div>
      <div class="kt-portlet__head-toolbar">
        <div class="kt-portlet__head-wrapper">
          <div class="kt-portlet__head-actions">
            <div class="dropdown dropdown-inline">
              <button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="la la-download"></i> Export
              </button>
              <div class="dropdown-menu dropdown-menu-right">
                <ul class="kt-nav">
                  <li class="kt-nav__section kt-nav__section--first">
                    <span class="kt-nav__section-text">Choose an option</span>
                  </li>
                  <li class="kt-nav__item" id="export-button-print">
                    <span href="#" class="kt-nav__link">
                      <i class="kt-nav__link-icon la la-print"></i>
                      <span class="kt-nav__link-text">Print</span>
                    </span>
                  </li>
                  <li class="kt-nav__item" id="export-button-copy">
                    <span class="kt-nav__link">
                      <i class="kt-nav__link-icon la la-copy"></i>
                      <span class="kt-nav__link-text">Copy</span>
                    </span>
                  </li>
                  <li class="kt-nav__item" id="export-button-csv">
                    <a href="#" class="kt-nav__link">
                      <i class="kt-nav__link-icon la la-file-text-o"></i>
                      <span class="kt-nav__link-text">CSV</span>
                    </a>
                  </li>
                  <li class="kt-nav__item" id="export-button-pdf">
                    <span class="kt-nav__link">
                      <i class="kt-nav__link-icon la la-file-pdf-o"></i>
                      <span class="kt-nav__link-text">PDF</span>
                    </span>
                  </li>
                </ul>
              </div>
            </div>
            &nbsp;

            <!-- <a href="{{ route('users.create') }}" type="button" class="btn btn-brand btn-elevate btn-icon-sm"><i class="la la-plus"></i>New Record</a>

            <a href="userInfoTrash" type="button" class="btn btn-danger btn-elevate btn-icon-sm">
              <i class="la la-trash"></i>
            </a> -->

          </div>
        </div>
      </div>
    </div>

    <div class="kt-portlet__body pl-2 pr-2 pb-0">

      @if (count($errors) > 0)
      <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif

      {!! Form::model('asd', ['method' => 'PATCH','route' => ['procurement-user-management.update', $user->id],'id'=>'userForm']) !!}
      <div class="row">
        <div class="col-lg-6">
          <div class="form-group  row pr-md-3">
            <div class="col-md-4">
              <label>Name</label>
            </div>
            <div class="col-md-8 input-group-sm">
              {!! Form::text('name', $user->name, array('placeholder' => 'Name','class' => 'form-control','readonly'=>'readonly')) !!}
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group  row pr-md-3">
            <div class="col-md-4">
              <label>Email</label>
            </div>
            <div class="col-md-8 input-group-sm">
              {!! Form::text('email', $user->email, array('placeholder' => 'Email','class' => 'form-control','readonly'=>'readonly')) !!}
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group  row pr-md-3">
            <div class="col-md-4">
              <label>Branch</label>
            </div>
            <div class="col-md-8 input-group-sm">
              <select class="form-control single-select" id="branch" name="branch" disabled>
                @foreach($branches as $branch)
                <option value="{{$branch->id}}" {{ ($branch->id == $user->branch)?'selected':'' }}> {{$branch->label}}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="form-group  row pr-md-3">
            <div class="col-md-4">
              <label>Department</label>
            </div>
            <div class="col-md-8 input-group-sm">
              <select class="form-control single-select" id="branch" name="department">
                <option value="">--select--</option>
                @foreach($department as $value)
                <option value="{{$value->id}}" {{ ($value->id == $user->department)?'selected':'' }}> {{$value->name}}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="form-group  row pr-md-3">
            <div class="col-md-4">
              <label>Designation</label>
            </div>
            <div class="col-md-8 input-group-sm">
              {!! Form::text('designation', $user->designation, array('placeholder' => 'Designation','class' => 'form-control','id' => 'designation')) !!}
            </div>
          </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group">
            <input type="hidden" name="fileData" id="fileData" value="{{$user->sign}}" />
            <div id="choose-files">
              <form action="/upload">
                <input type="file" id="files" name="files[]" accept="image/*" />
              </form>
            </div>
          </div>
        </div>


        <div class="kt-portlet__foot">
          <div class="kt-form__actions">
            <div class="row">
              <div class="col-lg-12 kt-align-right">

                <button type="reset" class="btn btn-secondary backHome"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x icon-16">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                  </svg> &nbsp;@lang('app.Cancel')</button>


                <button type="button" class="btn btn-primary" id="btnSubmit"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                  </svg> &nbsp;@lang('app.Save')</button>

              </div>
            </div>
          </div>
        </div>

      </div> <!-- ./row -->
      {!! Form::close() !!}
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

  div#kt_footer {
    display: none;
  }
</style>


<script>
  $('#btnSubmit').click(function() {
    var error = 0;
    if ($('#department').val() == '') {
      $('#department').addClass('is-invalid');
      error++;
    }
    if ($('#designation').val() == '') {
      $('#designation').addClass('is-invalid');
      error++;
    }
    if ($('#fileData').val() == '') {
      $('#fileData').addClass('is-invalid');
      toastr.warning('Upload a sign');
      error++;
    }

    if (error == 0)
      $('#userForm').submit();
    else
      toastr.warning('fill All Fields');
  })

  const uppy = Uppy.Core({
    autoProceed: false,
    allowMultipleUploads: false,
    restrictions: {
      maxNumberOfFiles: 1,
      minNumberOfFiles: 1,
      allowedFileTypes: ["image/*"]
    },
    meta: {
      brand_id: $('#id').val(),
    },
    onBeforeUpload: (files) => {
      fileData = [];
      const updatedFiles = {};
      Object.keys(files).forEach(fileID => {
        fileData.push('usersigns/' + files[fileID].name)
      })
      $('#fileData').val(fileData);

    },

  })

  uppy.use(Uppy.Dashboard, {
    metaFields: [{
        id: 'name',
        name: 'Name',
        placeholder: 'File name'
      },
      {
        id: 'caption',
        name: 'Caption',
        placeholder: 'describe what the image is about'
      }
    ],
    browserBackButtonClose: true,
    target: '#choose-files',
    inline: true,
    replaceTargetContent: true,
    width: '100%'
  })
  uppy.use(Uppy.Webcam, {
    target: Uppy.Dashboard
  })
  uppy.use(Uppy.XHRUpload, {
    endpoint: '../../user-sign-upload',
    fieldName: 'filenames[]',
    headers: {
      'X-CSRF-TOKEN': $('#token').val(),
    }
  })

  if ($('#fileData').val() != '') {
    var img_array = $('#fileData').val().split(",");
    console.log(img_array);
    $.each(img_array, function(i) {
      onuppyImageClicked('public/' + img_array[i]);
    });
  }

  function onuppyImageClicked(img) {

    var str = img.toString();
    var n = str.lastIndexOf('/');
    var img_name = str.substring(n + 1);
    // assuming the image lives on a server somewhere
    return fetch(img)
      .then((response) => response.blob()) // returns a Blob
      .then((blob) => {
        uppy.addFile({
          name: img_name,
          type: 'image/jpeg',
          data: blob
        })
      })
  }
</script>


@endsection