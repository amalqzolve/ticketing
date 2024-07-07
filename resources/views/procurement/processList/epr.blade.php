@extends('procurement.common.layout')
@section('content')

<style type="text/css">
    body {
        background: #f2f3f8;
    }

    .timeline {
        position: relative;
        width: 100%;
        padding: 30px 0;
    }

    .timeline .timeline-container {
        position: relative;
        width: 100%;
    }

    .timeline .timeline-end,
    .timeline .timeline-start,
    .timeline .timeline-year {
        position: relative;
        width: 100%;
        text-align: center;
        z-index: 1;
    }

    .timeline .timeline-end p,
    .timeline .timeline-start p,
    .timeline .timeline-year p {
        display: inline-block;
        width: 80px;
        height: 80px;
        margin: 0;
        padding: 30px 0;
        text-align: center;
        background: linear-gradient(#4F84C4, #00539C);
        border-radius: 100px;
        box-shadow: 0 0 5px rgba(0, 0, 0, .4);
        color: #ffffff;
        font-size: 11px;
        text-transform: uppercase;
    }

    .timeline .timeline-year {
        margin: 30px 0;
    }

    .timeline .timeline-continue {
        position: relative;
        width: 100%;
        padding: 60px 0;
    }

    .timeline .timeline-continue::after {
        position: absolute;
        content: "";
        width: 1px;
        height: 100%;
        top: 0;
        left: 50%;
        margin-left: -1px;
        background: #4F84C4;
    }

    .timeline .row.timeline-left,
    .timeline .row.timeline-right .timeline-date {
        text-align: right;
    }

    .timeline .row.timeline-right,
    .timeline .row.timeline-left .timeline-date {
        text-align: left;
    }

    .timeline .timeline-date {
        font-size: 14px;
        font-weight: 600;
        margin: 41px 0 0 0;
    }

    .timeline .timeline-date::after {
        content: '';
        display: block;
        position: absolute;
        width: 14px;
        height: 14px;
        top: 45px;
        background: linear-gradient(#4F84C4, #00539C);
        box-shadow: 0 0 5px rgba(0, 0, 0, .4);
        border-radius: 15px;
        z-index: 1;
    }

    .timeline .row.timeline-left .timeline-date::after {
        left: -7px;
    }

    .timeline .row.timeline-right .timeline-date::after {
        right: -7px;
    }

    .timeline .timeline-box,
    .timeline .timeline-launch {
        position: relative;
        display: inline-block;
        margin: 15px;
        padding: 20px;
        border: 1px solid #dddddd;
        border-radius: 6px;
        background: #ffffff;
    }

    .timeline .timeline-launch {
        width: 100%;
        margin: 15px 0;
        padding: 0;
        border: none;
        text-align: center;
        background: transparent;
    }

    .timeline .timeline-box::after,
    .timeline .timeline-box::before {
        content: '';
        display: block;
        position: absolute;
        width: 0;
        height: 0;
        border-style: solid;
    }

    .timeline .row.timeline-left .timeline-box::after,
    .timeline .row.timeline-left .timeline-box::before {
        left: 100%;
    }

    .timeline .row.timeline-right .timeline-box::after,
    .timeline .row.timeline-right .timeline-box::before {
        right: 100%;
    }

    .timeline .timeline-launch .timeline-box::after,
    .timeline .timeline-launch .timeline-box::before {
        left: 50%;
        margin-left: -10px;
    }

    .timeline .timeline-box::after {
        top: 26px;
        border-color: transparent transparent transparent #ffffff;
        border-width: 10px;
    }

    .timeline .timeline-box::before {
        top: 25px;
        border-color: transparent transparent transparent #dddddd;
        border-width: 11px;
    }

    .timeline .row.timeline-right .timeline-box::after {
        border-color: transparent #ffffff transparent transparent;
    }

    .timeline .row.timeline-right .timeline-box::before {
        border-color: transparent #dddddd transparent transparent;
    }

    .timeline .timeline-launch .timeline-box::after {
        top: -20px;
        border-color: transparent transparent #dddddd transparent;
    }

    .timeline .timeline-launch .timeline-box::before {
        top: -19px;
        border-color: transparent transparent #ffffff transparent;
        border-width: 10px;
        z-index: 1;
    }

    .timeline .timeline-box .timeline-icon {
        position: relative;
        width: 40px;
        height: auto;
        float: left;
    }

    .timeline .timeline-icon i {
        font-size: 25px;
        color: #4F84C4;
    }

    .timeline .timeline-box .timeline-text {
        position: relative;
        width: calc(100% - 40px);
        float: left;
    }

    .timeline .timeline-launch .timeline-text {
        width: 100%;
    }

    .timeline .timeline-text h3 {
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 3px;
    }

    .timeline .timeline-text p {
        font-size: 14px;
        font-weight: 400;
        margin-bottom: 0;
    }

    @media (max-width: 768px) {
        .timeline .timeline-continue::after {
            left: 40px;
        }

        .timeline .timeline-end,
        .timeline .timeline-start,
        .timeline .timeline-year,
        .timeline .row.timeline-left,
        .timeline .row.timeline-right .timeline-date,
        .timeline .row.timeline-right,
        .timeline .row.timeline-left .timeline-date,
        .timeline .timeline-launch {
            text-align: left;
        }

        .timeline .row.timeline-left .timeline-date::after,
        .timeline .row.timeline-right .timeline-date::after {
            left: 47px;
        }

        .timeline .timeline-box,
        .timeline .row.timeline-right .timeline-date,
        .timeline .row.timeline-left .timeline-date {
            margin-left: 55px;
        }

        .timeline .timeline-launch .timeline-box {
            margin-left: 0;
        }

        .timeline .row.timeline-left .timeline-box::after {
            left: -20px;
            border-color: transparent #ffffff transparent transparent;
        }

        .timeline .row.timeline-left .timeline-box::before {
            left: -22px;
            border-color: transparent #dddddd transparent transparent;
        }

        .timeline .timeline-launch .timeline-box::after,
        .timeline .timeline-launch .timeline-box::before {
            left: 30px;
            margin-left: 0;
        }
    }
</style>

<script src="https://www.w3schools.com/lib/w3.js"></script>

<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid mb-5">
    <br />
    <div class="container-fluid">

        <div class="kt-portlet kt-portlet--mobile">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <div class="timeline">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="timeline-container">
                                            <div class="timeline-end">
                                                <p>EPR</p>
                                            </div>
                                            <div class="timeline-continue">

                                                <div class="row timeline-right">
                                                    <div class="col-md-6">
                                                        <p class="timeline-date">
                                                            {{date('d M Y',strtotime($epr['data']->quotedate))}}
                                                        </p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="timeline-box">
                                                            <div class="timeline-icon">
                                                                <i class="fa fa-gift"></i>
                                                            </div>
                                                            <div class="timeline-text">
                                                                <h3> ID : EPR {{$epr['data']->id}} </h3>
                                                                <p>created By : {{$epr['data']->created_name}}</p>
                                                                <p>Requested Date : {{ date('d-m-Y',strtotime($epr['data']->quotedate))}}</p>
                                                                <p>Required Date : {{ date('d-m-Y',strtotime($epr['data']->dateofsupply))}}</p>
                                                                <p>Request type : {{($epr['data']->request_type==1)?'Internal use':''}}{{($epr['data']->request_type==2)?'Department use':''}}{{($epr['data']->request_type==3)?'Personal use':''}}{{($epr['data']->request_type==4)?'Project Purpose':''}}</p>
                                                                <p>MR Category : {{$epr['data']->mr_category_name}}</p>
                                                                <p>Request Priority : {{($epr['data']->request_priority==1)?'Low':''}}{{($epr['data']->request_priority==2)?'Medium':''}}{{($epr['data']->request_priority==3)?'High':''}}{{($epr['data']->request_priority==4)?'Top':''}}</p>
                                                                <p>Request against : {{($epr['data']->request_against==1)?'BOQ':''}}{{($epr['data']->request_against==2)?'Non BOQ':''}}{{($epr['data']->request_against==2)?'Stock Request':''}}</p>
                                                                <p>Client : {{$epr['data']->client}}</p>
                                                                <p>Project : {{$epr['data']->project}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row timeline-left">
                                                    <div class="col-md-6 d-md-none d-block">
                                                        <p class="timeline-date">
                                                            Synthesis
                                                        </p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="timeline-box">
                                                            <div class="timeline-icon d-md-none d-block">
                                                                <i class="fa fa-business-time"></i>
                                                            </div>
                                                            <div class="timeline-text">
                                                                <h3>Synthesis</h3>
                                                                @foreach ($epr['synt'] as $key => $value)
                                                                <?php
                                                                $timeOfStatus = "";
                                                                if ($value->status == 1) {
                                                                    $status = 'Approval Pending from';
                                                                    $timeOfStatus = "";
                                                                    $class = "blue";
                                                                }
                                                                if ($value->status == 2) {
                                                                    // $status = 'Approved ';
                                                                    $status = $value->if_accepted_note;
                                                                    $timeOfStatus = date('d-m-Y H:i:s', strtotime($value->updated_at));
                                                                    $class = "green";
                                                                } else if ($value->status == 3) {
                                                                    $status = 'Returned';
                                                                    $timeOfStatus = date('d-m-Y H:i:s', strtotime($value->updated_at));
                                                                    $class = "orange";
                                                                } else if ($value->status == 4) {
                                                                    // $status = 'Rejected';
                                                                    $status = $value->if_rejected_note;
                                                                    $timeOfStatus = date('d-m-Y H:i:s', strtotime($value->updated_at));
                                                                    $class = "red";
                                                                }
                                                                ?>
                                                                <p>
                                                                    <span style="color: {{$class}}">
                                                                        {{$value->name}} {{$status}} : {{$timeOfStatus}}
                                                                        <br>
                                                                        {{$value->comments}}
                                                                    </span>
                                                                </p>
                                                                @endforeach
                                                            </div>
                                                            <div class="timeline-icon d-md-block d-none">
                                                                <i class="fa fa-business-time"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 d-md-block d-none">
                                                        <p class="timeline-date">
                                                            Synthesis
                                                        </p>
                                                    </div>
                                                </div>
                                                <!-- rfq -->
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="timeline-year">
                                                            <p>RFQ</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                @php
                                                $sideOption=0;
                                                @endphp
                                                @foreach ($rfq as $key => $value)
                                                <?php
                                                if ($sideOption % 2 == 0) {
                                                    $side = 'timeline-right';
                                                    $loverCls = 'd-md-none d-block';
                                                    $uperClass = "";
                                                } else {
                                                    $side = "timeline-left";
                                                    $loverCls = "";
                                                    $uperClass = 'd-md-none d-block';
                                                }
                                                $sideOption++;
                                                ?>
                                                <div class="row {{$side}}">
                                                    <div class="col-md-6 {{$uperClass}}">
                                                        <p class="timeline-date">
                                                            {{date('d M Y',strtotime($value->rfq_date))}}
                                                        </p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="timeline-box">
                                                            <div class="timeline-icon {{$uperClass}}">
                                                                <i class="fa fa-home"></i>
                                                            </div>
                                                            <div class="timeline-text">
                                                                <h3>RFQ {{$value->id}}</h3>
                                                                <p>Created : {{$value->created_name}}</p>
                                                                <p>RFQ Date : {{date('d M Y',strtotime($value->rfq_date))}} </p>
                                                                <p>RFQ Valid Till : {{date('d M Y',strtotime($value->rfq_valid_till))}}</p>
                                                                <p>Supplier Name : {{$value->sup_name}}</p>
                                                                @if($value->status==2)
                                                                <p>Supplier quote ID : {{$value->supp_quot_id}}</p>
                                                                <p>Quote Date {{$value->quot_date}}</p>
                                                                <p>Quote Valid Date : {{date('d M Y',strtotime($value->quote_valid_date))}}</p>
                                                                @endif

                                                            </div>
                                                            <div class="timeline-icon {{$loverCls}}">
                                                                <i class="fa fa-home"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 {{$loverCls}}">
                                                        <p class="timeline-date">
                                                            {{date('d M Y',strtotime($value->rfq_date))}}
                                                        </p>
                                                    </div>
                                                </div>

                                                @endforeach

                                                <!-- ./rfq -->
                                                <!-- po -->
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="timeline-year">
                                                            <p>PO</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                @foreach ($po as $key => $value)
                                                <?php
                                                if ($sideOption % 2 == 0) {
                                                    $side = 'timeline-right';
                                                    $loverCls = 'd-md-none d-block';
                                                    $uperClass = "";
                                                } else {
                                                    $side = "timeline-left";
                                                    $loverCls = "";
                                                    $uperClass = 'd-md-none d-block';
                                                }
                                                $sideOption++;
                                                ?>
                                                <div class="row {{$side}}">
                                                    <div class="col-md-6 {{$uperClass}}">
                                                        <p class="timeline-date">
                                                            {{date('d M Y',strtotime($value['po']->po_date))}}
                                                        </p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="timeline-box">
                                                            <div class="timeline-icon {{$uperClass}}">
                                                                <i class="fa fa-home"></i>
                                                            </div>
                                                            <div class="timeline-text">
                                                                <h3>PO {{$value['po']->id}}</h3>
                                                                <p>Created : {{$value['po']->created_name}}</p>
                                                                <p>PO Date : {{date('d M Y',strtotime($value['po']->po_date))}} </p>
                                                                <p>PO Valid Till : {{date('d M Y',strtotime($value['po']->po_valid_till))}}</p>
                                                                <p>delivery_terms : {{$value['po']->delivery_terms}}</p>
                                                                <p>Supplier Name : {{$value['po']->sup_name}}</p>
                                                            </div>
                                                            <div class="timeline-icon {{$loverCls}}">
                                                                <i class="fa fa-home"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 {{$loverCls}}">
                                                        <p class="timeline-date">
                                                            {{date('d M Y',strtotime($value['po']->po_date))}}
                                                        </p>
                                                    </div>
                                                </div>
                                                <!-- synthesis -->
                                                @if($value['po']->status!=1||$value['po']->status!=0)
                                                <?php
                                                if ($sideOption % 2 == 0) {
                                                    $side = 'timeline-right';
                                                    $loverCls = 'd-md-none d-block';
                                                    $uperClass = "";
                                                } else {
                                                    $side = "timeline-left";
                                                    $loverCls = "";
                                                    $uperClass = 'd-md-none d-block';
                                                }
                                                $sideOption++;

                                                ?>
                                                <div class="row {{$side}}">
                                                    <div class="col-md-6 {{$uperClass}}">
                                                        <p class="timeline-date">
                                                            Synthesis
                                                        </p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="timeline-box">
                                                            <div class="timeline-icon {{$uperClass}}">
                                                                <i class="fa fa-home"></i>
                                                            </div>
                                                            <div class="timeline-text">
                                                                <!-- <h3>Synthesis</h3> -->
                                                                @foreach ($value['syn'] as $key => $valueIn)
                                                                <?php
                                                                $timeOfStatus = "";
                                                                if ($valueIn->status == 1) {
                                                                    $status = 'Approval Pending from';
                                                                    $timeOfStatus = date('d-m-Y H:i:s', strtotime($valueIn->updated_at));
                                                                    $class = "blue";
                                                                }
                                                                if ($valueIn->status == 2) {
                                                                    $status = 'Approved ';
                                                                    $timeOfStatus = date('d-m-Y H:i:s', strtotime($valueIn->updated_at));
                                                                    $class = "green";
                                                                } else if ($valueIn->status == 3) {
                                                                    $status = 'Returned';
                                                                    $timeOfStatus = date('d-m-Y H:i:s', strtotime($valueIn->updated_at));
                                                                    $class = "orange";
                                                                } else if ($valueIn->status == 4) {
                                                                    $status = 'Rejected';
                                                                    $timeOfStatus = date('d-m-Y H:i:s', strtotime($valueIn->updated_at));
                                                                    $class = "red";
                                                                }
                                                                ?>
                                                                <p>
                                                                    <span style="color: {{$class}}">
                                                                        {{$valueIn->name}} {{$status}} : {{$timeOfStatus}}
                                                                    </span>
                                                                </p>
                                                                @endforeach
                                                            </div>
                                                            <div class="timeline-icon {{$loverCls}}">
                                                                <i class="fa fa-home"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 {{$loverCls}}">
                                                        <p class="timeline-date">
                                                            Synthesis
                                                        </p>
                                                    </div>
                                                </div>

                                                @endif
                                                @endforeach

                                                <!-- ./po -->

                                                <!-- GRN -->
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="timeline-year">
                                                            <p>GRN</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                @foreach ($grn as $key => $value)
                                                <?php
                                                if ($sideOption % 2 == 0) {
                                                    $side = 'timeline-right';
                                                    $loverCls = 'd-md-none d-block';
                                                    $uperClass = "";
                                                } else {
                                                    $side = "timeline-left";
                                                    $loverCls = "";
                                                    $uperClass = 'd-md-none d-block';
                                                }
                                                $sideOption++;
                                                ?>
                                                <div class="row {{$side}}">
                                                    <div class="col-md-6 {{$uperClass}}">
                                                        <p class="timeline-date">
                                                            {{date('d M Y',strtotime($value['grn']->grn_created_date))}}
                                                        </p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="timeline-box">
                                                            <div class="timeline-icon {{$uperClass}}">
                                                                <i class="fa fa-home"></i>
                                                            </div>
                                                            <div class="timeline-text">
                                                                <h3>GRN {{$value['grn']->id}}</h3>
                                                                <p>Created : {{$value['grn']->created_name}}</p>
                                                                <p>GRN Date : {{date('d M Y',strtotime($value['grn']->grn_date))}} </p>
                                                                <p>Supplier Name : {{$value['grn']->sup_name}}</p>
                                                            </div>
                                                            <div class="timeline-icon {{$loverCls}}">
                                                                <i class="fa fa-home"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 {{$loverCls}}">
                                                        <p class="timeline-date">
                                                            {{date('d M Y',strtotime($value['grn']->grn_created_date))}}
                                                        </p>
                                                    </div>
                                                </div>

                                                <!-- synthesis -->
                                                @if($value['grn']->status!=1||$value['grn']->status!=0)
                                                <?php
                                                if ($sideOption % 2 == 0) {
                                                    $side = 'timeline-right';
                                                    $loverCls = 'd-md-none d-block';
                                                    $uperClass = "";
                                                } else {
                                                    $side = "timeline-left";
                                                    $loverCls = "";
                                                    $uperClass = 'd-md-none d-block';
                                                }
                                                $sideOption++;

                                                ?>
                                                <div class="row {{$side}}">
                                                    <div class="col-md-6 {{$uperClass}}">
                                                        <p class="timeline-date">
                                                            Synthesis
                                                        </p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="timeline-box">
                                                            <div class="timeline-icon {{$uperClass}}">
                                                                <i class="fa fa-home"></i>
                                                            </div>
                                                            <div class="timeline-text">
                                                                <!-- <h3>Synthesis</h3> -->
                                                                @foreach ($value['syn'] as $key => $valueIn)
                                                                <?php
                                                                $timeOfStatus = "";
                                                                if ($valueIn->status == 1) {
                                                                    $status = 'Approval Pending from';
                                                                    $timeOfStatus = date('d-m-Y H:i:s', strtotime($valueIn->updated_at));
                                                                    $class = "blue";
                                                                }
                                                                if ($valueIn->status == 2) {
                                                                    $status = 'Approved ';
                                                                    $timeOfStatus = date('d-m-Y H:i:s', strtotime($valueIn->updated_at));
                                                                    $class = "green";
                                                                } else if ($valueIn->status == 3) {
                                                                    $status = 'Returned';
                                                                    $timeOfStatus = date('d-m-Y H:i:s', strtotime($valueIn->updated_at));
                                                                    $class = "orange";
                                                                } else if ($valueIn->status == 4) {
                                                                    $status = 'Rejected';
                                                                    $timeOfStatus = date('d-m-Y H:i:s', strtotime($valueIn->updated_at));
                                                                    $class = "red";
                                                                }
                                                                ?>
                                                                <p>
                                                                    <span style="color: {{$class}}">
                                                                        {{$valueIn->name}} {{$status}} : {{$timeOfStatus}}
                                                                    </span>
                                                                </p>
                                                                @endforeach
                                                            </div>
                                                            <div class="timeline-icon {{$loverCls}}">
                                                                <i class="fa fa-home"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 {{$loverCls}}">
                                                        <p class="timeline-date">
                                                            Synthesis
                                                        </p>
                                                    </div>
                                                </div>
                                                @endif
                                                @endforeach
                                                <!-- ./GRN -->

                                                <!-- stock in -->
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="timeline-year">
                                                            <p>Stock <br>IN</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                @foreach ($stockIn as $key => $value)
                                                <?php
                                                if ($sideOption % 2 == 0) {
                                                    $side = 'timeline-right';
                                                    $loverCls = 'd-md-none d-block';
                                                    $uperClass = "";
                                                } else {
                                                    $side = "timeline-left";
                                                    $loverCls = "";
                                                    $uperClass = 'd-md-none d-block';
                                                }
                                                $sideOption++;
                                                ?>
                                                <div class="row {{$side}}">
                                                    <div class="col-md-6 {{$uperClass}}">
                                                        <p class="timeline-date">

                                                            {{date('d M Y',strtotime($value['stockIn']->warehouse_transfer_date))}}
                                                        </p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="timeline-box">
                                                            <div class="timeline-icon {{$uperClass}}">
                                                                <i class="fa fa-home"></i>
                                                            </div>
                                                            <div class="timeline-text">
                                                                <h3>S-IN {{$value['stockIn']->id}}</h3>
                                                                <p>Created : {{$value['stockIn']->created_name}}</p>
                                                                <p>Warehouse Name : {{$value['stockIn']->warehouse_name}} </p>
                                                                <p>Supplier Name : {{$value['stockIn']->sup_name}}</p>
                                                            </div>
                                                            <div class="timeline-icon {{$loverCls}}">
                                                                <i class="fa fa-home"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 {{$loverCls}}">
                                                        <p class="timeline-date">
                                                            {{date('d M Y',strtotime($value['stockIn']->warehouse_transfer_date))}}
                                                        </p>
                                                    </div>
                                                </div>


                                                <!-- synthesis -->
                                                @if($value['stockIn']->status!=1||$value['stockIn']->status!=0)
                                                <?php
                                                if ($sideOption % 2 == 0) {
                                                    $side = 'timeline-right';
                                                    $loverCls = 'd-md-none d-block';
                                                    $uperClass = "";
                                                } else {
                                                    $side = "timeline-left";
                                                    $loverCls = "";
                                                    $uperClass = 'd-md-none d-block';
                                                }
                                                $sideOption++;

                                                ?>
                                                <div class="row {{$side}}">
                                                    <div class="col-md-6 {{$uperClass}}">
                                                        <p class="timeline-date">
                                                            Synthesis
                                                        </p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="timeline-box">
                                                            <div class="timeline-icon {{$uperClass}}">
                                                                <i class="fa fa-home"></i>
                                                            </div>
                                                            <div class="timeline-text">
                                                                <!-- <h3>Synthesis</h3> -->
                                                                @foreach ($value['syn'] as $key => $valueIn)
                                                                <?php
                                                                $timeOfStatus = "";
                                                                if ($valueIn->status == 1) {
                                                                    $status = 'Approval Pending from';
                                                                    $timeOfStatus = date('d-m-Y H:i:s', strtotime($valueIn->updated_at));
                                                                    $class = "blue";
                                                                }
                                                                if ($valueIn->status == 2) {
                                                                    $status = 'Approved ';
                                                                    $timeOfStatus = date('d-m-Y H:i:s', strtotime($valueIn->updated_at));
                                                                    $class = "green";
                                                                } else if ($valueIn->status == 3) {
                                                                    $status = 'Returned';
                                                                    $timeOfStatus = date('d-m-Y H:i:s', strtotime($valueIn->updated_at));
                                                                    $class = "orange";
                                                                } else if ($valueIn->status == 4) {
                                                                    $status = 'Rejected';
                                                                    $timeOfStatus = date('d-m-Y H:i:s', strtotime($valueIn->updated_at));
                                                                    $class = "red";
                                                                }
                                                                ?>
                                                                <p>
                                                                    <span style="color: {{$class}}">
                                                                        {{$valueIn->name}} {{$status}} : {{$timeOfStatus}}
                                                                    </span>
                                                                </p>
                                                                @endforeach
                                                            </div>
                                                            <div class="timeline-icon {{$loverCls}}">
                                                                <i class="fa fa-home"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 {{$loverCls}}">
                                                        <p class="timeline-date">
                                                            Synthesis
                                                        </p>
                                                    </div>
                                                </div>
                                                @endif
                                                @endforeach
                                                <!-- ./stock in -->

                                                <!-- invoice -->
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="timeline-year">
                                                            <p>Invoice</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                @foreach ($invoice as $key => $value)
                                                <?php
                                                if ($sideOption % 2 == 0) {
                                                    $side = 'timeline-right';
                                                    $loverCls = 'd-md-none d-block';
                                                    $uperClass = "";
                                                } else {
                                                    $side = "timeline-left";
                                                    $loverCls = "";
                                                    $uperClass = 'd-md-none d-block';
                                                }
                                                $sideOption++;
                                                ?>
                                                <div class="row {{$side}}">
                                                    <div class="col-md-6 {{$uperClass}}">
                                                        <p class="timeline-date">

                                                            {{date('d M Y',strtotime($value['invoice']->bill_entry_date))}}
                                                        </p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="timeline-box">
                                                            <div class="timeline-icon {{$uperClass}}">
                                                                <i class="fa fa-home"></i>
                                                            </div>
                                                            <div class="timeline-text">
                                                                <h3>S-INV {{$value['invoice']->id}}</h3>
                                                                <p>Created : {{$value['invoice']->created_name}}</p>
                                                                <p>Invoice Number : {{$value['invoice']->supplier_invoice_number}}</p>
                                                                <p>Invoice Date : {{date('d M Y',strtotime($value['invoice']->supplier_invoice_date))}} </p>
                                                                <p> Invoice over due date : {{date('d M Y',strtotime($value['invoice']->supplier_invoice_over_due_date))}} </p>
                                                                <p>Invoice Credit Period : {{$value['invoice']->supplier_invoice_credit_period}}</p>
                                                                <p>Bill Entry Date: {{$value['invoice']->bill_entry_date}}</p>
                                                                <p>Amount: {{$value['invoice']->grandtotalamount}}</p>
                                                                <p>Supplier Name : {{$value['invoice']->sup_name}}</p>
                                                            </div>
                                                            <div class="timeline-icon {{$loverCls}}">
                                                                <i class="fa fa-home"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 {{$loverCls}}">
                                                        <p class="timeline-date">
                                                            {{date('d M Y',strtotime($value['invoice']->bill_entry_date))}}
                                                        </p>
                                                    </div>
                                                </div>


                                                <!-- synthesis -->
                                                @if($value['invoice']->status!=1||$value['invoice']->status!=0)
                                                <?php
                                                if ($sideOption % 2 == 0) {
                                                    $side = 'timeline-right';
                                                    $loverCls = 'd-md-none d-block';
                                                    $uperClass = "";
                                                } else {
                                                    $side = "timeline-left";
                                                    $loverCls = "";
                                                    $uperClass = 'd-md-none d-block';
                                                }
                                                $sideOption++;

                                                ?>
                                                <div class="row {{$side}}">
                                                    <div class="col-md-6 {{$uperClass}}">
                                                        <p class="timeline-date">
                                                            Synthesis
                                                        </p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="timeline-box">
                                                            <div class="timeline-icon {{$uperClass}}">
                                                                <i class="fa fa-home"></i>
                                                            </div>
                                                            <div class="timeline-text">
                                                                <!-- <h3>Synthesis</h3> -->
                                                                @foreach ($value['syn'] as $key => $valueIn)
                                                                <?php
                                                                $timeOfStatus = "";
                                                                if ($valueIn->status == 1) {
                                                                    $status = 'Approval Pending from';
                                                                    $timeOfStatus = date('d-m-Y H:i:s', strtotime($valueIn->updated_at));
                                                                    $class = "blue";
                                                                }
                                                                if ($valueIn->status == 2) {
                                                                    $status = 'Approved ';
                                                                    $timeOfStatus = date('d-m-Y H:i:s', strtotime($valueIn->updated_at));
                                                                    $class = "green";
                                                                } else if ($valueIn->status == 3) {
                                                                    $status = 'Returned';
                                                                    $timeOfStatus = date('d-m-Y H:i:s', strtotime($valueIn->updated_at));
                                                                    $class = "orange";
                                                                } else if ($valueIn->status == 4) {
                                                                    $status = 'Rejected';
                                                                    $timeOfStatus = date('d-m-Y H:i:s', strtotime($valueIn->updated_at));
                                                                    $class = "red";
                                                                }
                                                                ?>
                                                                <p>
                                                                    <span style="color: {{$class}}">
                                                                        {{$valueIn->name}} {{$status}} : {{$timeOfStatus}}
                                                                    </span>
                                                                </p>
                                                                @endforeach
                                                            </div>
                                                            <div class="timeline-icon {{$loverCls}}">
                                                                <i class="fa fa-home"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 {{$loverCls}}">
                                                        <p class="timeline-date">
                                                            Synthesis
                                                        </p>
                                                    </div>
                                                </div>
                                                @endif
                                                @endforeach

                                                <!-- ./invoice -->


                                                <!--sup pay -->
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="timeline-year">
                                                            <p>Payment</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                @foreach ($pay as $key => $value)
                                                <?php
                                                if ($sideOption % 2 == 0) {
                                                    $side = 'timeline-right';
                                                    $loverCls = 'd-md-none d-block';
                                                    $uperClass = "";
                                                } else {
                                                    $side = "timeline-left";
                                                    $loverCls = "";
                                                    $uperClass = 'd-md-none d-block';
                                                }
                                                $sideOption++;
                                                ?>
                                                <div class="row {{$side}}">
                                                    <div class="col-md-6 {{$uperClass}}">
                                                        <p class="timeline-date">

                                                            {{date('d M Y',strtotime($value['pay']->payement_book_date))}}
                                                        </p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="timeline-box">
                                                            <div class="timeline-icon {{$uperClass}}">
                                                                <i class="fa fa-home"></i>
                                                            </div>
                                                            <div class="timeline-text">
                                                                <h3>S-PAY {{$value['pay']->id}}</h3>
                                                                <p>Created : {{$value['pay']->created_name}}</p>
                                                                <p>Payment Book Date{{date('d M Y',strtotime($value['pay']->payement_book_date))}}</p>
                                                                <p>Amount: {{$value['pay']->grandtotalamount}}</p>
                                                                <p>Supplier Name : {{$value['pay']->sup_name}}</p>
                                                            </div>
                                                            <div class="timeline-icon {{$loverCls}}">
                                                                <i class="fa fa-home"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 {{$loverCls}}">
                                                        <p class="timeline-date">
                                                            {{date('d M Y',strtotime($value['pay']->payement_book_date))}}
                                                        </p>
                                                    </div>
                                                </div>


                                                <!-- synthesis -->
                                                @if($value['pay']->status!=1||$value['pay']->status!=0)
                                                <?php
                                                if ($sideOption % 2 == 0) {
                                                    $side = 'timeline-right';
                                                    $loverCls = 'd-md-none d-block';
                                                    $uperClass = "";
                                                } else {
                                                    $side = "timeline-left";
                                                    $loverCls = "";
                                                    $uperClass = 'd-md-none d-block';
                                                }
                                                $sideOption++;

                                                ?>
                                                <div class="row {{$side}}">
                                                    <div class="col-md-6 {{$uperClass}}">
                                                        <p class="timeline-date">
                                                            Synthesis
                                                        </p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="timeline-box">
                                                            <div class="timeline-icon {{$uperClass}}">
                                                                <i class="fa fa-home"></i>
                                                            </div>
                                                            <div class="timeline-text">
                                                                <!-- <h3>Synthesis</h3> -->
                                                                @foreach ($value['syn'] as $key => $valueIn)
                                                                <?php
                                                                $timeOfStatus = "";
                                                                if ($valueIn->status == 1) {
                                                                    $status = 'Approval Pending from';
                                                                    $timeOfStatus = date('d-m-Y H:i:s', strtotime($valueIn->updated_at));
                                                                    $class = "blue";
                                                                }
                                                                if ($valueIn->status == 2) {
                                                                    $status = 'Approved ';
                                                                    $timeOfStatus = date('d-m-Y H:i:s', strtotime($valueIn->updated_at));
                                                                    $class = "green";
                                                                } else if ($valueIn->status == 3) {
                                                                    $status = 'Returned';
                                                                    $timeOfStatus = date('d-m-Y H:i:s', strtotime($valueIn->updated_at));
                                                                    $class = "orange";
                                                                } else if ($valueIn->status == 4) {
                                                                    $status = 'Rejected';
                                                                    $timeOfStatus = date('d-m-Y H:i:s', strtotime($valueIn->updated_at));
                                                                    $class = "red";
                                                                }
                                                                ?>
                                                                <p>
                                                                    <span style="color: {{$class}}">
                                                                        {{$valueIn->name}} {{$status}} : {{$timeOfStatus}}
                                                                    </span>
                                                                </p>
                                                                @endforeach
                                                            </div>
                                                            <div class="timeline-icon {{$loverCls}}">
                                                                <i class="fa fa-home"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 {{$loverCls}}">
                                                        <p class="timeline-date">
                                                            Synthesis
                                                        </p>
                                                    </div>
                                                </div>
                                                @endif
                                                @endforeach
                                                <!--./sup pay -->

                                                <!-- voucher -->
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="timeline-year">
                                                            <p>Voucher</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                @foreach ($voucher as $key => $value)
                                                <?php
                                                if ($sideOption % 2 == 0) {
                                                    $side = 'timeline-right';
                                                    $loverCls = 'd-md-none d-block';
                                                    $uperClass = "";
                                                } else {
                                                    $side = "timeline-left";
                                                    $loverCls = "";
                                                    $uperClass = 'd-md-none d-block';
                                                }
                                                $sideOption++;
                                                ?>
                                                <div class="row {{$side}}">
                                                    <div class="col-md-6 {{$uperClass}}">
                                                        <p class="timeline-date">

                                                            {{date('d M Y',strtotime($value->voucher_date))}}
                                                        </p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="timeline-box">
                                                            <div class="timeline-icon {{$uperClass}}">
                                                                <i class="fa fa-home"></i>
                                                            </div>
                                                            <div class="timeline-text">
                                                                <h3>G-PV {{$value->id}}</h3>
                                                                <p>Created : {{$value->created_name}}</p>
                                                                <p>Voucher Date : {{date('d-m-Y',strtotime($value->voucher_date))}}</p>


                                                                <?php
                                                                $bank_name = '';
                                                                $bank_account = '';
                                                                $cheque_number = '';
                                                                $cheque_date = '';
                                                                if ($value->payment_method == 1) {
                                                                    $method = 'Cash';
                                                                    $tId = $value->cash_transaction_id;
                                                                    $ref = $value->cash_transaction_referance;
                                                                } else if ($value->payment_method == 2) {
                                                                    $method = 'Bank Transfer';
                                                                    $tId = $value->bank_transaction_id;
                                                                    $ref = $value->bank_transaction_referance;
                                                                    $bank_name = $value->bank_name . '~~' . $value->iban_swift_code;
                                                                } else if ($value->payment_method == 3) {
                                                                    $method = 'Cheque';
                                                                    $tId = $value->cheque_transaction_id;
                                                                    $ref = $value->cheque_transaction_referance;
                                                                    $cheque_number = $value->cheque_number;
                                                                    $cheque_date = date('d-m-Y', strtotime($value->cheque_date));
                                                                } else if ($value->payment_method == 4) {
                                                                    $method = 'Card Payment';
                                                                    $tId = $value->card_transaction_id;
                                                                    $ref = $value->card_transaction_reference;
                                                                }
                                                                ?>

                                                                <p>Payment Method : {{$method}}</p>
                                                                <p>Transaction ID : {{$tId}}</p>
                                                                <p>Transaction Ref : {{$ref}}</p>
                                                                <p>Amount : {{$value->amount}}</p>
                                                                <p>Supplier Name : {{$value->sup_name}}</p>
                                                            </div>
                                                            <div class="timeline-icon {{$loverCls}}">
                                                                <i class="fa fa-home"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 {{$loverCls}}">
                                                        <p class="timeline-date">
                                                            {{date('d M Y',strtotime($value->voucher_date))}}
                                                        </p>
                                                    </div>
                                                </div>
                                                @endforeach
                                                <!-- ./voucher -->

                                                <!-- Issued Payments -->

                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="timeline-year">
                                                            <p>Issued Payments</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                @foreach ($issupay as $key => $value)
                                                <?php
                                                if ($sideOption % 2 == 0) {
                                                    $side = 'timeline-right';
                                                    $loverCls = 'd-md-none d-block';
                                                    $uperClass = "";
                                                } else {
                                                    $side = "timeline-left";
                                                    $loverCls = "";
                                                    $uperClass = 'd-md-none d-block';
                                                }
                                                $sideOption++;
                                                ?>
                                                <div class="row {{$side}}">
                                                    <div class="col-md-6 {{$uperClass}}">
                                                        <p class="timeline-date">

                                                            {{date('d M Y',strtotime($value->issued_date))}}
                                                        </p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="timeline-box">
                                                            <div class="timeline-icon {{$uperClass}}">
                                                                <i class="fa fa-home"></i>
                                                            </div>
                                                            <div class="timeline-text">
                                                                <h3>ISS-P {{$value->id}}</h3>
                                                                <p>Created : {{$value->created_name}}</p>
                                                                <p>receiver_name : {{$value->receiver_name}}</p>
                                                                <p>Issued Date : {{date('d-m-Y',strtotime($value->issued_date))}}</p>
                                                                <p>Relation With Supplier : {{$value->relation_with_supplier}}</p>
                                                                <p>Designation : {{$value->designation}}</p>
                                                                <p>Department : {{$value->department}}</p>
                                                                <p>National Id : {{$value->national_id}}</p>
                                                                <p>Phone Number : {{$value->phone_number}}</p>
                                                                <p>Supplier Name : {{$value->sup_name}}</p>
                                                            </div>
                                                            <div class="timeline-icon {{$loverCls}}">
                                                                <i class="fa fa-home"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 {{$loverCls}}">
                                                        <p class="timeline-date">
                                                            {{date('d M Y',strtotime($value->issued_date))}}
                                                        </p>
                                                    </div>
                                                </div>
                                                @endforeach

                                                <!-- ./Issued Payments -->

                                            </div>
                                            <div class="timeline-start">
                                                <p>
                                                    End
                                                </p>
                                            </div>
                                            <!-- <div class="timeline-launch">
                                                <div class="timeline-box">
                                                    <div class="timeline-text">
                                                        <h3>
                                                            Launched our company on 01 Jan 2019
                                                        </h3>
                                                        <p>
                                                            Lorem ipsum dolor sit amet
                                                        </p>
                                                    </div>
                                                </div>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
@endsection