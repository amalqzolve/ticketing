          <!-- begin:: Footer -->
          <div class="kt-footer  kt-grid__item kt-grid kt-grid--desktop kt-grid--ver-desktop" id="kt_footer">
            <div class="kt-container  kt-container--fluid ">
              <div class="kt-footer__copyright">
                2019&nbsp;&copy;&nbsp;<a href="http://qzolve-trading.com/" target="_blank" class="kt-link">{{ __('Qzolve.com') }}</a>
              </div>

            </div>
          </div>
          <!-- end:: Footer -->
          @php
          $usr=Auth::user();
          @endphp
          <!-- profile update -->
          <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static" data-keyboard="false" aria-hidden="true" style="min-width: 1024px;" id="profileModel">
            <div class="modal-dialog modal-xl" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel"> Profile Settigs</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                  <div class="card card-custom">
                    <!--begin::Header-->
                    <div class="card-header card-header-tabs-line">
                      <ul class="nav nav-dark nav-bold nav-tabs nav-tabs-line" data-remember-tab="tab_id" role="tablist">
                        <li class="nav-item">
                          <a class="nav-link active" data-toggle="tab" href="#kt_builder_themes">
                            Profile
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" data-toggle="tab" href="#kt_builder_header">
                            Upload Profile Pic
                          </a>
                        </li>

                      </ul>
                    </div>
                    <!--end::Header-->
                    <!--begin::Form-->
                    <form class="form" id="profileForm">
                      <!--begin::Body-->
                      <div class="card-body">
                        <div class="tab-content pt-3">
                          <!--begin::Tab Pane-->
                          <div class="tab-pane active" id="kt_builder_themes">
                            <div class="card card-custom card-stretch">
                              <input type="hidden" name="id" value="{{$usr->id}}">
                              <!--begin::Body-->
                              <div class="card-body">
                                <div class="form-group row">
                                  <label class="col-xl-3 col-lg-3 col-form-label"><!--Avatar--></label>
                                  <div class="col-lg-9 col-xl-6 " style="
                                  background-image: url('{{url('public')}}/{{ $usr->image }}');
                                      background-size: contain;
                                      background-repeat: no-repeat;
                                      height:150px;
                                  ">
                                    <!-- <img class="image-input" alt="Pic" src="{{url('public')}}/{{ $usr->image }}"> -->
                                  </div>
                                </div>
                                <br>
                                <br>
                                <div class="form-group row">
                                  <label class="col-xl-3 col-lg-3 col-form-label">Name</label>
                                  <div class="col-lg-9 col-xl-6">
                                    <input class="form-control form-control-lg form-control-solid" id="user_name" name="user_name" type="text" value="{{ $usr->name }}">
                                  </div>
                                </div>

                                <div class="row">
                                  <label class="col-xl-3"></label>
                                  <div class="col-lg-9 col-xl-6">
                                    <h5 class="font-weight-bold mt-10 mb-6">Contact Info</h5>
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label class="col-xl-3 col-lg-3 col-form-label">Contact Phone</label>
                                  <div class="col-lg-9 col-xl-6">
                                    <div class="input-group input-group-lg input-group-solid">
                                      <div class="input-group-prepend"><span class="input-group-text"><i class="la la-phone"></i></span></div>
                                      <input type="text" class="form-control form-control-lg form-control-solid" id="user_phone" name="user_phone" value="{{ $usr->phone }}" placeholder="Phone">
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label class="col-xl-3 col-lg-3 col-form-label">Email Address</label>
                                  <div class="col-lg-9 col-xl-6">
                                    <div class="input-group input-group-lg input-group-solid">
                                      <div class="input-group-prepend"><span class="input-group-text"><i class="la la-at"></i></span></div>
                                      <input type="text" class="form-control form-control-lg form-control-solid" value="{{ $usr->email }}" placeholder="Email" readonly>
                                    </div>
                                  </div>
                                </div>

                                <div class="form-group row">
                                  <label class="col-xl-3 col-lg-3 col-form-label text-alert">Current Password</label>
                                  <div class="col-lg-9 col-xl-6">
                                    <input type="password" class="form-control form-control-lg form-control-solid mb-2" name="current_password" id="current_password" placeholder="Current password">
                                    <i class="invalid-feedback"></i>
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label class="col-xl-3 col-lg-3 col-form-label text-alert">New Password</label>
                                  <div class="col-lg-9 col-xl-6">
                                    <input type="password" class="form-control form-control-lg form-control-solid" name="password" id="password" placeholder="New password">
                                    <i class="invalid-feedback"></i>
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <label class="col-xl-3 col-lg-3 col-form-label text-alert">Verify Password</label>
                                  <div class="col-lg-9 col-xl-6">
                                    <input type="password" class="form-control form-control-lg form-control-solid" name="password_confirmation" id="password_confirmation" placeholder="Verify password">
                                    <i class="invalid-feedback"></i>
                                  </div>
                                </div>


                              </div>
                              <!--end::Body-->

                            </div>
                          </div>
                          <!--end::Tab Pane-->

                          <!--begin::Tab Pane-->
                          <div class="tab-pane" id="kt_builder_header">

                            <div class="alert alert-solid-warning alert-bold fade show kt-margin-t-20 kt-margin-b-40" role="alert">
                              <div class="alert-icon"><i class="fa fa-exclamation-triangle"></i></div>
                              <div class="alert-text">
                                After Upload file ..... <br>Dont Forgot to Click Save Button !!
                              </div>
                              <div class="alert-close">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true"><i class="la la-close"></i></span>
                                </button>
                              </div>
                            </div>
                            <input type="hidden" name="fileDataProfile" id="fileDataProfile" value="" />
                            <div id="choose-files">
                              <input type="file" id="files" name="files[]" accept="image/*" />
                            </div>
                            <!--end::Tab Pane-->
                          </div>
                        </div>
                        <!--end::Body-->
                    </form>
                    <!--end::Form-->
                  </div>

                </div>

                <div class="modal-footer">
                  <button id="btnSaveProfile" class="btn btn-brand kt-spinner--right kt-spinner--sm kt-spinner--light">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-16">
                      <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                      <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                    &nbsp;Save
                  </button>
                </div>

              </div>
            </div>

          </div>
          <!-- ./profile -->


          </div>
          </div>
          </div>
          </div>
          </div>
          </div>
          </div>
          </div>
          <div id="kt_scrolltop" class="kt-scrolltop"> <i class="fa fa-arrow-up"></i>
          </div>
          <script>
            var KTAppOptions = {
              "colors": {
                "state": {
                  "brand": "#5d78ff",
                  "dark": "#282a3c",
                  "light": "#ffffff",
                  "primary": "#5867dd",
                  "success": "#34bfa3",
                  "info": "#36a3f7",
                  "warning": "#ffb822",
                  "danger": "#fd3995"
                },
                "base": {
                  "label": [
                    "#c5cbe3",
                    "#a1a8c3",
                    "#3d4465",
                    "#3e4466"
                  ],
                  "shape": [
                    "#f0f3ff",
                    "#d9dffa",
                    "#afb4d4",
                    "#646c9a"
                  ]
                }
              }
            };
          </script>
          <style type="text/css">
            .dataTables_wrapper .dataTable .selected th,
            .dataTables_wrapper .dataTable .selected td {
              background-color: #e2e7f2;
              color: #595d6e;
            }

            .hidden {
              display: none !important;
            }
          </style>

          <script src="{{ URL::asset('assets') }}/plugins/global/plugins.bundle.js" type="text/javascript"></script>
          <script src="{{ URL::asset('assets') }}/js/scripts.bundle.js" type="text/javascript"></script>
          <script src="{{ URL::asset('assets') }}/js/pages/components/extended/toastr.js" type="text/javascript"></script>
          <script src="{{ URL::asset('assets') }}/plugins/custom/uppy/uppy.bundle.js" type="text/javascript"></script>
          <script src="{{url('/resources/js/profileSettings.js')}}" type="text/javascript"></script>
          <script>
            $(document).ready(function() {
              toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
              };


              @if(Session::has('success'))

              toastr.success("{{ Session::get('success') }}");

              @endif


              @if(Session::has('info'))
              toastr.info("{{ Session::get('info') }}");
              @endif


              @if(Session::has('warning'))
              toastr.warning("{{ Session::get('warning') }}");
              @endif


              @if(Session::has('error'))
              toastr.error("{{ Session::get('error') }}");
              @endif
            });
          </script>

          <script>
            $('.backHome').click(function(e) {
              e.preventDefault;
              history.back();
            });

            // $(document).ready(function() {
            function loaderShow() {
              $('#preloaderContainer').show();
            }

            function loaderClose() {
              setTimeout(function() {
                $('#preloaderContainer').addClass('loaded');
                if ($('#preloaderContainer').hasClass('loaded')) {
                  // It is so that once the container is gone, the entire preloader section is deleted
                  $('#preloader').delay(9000).queue(function() {
                    $(this).remove();
                  });
                }
              }, 1000);
            }
            $(document).ready(function() {
              $('.kt-selectpicker').select2();
              $('.kt_datetimepicker').datepicker({
                todayHighlight: true,
                format: 'dd-mm-yyyy'
              }).on('changeDate', function(e) {
                $(this).datepicker('hide');
              })
            });

            function refreshItems() {
              $('.kt-selectpicker').select2();
              $('.kt_datetimepicker').datepicker({
                todayHighlight: true,
                format: 'dd-mm-yyyy'
              }).on('changeDate', function(e) {
                $(this).datepicker('hide');
              })
            }

            $('body').on('keypress keyup blur', '.integerVal', function(e) {
              $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
              if ((e.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                event.preventDefault();
              }
            });



            table = () => {
              $(".dataTable").wrap("<div class='table-responsive' ></div>");
            }

            setTimeout(table, 500);

            // });
          </script>