<!DOCTYPE html>

<html lang="en">

<!-- begin::Head -->

<head>
    <base href="../../../">
    <meta charset="utf-8" />
    <title>{{ config('app.name', 'Trading and Contracting') }} | {{ __('Login') }}</title>
    <meta name="description" content="Login page example">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--begin::Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">

    <!--end::Fonts -->

    <!--begin::Page Custom Styles(used by this page) -->
    <link href="{{ URL::asset('assets') }}/css/pages/login/login-5.css" rel="stylesheet" type="text/css" />

    <!--end::Page Custom Styles -->

    <!--begin::Global Theme Styles(used by all pages) -->
    <link href="{{ URL::asset('assets') }}/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets') }}/css/style.bundle.css" rel="stylesheet" type="text/css" />

    <!--end::Global Theme Styles -->

    <!--begin::Layout Skins(used by all pages) -->
    <link href="{{ URL::asset('assets') }}/css/skins/header/base/light.css" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets') }}/css/skins/header/menu/light.css" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets') }}/css/skins/brand/dark.css" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets') }}/css/skins/aside/dark.css" rel="stylesheet" type="text/css" />

    <!--end::Layout Skins -->
    <link rel="shortcut icon" href="{{ URL::asset('assets') }}/media/logos/qfavicon.ico" />
</head>
<style type="text/css">
    .select2-selection.select2-selection--single.is-invalid {
        border: 1px solid #ff003b !important;
        border-bottom: 1px solid #ff003b !important;
    }

    .is-invalid {
        border: 1px solid #ff003b !important;
        border-bottom: 1px solid #ff003b !important;
    }

    .btn-primary {
        background-color: #10a3dd !important;
        border-color: #10a3dd !important;
    }

    .text-primary {
        color: #10a3dd !important;
    }

    .bg-primary {
        background-color: #10a3dd !important;
    }

    /*   .mheight{
                min-height: 75vh  !important;
            }*/
    .select2 {
        width: 100% !important;
    }

    .nheight {
        height: 375px !important;
    }
</style>

<!-- end::Head -->

<!-- begin::Body -->

