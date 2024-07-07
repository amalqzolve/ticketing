<!DOCTYPE html>
<html lang="en">

<head>
  <title>{{ config('app.name', 'Laravel') }} | {{ Route::currentRouteName() }}</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
  <!-- calender -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css" />

  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/locale-all.js"></script>
  <link rel="shortcut icon" href="{{ URL::asset('assets') }}/media/logos/qfavicon.ico" />
  <!-- /calender -->
  <style type="text/css">
    body {
      background-color: #eaedf2;
    }

    p,
    .fc-day-header {
      font-size: 12px;
    }

    .grid-container {
      display: grid;
      grid-template-columns: auto 10% 9% 9% 9% 9% 9% 9% 9% 9%;
      gap: 10px;
      background-color: #fff;
      padding: 10px;
    }

    .grid-container>div {
      background-color: #fff;
      text-align: center;
      font-size: 13px;
    }

    /*.grid-container > div p
    {
      position: absolute;
    }*/
    .grid-container>div i {
      font-size: 25px;
    }

    .grid-container>div#main i {
      font-size: 50px;
    }

    .box {
      padding: 20px 0;
      color: #08a2d8;
      aspect-ratio: 1/1;
      color: black;
    }

    .box:hover {
      color: white;
    }

    .grid-container>div:first-child {
      grid-column-start: 1;
      grid-column-end: 4;
      grid-row: 1 / span 2;
      /*background-image: url("img/Q_Logo.png");
      background-repeat: no-repeat;
      background-position: center center;
      background-size: 150px;*/
    }

    .grid-container>div.hovdiv {
      background-color: #c9ddd4;
      opacity: 0.6;
      transition: 0.5s;
    }

    .grid-container>div.hovdiv:hover {
      opacity: 1;
      background-color: rgb(42 117 58);
    }

    .grid-container>div.hovdiv:hover box {
      color: white;
    }

    a.fc-day-number {
      color: #08a2d8;
    }

    .grid-container>div.hovdiv a {
      text-decoration: none;
    }

    /*calender*/
    #calendar {
      max-width: 100%;
      margin: 40px auto;
      padding: 0 10px;
    }

    .fc-center h2 {
      font-size: 23px;
      margin-top: 10px;
    }

    /*calender*/
    .cardh {
      height: 451px;
      overflow-y: scroll;
    }

    .bglogo {
      background-color: #08a2d8;
    }

    #data {
      display: none;
    }

    .fc-state-active {
      background-color: #138496;
      color: white;
    }

    a.link {
      text-decoration: none;
      color: #707070;
    }

    .box img {
      width: 35px;
      height: 35px;
    }

    @media only screen and (max-width: 992px) {
      .grid-container {
        grid-template-columns: auto 18% 18% 18% 18%;
      }
    }

    @media only screen and (max-width: 768px) {
      .grid-container {
        grid-template-columns: auto auto auto;
      }

      .grid-container>div:first-child {
        height: 25vh;
      }
    }

    @media only screen and (min-height: 1100px) {
      .footer {
        position: absolute;
        bottom: 0;
      }
    }

    .topimg {
      width: 20px;
    }

    a.calender {
      padding: 3px 31px;
      background-image: url("img/calendar.png");
      background-repeat: no-repeat;
      background-position: left center;
      background-size: 15px;
    }

    a.calender:hover {
      background-image: url("img/calendar2.png");
      color: #b6dcfe !important;
    }

    a.logout {
      padding: 3px 31px;
      /* background-image: url("img/crm.png"); */
      background-repeat: no-repeat;
      background-position: left center;
      background-size: 15px;
    }

    a.logout:hover {
      /* background-image: url("img/crm.png"); */
      color: #b6dcfe !important;
    }

    p.m-0.text-center {
      font-size: 14px;
    }
  </style>
  <script>
    $(document).ready(function() {
      $("#droper").click(function() {
        $("#drop").slideToggle("slow");
      });
      $("#hide").mouseover(function() {
        $("#drop").slideUp("slow");
      });
    });
  </script>
