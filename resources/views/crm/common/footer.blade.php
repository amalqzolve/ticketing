          <!-- begin:: Footer -->
          <div class="kt-footer  kt-grid__item kt-grid kt-grid--desktop kt-grid--ver-desktop" id="kt_footer">
            <div class="kt-container  kt-container--fluid ">
              <div class="kt-footer__copyright">
                2024&nbsp;&copy;&nbsp;<a href="http://qzolve-trading.com/" target="_blank" class="kt-link">{{ __('Qzolve.com') }}</a>
              </div>

            </div>
          </div>

          <!-- end:: Footer -->
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

            function goPrev() {
              window.history.back();
            }

            $(document).ready(function() {
              $('.single-select').select2();
            });

            $('body').on('keypress keyup blur', '.integerVal', function(e) {
              $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
              if ((e.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                event.preventDefault();
              }
            });
            $("body").on("focusin", ".integerVal", function() {
              if (($(this).val() == 0) || ($(this).val() == '0.00'))
                $(this).val('');
            });
            $("body").on("focusout", ".integerVal", function() {
              if ($(this).val() == '')
                $(this).val('0');
            });
          </script>