<!DOCTYPE html>
<html lang="en">


<head>
    <base href="">
    <meta charset="utf-8" />
    <title>{{ config('app.name', 'Laravel') }} | {{ Route::currentRouteName() }}</title>
    <meta name="description" content="Updates and statistics">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="shortcut icon" href="{{ URL::asset('assets') }}/media/logos/qfavicon.ico" />
    <!--begin::Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">

    <!--end::Fonts -->

    <!--begin::Page Vendors Styles(used by this page) -->
    <link href="{{ URL::asset('assets') }}/plugins/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />

    <link href="{{ URL::asset('assets') }}/plugins/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Page Vendors Styles -->

    <!--begin::Global Theme Styles(used by all pages) -->
    <link href="{{ URL::asset('assets') }}/css/pages/wizard/wizard-1.css" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets') }}/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets') }}/css/style.bundle.css" rel="stylesheet" type="text/css" />

    <!--end::Global Theme Styles -->

    <!--begin::Layout Skins(used by all pages) -->
    <link href="{{ URL::asset('assets') }}/css/skins/header/base/light.css" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets') }}/css/skins/header/menu/light.css" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets') }}/css/skins/brand/dark.css" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets') }}/css/skins/aside/dark.css" rel="stylesheet" type="text/css" />


    <link href="{{ URL::asset('assets') }}/plugins/uppy/uppy.bundle.css" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets') }}/style.css" rel="stylesheet" type="text/css" />
    <!--end::Layout Skins -->

    <link rel="shortcut icon" href="{{ URL::asset('assets') }}/media/logos/qfavicon.ico" />

    <style>
        body {
            background: rgb(204, 204, 204);
        }

        page {
            background: white;
            display: block;
            margin: 0 auto;
            margin-top: 0.3cm !important;
            margin-bottom: 0.3cm;
            box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);
        }

        page[size="A4"] {
            width: 21cm;
            height: 29.7cm;
        }

        page[size="A4"][layout="landscape"] {
            width: 29.7cm;
            height: 21cm;
        }
    </style>

</head>

<body>
    <page size="A4">
        <div class="container h-100">
            <div class="row h-100 justify-content-center align-items-center">
                <form class="col-12">

                    <center>
                        <h1>Your Decision Already Marked</h1>

                        @if (Session::has('message'))
                        <br>
                        <br>
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('message') }}
                        </div>
                        @endif
                        <br>
                        <br>
                        You can view Details from bellow link:
                        <a href="{{ route('login') }}">View Details</a>
                    </center>
                </form>
            </div>
        </div>

    </page>

</body>

</html>