</head>

<body>
  <div class="d-flex flex-column">
    <div class="container-fluid fixed-top">
      <div class="row">
        <div class="col-12 " style="height: 4px; display: block; background-color:#23bb43;"></div>
      </div>
      <div class="row">
        <div class="col-12 p-1" style="background-color: rgb(15 86 30); position: static; top: 0">
          <!-- Links -->
          <ul class="nav justify-content-end">
            <li class="nav-item">
              <a class="nav-link text-white pt-0 pb-0 calender" href="#" id="time"></a>
            </li>
            <li class="nav-item" id="droper">
              <a class="nav-link text-white pt-0 pb-0 logout" href="#">
                Hi, {{ Auth::user()->name }} <span class="badge badge-success"><i class="fa fa-user" aria-hidden="true"></i></span>
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
            </li>
          </ul>
          <div class="col-md-3 card p-0 shadow" style=" position: absolute; right: 0; top: 35px;  display: none;  z-index: 10;" id="drop">
            <img class="card-img-top" alt="Card image" src="{{url('public')}}/{{ Auth::user()->image }}">
            <div class="card-img-overlay">
              <div class="w-100 text-center p-0" style=" position: absolute; bottom: 0; left: 0; background-color: #08a2d88c; color: white;">
                <h4 class="card-title m-0">{{ Auth::user()->name }}</h4>
                <a class="btn btn-primary btn-sm btn-block" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <span id="hide">
      <div class="container pt-5">
        <div class="row">
          <div class="col-12">
            <div class="grid-container mt-3 w-100">
              <div class="d-flex" id="main">
                <div class="w-100 align-self-center" id="logo">
                  <img src="img/loooo.jpg" style="width: 300px; margin: auto" />
                </div>
                <div class="w-100 align-self-center text-white text-left pl-4 pr-4" id="data">
                  <!-- <i class="" aria-hidden="true" id="maini"></i> -->
                  <h3 id="hddata"></h3>
                  <p id="disdata"></p>
                </div>
              </div>

              @can('CSM Module')
              <div class="hovdiv" id="change">
                <a href="{{url('/')}}/crm">
                  <div class="w-100 box d-flex">
                    <div class="w-100 align-self-center text-center">
                      <img src="img/crm.png" />
                      <p class="m-0 text-center" dis="Client - Supplier Management System">
                        CSM
                      </p>
                    </div>
                  </div>
                </a>
              </div>
              @endcan


              @can('Tenders Module')
              <div class="hovdiv" id="change">
                <a href="{{url('/tenders/home')}}">
                  <div class="w-100 box d-flex">
                    <div class="w-100 align-self-center text-center">
                      <img src="img/tenders.png" />
                      <p class="m-0 text-center" dis="Tender Management System">
                        Tenders
                      </p>
                    </div>
                  </div>
                </a>
              </div>
              @endcan

              @can('BOQ Module')
              <div class="hovdiv" id="change">
                <a href="{{url('/')}}/boq">
                  <div class="w-100 box d-flex">
                    <div class="w-100 align-self-center text-center">
                      <!--  <i class="fa fa-user-o " aria-hidden="true"></i> -->
                      <img src="img/boq.png" />
                      <p class="m-0 text-center" dis="BOQ Management System">
                        BOQ
                      </p>
                    </div>
                  </div>
                </a>
              </div>
              @endcan

              @can('Estimation Module')
              <div class="hovdiv" id="change">
                <a href="{{url('/')}}/cost-estimation/dashboard">
                  <div class="w-100 box d-flex">
                    <div class="w-100 align-self-center text-center">
                      <!-- <i class="fa fa-contao" aria-hidden="true"></i> -->
                      <img src="img/cost.png" />
                      <p class="m-0 text-center" dis="Cost & Estimation Management System">
                        Estimation
                      </p>
                    </div>
                  </div>
                </a>
              </div>
              @endcan

              @can('Directory Module')
              <div class="hovdiv" id="change">
                <a href="{{url('material-directory/dashboard')}}">
                  <div class="w-100 box d-flex">
                    <div class="w-100 align-self-center text-center">
                      <img src="img/resource_directory.png" />
                      <p class="m-0 text-center" dis="Resource & Material Database">
                        Directory
                      </p>
                    </div>
                  </div>
                </a>
              </div>
              @endcan

              @can('Projects Module')
              <div class="hovdiv" id="change">
                <a href="{{url('/')}}/projects">
                  <div class="w-100 box d-flex">
                    <div class="w-100 align-self-center text-center">
                      <!-- <i class="fa fa-lightbulb-o" aria-hidden="true"></i> -->
                      <img src="img/projects.png" />
                      <p class="m-0 text-center" dis="Projects Management System">
                        Projects
                      </p>
                    </div>
                  </div>
                </a>
              </div>
              @endcan

              @can('Cost Center Module')
              <div class="hovdiv" id="change">
                <a href="{{url('cost-center')}}">
                  <div class="w-100 box d-flex">
                    <div class="w-100 align-self-center text-center">
                      <!-- <i class="fa fa-lightbulb-o" aria-hidden="true"></i> -->
                      <img src="img/cost_center.png" />
                      <p class="m-0 text-center" dis="Cost Center">
                        Cost Center
                      </p>
                    </div>
                  </div>
                </a>
              </div>
              @endcan

              @can('Team Module')
              <div class="hovdiv" id="change">
                <a href="{{url('/')}}/resourcemanagement">
                  <div class="w-100 box d-flex">
                    <div class="w-100 align-self-center text-center">
                      <!-- <i class="fa fa-lightbulb-o" aria-hidden="true"></i> -->
                      <img src="img/group.png" />
                      <p class="m-0 text-center" dis="Project's Human Resource Management System">
                        Team
                      </p>
                    </div>
                  </div>
                </a>
              </div>
              @endcan

              @can('Procurement Module')
              <div class="hovdiv" id="change">
                <a href="{{url('procurement/home')}}">
                  <div class="w-100 box d-flex">
                    <div class="w-100 align-self-center text-center">
                      <!-- <i class="fa fa-cogs" aria-hidden="true"></i> -->
                      <img src="img/procurement.png" />
                      <p class="m-0 text-center" dis="Procurement Management System">
                        Procurement
                      </p>
                    </div>
                  </div>
                </a>
              </div>
              @endcan

              @can('Purchase Module')
              <div class="hovdiv" id="change">
                <a href="{{url('/')}}/qpurchase_dashboard">
                  <div class="w-100 box d-flex">
                    <div class="w-100 align-self-center text-center">
                      <!-- <i class="fa fa-hashtag" aria-hidden="true"></i> -->
                      <img src="img/purchase.png" />
                      <p class="m-0 text-center" dis="Purchase Management System">
                        Purchase
                      </p>
                    </div>
                  </div>
                </a>
              </div>
              @endcan

              @can('Warehouse Module')
              <div class="hovdiv" id="change">
                <a href="{{url('/')}}/warehouse_select">
                  <div class="w-100 box d-flex">
                    <div class="w-100 align-self-center text-center">
                      <!-- <i class="fa fa-recycle" aria-hidden="true"></i> -->
                      <img src="img/warehouse.png" />
                      <p class="m-0 text-center" dis="Virtual & Physical Warehouse Management System">
                        Warehouse
                      </p>
                    </div>
                  </div>
                </a>
              </div>
              @endcan

              @can('Inventory Module')
              <div class="hovdiv" id="change">
                <a href="{{url('/')}}/inventory">
                  <div class="w-100 box d-flex">
                    <div class="w-100 align-self-center text-center">
                      <!-- <i class="fa fa-file-text" aria-hidden="true"></i> -->
                      <img src="img/inventory.png" />
                      <p class="m-0 text-center" dis="Material & Inventory Management System">
                        Inventory
                      </p>
                    </div>
                  </div>
                </a>
              </div>
              @endcan

              @can('Asset Module')
              <div class="hovdiv" id="change">
                <a href="{{url('/')}}/asset_manage">
                  <div class="w-100 box d-flex">
                    <div class="w-100 align-self-center text-center">
                      <!-- <i class="fa fa-money" aria-hidden="true"></i> -->
                      <img src="img/asset.png" />
                      <p class="m-0 text-center" dis="Physical and Digital Asset Management System">
                        Asset
                      </p>
                    </div>
                  </div>
                </a>
              </div>
              @endcan


              @can('Sales Module')
              <div class="hovdiv" id="change">
                <a href="{{url('/')}}/sales">
                  <a href="{{url('/')}}/sales_dashboard">
                    <div class="w-100 box d-flex">
                      <div class="w-100 align-self-center text-center">
                        <!-- <i class="fa fa-balance-scale" aria-hidden="true"></i> -->
                        <img src="img/sale.png" />
                        <p class="m-0 text-center" dis="Sales Management System">
                          Sales
                        </p>
                      </div>
                    </div>
                  </a>
              </div>
              @endcan


              @can('Operations Module')
              <div class="hovdiv" id="change">
                <a href="{{url('/')}}/operations">
                  <div class="w-100 box d-flex">
                    <div class="w-100 align-self-center text-center">
                      <!-- <i class="fa fa-wrench" aria-hidden="true"></i> -->
                      <img src="img/options.png" />
                      <p class="m-0 text-center" dis="Company Operations Management System">
                        Operations
                      </p>
                    </div>
                  </div>
                </a>
              </div>
              @endcan

              @can('Contracts Module')
              <div class="hovdiv" id="change">
                <a href="{{url('/')}}/contracts">
                  <div class="w-100 box d-flex">
                    <div class="w-100 align-self-center text-center">
                      <!-- <i class="fa fa-handshake-o" aria-hidden="true"></i> -->
                      <img src="img/contract.png" />
                      <p class="m-0 text-center" dis="Contracts and Agreement Management System">
                        Contracts
                      </p>
                    </div>
                  </div>
                </a>
              </div>
              @endcan

              @can('Recruitment Module')
              <div class="hovdiv" id="change">
                <a href="#">
                  <div class="w-100 box d-flex">
                    <div class="w-100 align-self-center text-center">
                      <!-- <i class="fa fa-search-plus" aria-hidden="true"></i> -->
                      <img src="img/recruitment.png" />
                      <p class="m-0 text-center" dis="Recruitment & its Operations Management System">
                        Recruitment
                      </p>
                    </div>
                  </div>
                </a>
              </div>
              @endcan

              @can('HR Module')
              <div class="hovdiv" id="change">
                <a href="#">
                  <div class="w-100 box d-flex">
                    <div class="w-100 align-self-center text-center">
                      <!-- <i class="fa fa-users" aria-hidden="true"></i> -->
                      <img src="img/hr.png" />
                      <p class="m-0 text-center" dis="Human Resource Database and its Operations Management System">
                        HR
                      </p>
                    </div>
                  </div>
                </a>
              </div>
              @endcan

              @can('Attendance Module')
              <div class="hovdiv" id="change">
                <a href="#">
                  <div class="w-100 box d-flex">
                    <div class="w-100 align-self-center text-center">
                      <!-- <i class="fa fa-calendar-check-o" aria-hidden="true"></i> -->
                      <img src="img/attendance.png" />
                      <p class="m-0 text-center" dis="Attendance, Leave, vaccation Management System">
                        Attendance
                      </p>
                    </div>
                  </div>
                </a>
              </div>
              @endcan

              @can('Payroll Module')
              <div class="hovdiv" id="change">
                <a href="#">
                  <div class="w-100 box d-flex">
                    <div class="w-100 align-self-center text-center">
                      <!-- <i class="fa fa-usd" aria-hidden="true"></i> -->
                      <img src="img/payroll.png" />
                      <p class="m-0 text-center" dis="Payroll and its Operations Management System">
                        Payroll
                      </p>
                    </div>
                  </div>
                </a>
              </div>
              @endcan
              @can('ESS Module')
              <div class="hovdiv" id="change">
                <a href="#">
                  <div class="w-100 box d-flex">
                    <div class="w-100 align-self-center text-center">
                      <!-- <i class="fa fa-user-o " aria-hidden="true"></i> -->
                      <img src="img/ess.png" />
                      <p class="m-0 text-center" dis="Employee Self Service Portal Management System">
                        ESS
                      </p>
                    </div>
                  </div>
                </a>
              </div>
              @endcan
              @can('Intranet Module')
              <div class="hovdiv" id="change">
                <a href="#">
                  <div class="w-100 box d-flex">
                    <div class="w-100 align-self-center text-center">
                      <!-- <i class="fa fa-sign-in" aria-hidden="true"></i> -->
                      <img src="img/intranet.png" />
                      <p class="m-0 text-center" dis="Intranet Corporate Communications Management System">
                        Intranet
                      </p>
                    </div>
                  </div>
                </a>
              </div>
              @endcan


              @can('Approval Module')
              <div class="hovdiv" id="change">
                <a href="{{url('/')}}/">
                  <div class="w-100 box d-flex">
                    <div class="w-100 align-self-center text-center">
                      <!-- <i class="fa fa-check-square-o" aria-hidden="true"></i> -->
                      <img src="img/approve.png" />
                      <p class="m-0 text-center" dis="Approval Management System">
                        Approval
                      </p>
                    </div>
                  </div>
                </a>
              </div>
              @endcan

              @can('Reminder Module')
              <div class="hovdiv" id="change">
                <a href="#">
                  <div class="w-100 box d-flex">
                    <div class="w-100 align-self-center text-center">
                      <!-- <i class="fa fa-bullhorn" aria-hidden="true"></i> -->
                      <img src="img/reminder.png" />
                      <p class="m-0 text-center" dis="Reminder Management System">
                        Reminder
                      </p>
                    </div>
                  </div>
                </a>
              </div>
              @endcan

              @can('Documentes Module')
              <div class="hovdiv" id="change">
                <a href="#">
                  <div class="w-100 box d-flex">
                    <div class="w-100 align-self-center text-center">
                      <!-- <i class="fa fa-file-text-o" aria-hidden="true"></i> -->
                      <img src="img/note.png" />
                      <p class="m-0 text-center" dis="Documents Upload and Its Expiry Notifications System">
                        Documentes
                      </p>
                    </div>
                  </div>
                </a>
              </div>
              @endcan

              @can('chat Room Module')
              <div class="hovdiv" id="change">
                <a href="{{url('suggestion-chat-room')}}">
                  <div class="w-100 box d-flex">
                    <div class="w-100 align-self-center text-center">
                      <!-- <i class="fa fa-sliders" aria-hidden="true"></i> -->
                      <img src="img/chat.png" />
                      <p class="m-0 text-center" dis="Electonic Communication ">
                        Chat Room
                      </p>
                    </div>
                  </div>
                </a>
              </div>
              @endcan

              @can('E-Sign Module')
              <div class="hovdiv" id="change">
                <a href="{{url('/e-sign/dashboard')}}">
                  <div class="w-100 box d-flex">
                    <div class="w-100 align-self-center text-center">
                      <!-- <i class="fa fa-file-text-o" aria-hidden="true"></i> -->
                      <img src="img/esign.png" />
                      <p class="m-0 text-center" dis="Electronic Signature Management System">
                        E-Sign
                      </p>
                    </div>
                  </div>
                </a>
              </div>
              @endcan


              @can('Help Module')
              <div class="hovdiv" id="change">
                <a href="{{url('/')}}/documentation">
                  <div class="w-100 box d-flex">
                    <div class="w-100 align-self-center text-center">
                      <!-- <i class="fa fa-question-circle-o" aria-hidden="true"></i> -->
                      <img src="img/help.png" />
                      <p class="m-0 text-center" dis="FAQ & Application Level Help Documents">
                        Help
                      </p>
                    </div>
                  </div>
                </a>
              </div>
              @endcan

              @can('Ticket Module')
              <div class="hovdiv" id="change">
                <a href="{{url('support_ticket')}}">
                  <div class="w-100 box d-flex">
                    <div class="w-100 align-self-center text-center">
                      <img src="img/support.png" />
                      <p class="m-0 text-center" dis="Client Support Ticketing System for Operations and Maintenance">
                        Ticket
                      </p>
                    </div>
                  </div>
                </a>
              </div>
              @endcan

              @can('Vouchers Module')
              <div class="hovdiv" id="change">
                <a href="{{url('/vouchers/home')}}">
                  <div class="w-100 box d-flex">
                    <div class="w-100 align-self-center text-center">
                      <img src="img/vouchers.png" />
                      <p class="m-0 text-center" dis="Receipt & Payment Vouchers Management System">
                        Vouchers
                      </p>
                    </div>
                  </div>
                </a>
              </div>
              @endcan

              @can('E-Treasury Module')
              <div class="hovdiv" id="change">
                <a href="{{url('/e-treasury/home')}}">
                  <div class="w-100 box d-flex">
                    <div class="w-100 align-self-center text-center">
                      <img src="img/treasury.png" />
                      <p class="m-0 text-center" dis="Electronic Treasury Management System for Payment">
                        E-Treasury
                      </p>
                    </div>
                  </div>
                </a>
              </div>
              @endcan

              @can('Accounts Module')
              <div class="hovdiv" id="change">
                <a href="{{url('/financial-entries/home')}}">
                  <div class="w-100 box d-flex">
                    <div class="w-100 align-self-center text-center">
                      <img src="img/financial_entries.png" />
                      <p class="m-0 text-center" dis="Ledger Entries Managment System">
                        Accounts
                      </p>
                    </div>
                  </div>
                </a>
              </div>
              @endcan

              @can('Br Finance Module')
              <div class="hovdiv" id="change">
                <a href="{{url('/')}}/sub-accounting">
                  <div class="w-100 box d-flex">
                    <div class="w-100 align-self-center text-center">
                      <!-- <i class="fa fa-pagelines" aria-hidden="true"></i> -->
                      <img src="img/branch.png" />
                      <p class="m-0 text-center" dis="Chart of Accounts, Group, Ledger Management System for Branch Accounting">
                        Br Finance
                      </p>
                    </div>
                  </div>
                </a>
              </div>
              @endcan

              @can('Co Finance Module')
              <div class="hovdiv" id="change">
                <a href="{{url('/')}}/main-accounting">
                  <div class="w-100 box d-flex">
                    <div class="w-100 align-self-center text-center">
                      <!-- <i class="fa fa-building-o" aria-hidden="true"></i> -->
                      <img src="img/company.png" />
                      <p class="m-0 text-center" dis="Financial Entries Management , Reports for Main Company">
                        Co Finance
                      </p>
                    </div>
                  </div>
                </a>
              </div>
              @endcan

              @can('Reports Module')
              <div class="hovdiv" id="change">
                <a href="{{url('/')}}/Reports">
                  <div class="w-100 box d-flex">
                    <div class="w-100 align-self-center text-center">
                      <!-- <i class="fa fa-pie-chart" aria-hidden="true"></i> -->
                      <img src="img/report.png" />
                      <p class="m-0 text-center" dis="Detailed Reports on Various Application">
                        Reports
                      </p>
                    </div>
                  </div>
                </a>
              </div>
              @endcan

              @can('Settings Module')
              <div class="hovdiv" id="change">
                <a href="{{url('tradingsettings')}}">
                  <div class="w-100 box d-flex">
                    <div class="w-100 align-self-center text-center">
                      <!-- <i class="fa fa-sliders" aria-hidden="true"></i> -->
                      <img src="img/settings.png" />
                      <p class="m-0 text-center" dis="Application Settings Management System">
                        Settings
                      </p>
                    </div>
                  </div>
                </a>
              </div>
              @endcan

            </div>
          </div>
        </div>
      </div>

      <div class="container-fluid footer fixed-bottom">
        <footer>
          <div class="row">
            <div class="col-12 p-1 text-center text-white" style="background-color: rgb(15 86 30);">
              <small>© Qzolve IT Solutions Pvt. Ltd</small>
            </div>
          </div>
          <div class="row">
            <div class="col-12" style="height: 4px; display: block; background-color:#23bb43;"></div>
          </div>
        </footer>
      </div>
  </div>
  </span>
  <script type="text/javascript">
    // calender
    $(document).ready(function() {
      $("#calendar").fullCalendar({
        locale: "in",
        header: {
          left: "prev,next today",
          center: "title",
          right: "month,basicWeek,basicDay",
        },
        defaultDate: "2018-03-12",
        navLinks: true, // can click day/week names to navigate views
        editable: true,
        eventLimit: true, // allow "more" link when too many events
        events: [{
            title: "All Day Event",
            start: "2018-03-01",
          },
          {
            title: "Long Event",
            start: "2018-03-07",
            end: "2018-03-10",
          },
          {
            id: 999,
            title: "Repeating Event",
            start: "2018-03-09T16:00:00",
          },
          {
            id: 999,
            title: "Repeating Event",
            start: "2018-03-16T16:00:00",
          },
          {
            title: "Conference",
            start: "2018-03-11",
            end: "2018-03-13",
          },
          {
            title: "Meeting",
            start: "2018-03-12T10:30:00",
            end: "2018-03-12T12:30:00",
          },
          {
            title: "Lunch",
            start: "2018-03-12T12:00:00",
          },
          {
            title: "Meeting",
            start: "2018-03-12T14:30:00",
          },
          {
            title: "Happy Hour",
            start: "2018-03-12T17:30:00",
          },
          {
            title: "Dinner",
            start: "2018-03-12T20:00:00",
          },
          {
            title: "Birthday Party",
            start: "2018-03-13T07:00:00",
          },
          {
            title: "Click for Google",
            url: "http://google.com/",
            start: "2018-03-28",
          },
        ],
      });
    });
    /*calender*/
  </script>
  <script type="text/javascript">
    $(document).on("mouseenter", "#change", function() {
      $imageUrl = "";
      $("#main").css("background-color", "rgb(15 86 30)");
      $("#logo").hide();
      $hd = $(this).find("a > div > div > p").text();
      $("#hddata").text($hd);
      $dis = $(this).find("a > div > div > p").attr("dis");
      $("#disdata").text($dis);
      $("#data").show();
    });
    $(document).on("mouseleave", "#change", function() {
      $imageUrl = "";
      $("#main").css("background-color", "white");
      $("#logo").show();
      $("#data").hide();
    });

    function timer() {
      const d = new Date();
      let date = d.getDate();
      let month = d.getMonth();
      let year = d.getFullYear();
      let hour = d.getHours();
      let mini = d.getMinutes();
      let secen = d.getSeconds();

      document.getElementById("time").innerHTML =
        date +
        "-" +
        month +
        "-" +
        year +
        " | " +
        hour +
        ":" +
        mini +
        ":" +
        secen;
    }
    setInterval(timer, 1000);
  </script>
</body>

</html>