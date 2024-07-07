					<!-- begin:: Footer -->
					<input type="hidden" id="ctm_code-error" value="{{ __('app.This field is required') }}" name="">

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

		<!-- end:: Page -->


		<!-- begin::Scrolltop -->
		<div id="kt_scrolltop" class="kt-scrolltop">
			<i class="fa fa-arrow-up"></i>
		</div>

		<!-- end::Scrolltop -->

		
		

		<!-- begin::Global Config(global config for global JS sciprts) -->
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
			.dataTables_wrapper .dataTable .selected th, .dataTables_wrapper .dataTable .selected td {
			    background-color: #e2e7f2;
			    color: #595d6e;
			}
		</style>

		<!-- end::Global Config -->



		<!--begin::Global Theme Bundle(used by all pages) -->
		<script src="{{ URL::asset('assets') }}/plugins/global/plugins.bundle.js" type="text/javascript"></script>
		<script src="{{ URL::asset('assets') }}/js/scripts.bundle.js" type="text/javascript"></script>

		<!--end::Global Theme Bundle -->

		<!--end::Global Theme Bundle -->

		<!--begin::Page Vendors(used by this page) -->
		<script src="{{ URL::asset('assets') }}/plugins/datatables/datatables.bundle.js" type="text/javascript"></script>

		<!--end::Page Vendors -->

		<!--begin::Page Scripts(used by this page) -->


<script src="{{ URL::asset('assets') }}/js/pdfmake.min.js"></script>
<script src="{{ URL::asset('assets') }}/js/vfs_fonts.js"></script>


<!-- Include the plugin's CSS and JS: -->
<!-- <link href="{{url('/')}}/css/select2.min.css" rel="stylesheet" /> -->
<script src="{{ URL::asset('assets') }}/js/select2.min.js"></script>

<script src="{{ URL::asset('assets') }}/js/user.js"></script>
<script src="{{ URL::asset('assets') }}/js/userActivity.js"></script>

<script src="{{ URL::asset('assets') }}/dist/spin.min.js"></script>
<script src="{{ URL::asset('assets') }}/dist/ladda.min.js"></script>

<script src="{{ URL::asset('assets') }}/plugins/uppy/uppy.bundle.js" type="text/javascript"></script>



		<!--end::Page Scripts -->
<script>
    $('.backHome').click(function(e) {
        e.preventDefault;
        // window.history.back();
        history.back();
    });
</script>