<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

    <div class="d-flex align-items-center bd-highlight h-100 mb-3">
        <div class=" mx-auto col-md-8 mh-100 nheight">
            <div class="row shadow ">
                <div class="col-md-5 rounded-left d-flex align-items-center bg-primary p-0 nheight">

                    <!--  style="background-image: url('{{ URL::asset("assets") }}/media/company-logos/dash.jpg');     background-size: cover;" -->
                    <!-- <img class="slide" src="{{ URL::asset('assets') }}/media/company-logos/dash.jpg" style="width:100%; height:100%;"/> -->

                    <!--  <div id="demo" class="carousel slide" style="width:100%; height:auto;" data-ride="carousel"> -->

                    <!-- Indicators -->


                    <!-- The slideshow -->
                    <!--  <div class="carousel-inner">
                                    <div class="carousel-item active" >
                                      <img class="slide" src="{{ URL::asset('assets') }}/media/company-logos/dash.jpg" style="width:100%; height:auto;"/>
                                    </div>
                                    
                                    <div class="carousel-item">
                                      <img class="slide" src="{{ URL::asset('assets') }}/media/company-logos/dash2.jpg" style="width:100%; height:auto;"/>
                                    </div>
                                  </div> -->

                    <!-- Left and right controls -->
                    <!-- <a class="carousel-control-prev" href="#demo" data-slide="prev">
                                    <span class="carousel-control-prev-icon"></span>
                                  </a>
                                  <a class="carousel-control-next" href="#demo" data-slide="next">
                                    <span class="carousel-control-next-icon"></span>
                                  </a>
 -->


                    <!--    </div> -->
                    <!-- <img src="{{ URL::asset('assets') }}/media/logos/logo-light.png" style="width:150px; margin:auto;"/> -->

                    <P style="font-size: 25px; color: white;  position: absolute;  bottom: 10px; left: 14px;">Qzolve <strong>ERP</strong></P>
                    <P style="font-size: 9px; color: white;  position: absolute;  bottom: 0; left: 14px;">Solution Beyond <span style="color:yellow; font-weight:bold;">Your</span> Imagination</P>

                </div>
                <div class="col-md-7 bg-white rounded-right p-0 d-flex align-items-center nheight">
                    <div class="col-12">
                        <!-- {{ URL::asset('assets') }}/media/company-logos/logo-2.png -->
                        <div class="col-6 mx-auto pb-5"><img src="{{url('public/login_logo/alim.png')}}" style="width: 280px; margin: auto;" /></div>

                        <form method="POST" id="login_form" action="{{ route('login') }}" class="pl-5 pr-5">
                            @csrf
                            <div class="form-group row">
                                <div class="col-3 pt-2">
                                    <label for="email">Email Address:</label>
                                </div>
                                <div class="col-9 ">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Username" autocomplete="email" autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-3 pt-2">
                                    <label for="pwd">Password:</label>
                                </div>
                                <div class="col-9 ">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" autocomplete="current-password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-3 pt-2">
                                    <label for="pwd">Select Branch:</label>
                                </div>
                                <div class="col-9 ">
                                    <select class="form-control single-select branch single-select kt-selectpicker" name="branch" id="branch">
                                        <option value="">Select Branch</option>
                                        @foreach($branches as $branch)
                                        <option value="{{$branch->id}}">
                                            {{$branch->label}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <button id="login_submit" class="btn btn-primary btn-block btn-elevate">
                                {{ __('Login') }}
                            </button>
                            <!-- <button type="submit" class="btn btn-primary btn-block">Submit</button> -->
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- begin:: Page -->
    <!-- <div class="kt-grid kt-grid--ver kt-grid--root">
            <div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v5 kt-login--signin" id="kt_login">
                <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--desktop kt-grid--ver-desktop kt-grid--hor-tablet-and-mobile" style="background-image: url({{ URL::asset('assets') }}/media/bg/bg-3.jpg);">
                    <div class="kt-login__left">
                        <div class="kt-login__wrapper">
                            <div class="kt-login__content">
                                <a class="kt-login__logo">
                                    <img src="{{ URL::asset('assets') }}/media/company-logos/logo-2.png">
                                </a>
                                <h3 class="kt-login__title">QZOLVE - TRADING</h3>
                                <span class="kt-login__desc">
                                    Better ERP Solutions For Your Logistics Business<br>
ERP Specialist in the Industry for Last 12 Years!
                                </span>
                                <div class="kt-login__actions">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kt-login__divider">
                        <div></div>
                    </div>
                    <div class="kt-login__right">
                        <div class="kt-login__wrapper">
                            <div class="kt-login__signin">
                                <div class="kt-login__head">
                                    <h3 class="kt-login__title">Login To Your Account</h3>
                                </div>
                                <div class="kt-login__form">
                                    
                <form class="kt-form"  method="POST" id="login_form" action="{{ route('login') }}">
                    
                    @csrf 
                    <div class="form-group">

                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Username"  autocomplete="email" autofocus>

                                                             

                    </div>                                        

                    <div class="form-group">



                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password"  autocomplete="current-password">

                  
                    </div>




  <div class="form-group">

                    <select class="form-control single-select branch single-select kt-selectpicker" name="branch" id="branch">
                                                        <option value="">Select Branch</option>
                                                            @foreach($branches as $branch)
                                                            <option value="{{$branch->id}}">
                                                                {{$branch->label}}</option>
                                                            @endforeach
                                                    </select>
                                                </div>



                                      
                                        <div class="kt-login__actions">



                  <button  id="login_submit" class="btn btn-primary btn-brand btn-pill btn-elevate">
                   {{ __('Login') }}
                  </button>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->

    <!-- end:: Page -->

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
        .kt-login.kt-login--v5 .kt-login__right .kt-login__wrapper .kt-login__form .form-control.is-invalid+.invalid-feedback {
            font-weight: 500;
            font-size: 0.9rem;
            padding-left: 0rem;
        }
    </style>

    <!-- end::Global Config -->

    <!--begin::Global Theme Bundle(used by all pages) -->
    <script src="{{ URL::asset('assets') }}/plugins/global/plugins.bundle.js" type="text/javascript"></script>
    <script src="{{ URL::asset('assets') }}/js/scripts.bundle.js" type="text/javascript"></script>

    <!--end::Global Theme Bundle -->
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

        $(document).ready(function() {
            $('.single-select').select2();
        });


        $(document).on('click', '#login_submit', function(e) {
            e.preventDefault();


            email = $('#email').val();
            password = $('#password').val();
            branch = $('#branch').val();


            if (email == "") {

                $('#email').addClass('is-invalid');
                toastr.warning('Username is required.');
                return false;
            } else {
                $('#email').removeClass('is-invalid');
            }

            if (password == "") {

                $('#password').addClass('is-invalid');
                toastr.warning('Password is required.');
                return false;
            } else {
                $('#password').removeClass('is-invalid');
            }

            if (branch == "") {

                $('#branch').next().find('.select2-selection').addClass('is-invalid');
                toastr.warning('Branch is required.');
                return false;
            } else {
                $('#branch').next().find('.select2-selection').removeClass('is-invalid');
            }



            $('form#login_form').submit();



        });
    </script>

    <!--begin::Page Scripts(used by this page) -->
    <!-- <script src="{{ URL::asset('assets') }}/js/pages/custom/login/login-general.js" type="text/javascript"></script> -->
    <script src="{{ URL::asset('js') }}/login.js" type="text/javascript"></script>

    <!--end::Page Scripts -->
</body>

<!-- end::Body -->

</html>