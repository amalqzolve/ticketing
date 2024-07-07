<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
</head>

<body>

    <span id="content">
        <div class="col-md-12 slide-top" style="padding: 0px 50px 50px 50px;">


            <div class="row">
                <div class="col-md-6" style="width: 50%; float: left; ">
                    <h2 style="font-weight: bold; font-size: 200%; margin-bottom: 5px;"><?php echo 'COST SHEET'; ?></h2>
                </div>

            </div>
            <div class="row">
                <div class="col-md-6" style="width: 50%; float: left;">
                    <div class="col-md-6" style="width: 25%; float: left;">
                        <?php echo 'Job ID'; ?>
                    </div>
                    <div class="col-md-6" style="width: 75%; float: left;">
                        <?php echo '$view1[0]->ref_num'; ?>
                    </div>
                    <div class="col-md-6" style="width: 25%; float: left;">
                        <?php echo 'Job Date'; ?>
                    </div>
                    <div class="col-md-6" style="width: 75%; float: left;">
                        <?php echo '$view1[0]->doc_date'; ?>
                    </div>
                    <div class="col-md-6" style="width: 25%; float: left;">
                        <?php echo 'Client'; ?>
                    </div>
                    <div class="col-md-6" style="width: 75%; float: left;">
                        <?php echo '$view1[0]->cname'; ?>
                    </div>
                    <div class="col-md-6" style="width: 25%; float: left;">
                        <?php echo 'Consignee'; ?>
                    </div>
                    <div class="col-md-6" style="width: 75%; float: left;">
                        <?php echo '$view1[0]->consname'; ?>
                    </div>
                </div>
                <div class="col-md-6 text-right" style="width: 50%; float: left;">

                    <div class="col-md-6" style="width: 30%; float: left; margin-left: 20% "><?php echo 'Invoice Status'; ?> :
                    </div>
                    <div class="col-md-6" style="width: 50%; float: left; text-align: right;"> <?php echo '$status_inv'; ?>
                    </div>

                    <div class="col-md-6" style="width: 30%; float: left; margin-left: 20% "><?php echo 'Invoice No'; ?> :
                    </div>
                    <div class="col-md-6" style="width: 50%; float: left; text-align: right;"> <?php echo '$num_inv'; ?>
                    </div>

                    <div class="col-md-6" style="width: 30%; float: left; margin-left: 20% "><?php echo 'Invoice Date'; ?> :
                    </div>
                    <div class="col-md-6" style="width: 50%; float: left; text-align: right;"> <?php echo '$dat_inv'; ?>
                    </div>
                    <div class="col-md-6" style="width: 30%; float: left; margin-left: 20% "><?php echo 'Invoice Amount'; ?> :
                    </div>
                    <div class="col-md-6" style="width: 50%; float: left; text-align: right;"> <?php echo 'round($am_inv, 2)'; ?>
                    </div>
                    <div class="col-md-6" style="width: 30%; float: left; margin-left: 20%; font-weight: bold; ">
                        <?php echo 'Due Amount'; ?> :</div>
                    <div class="col-md-6" style="width: 50%; float: left; text-align: right; font-weight: bold;">
                        <?php echo 'round($due, 2)'; ?></div>
                </div>
            </div>
            <br><br><br>
            <!--  -->


            <div style="width: 100%;">
                <div
                    style="width: 100%; font-weight: bold; border-style: solid; border-width: 0px 0px 1px 0px; border-color: gray;">
                    <div style="width:7%; float: left;"><?php echo 'S.No'; ?>
                    </div>
                    <div style="width: 30%; float: left;"><?php echo 'Service Description'; ?>
                    </div>
                    <div style="width: 21%; float: left; text-align: right;"><?php echo 'Estimation'; ?>
                    </div>
                    <div style="width:21%; float: left; text-align: right;"><?php echo 'Actual Amount'; ?>
                    </div>
                    <div style="width: 21%; float: left; text-align: right;"><?php echo 'Difference'; ?>
                    </div>
                </div>
               
                <div
                    style="width: 100%; border-style: solid; border-width: 0px 0px 1px 0px; border-color: gray; margin-top: 5px">
                    <div style="width:7%; float: left;">1
                    </div>
                    <div style="width: 30%; float: left;"><?php echo 'Total Process Cost'; ?>
                    </div>
                    <div style="width: 21%; float: left; text-align: right;"><?php echo '$pro_est'; ?>
                    </div>
                    <div style="width:21%; float: left; text-align: right;"><?php echo '$pro_act'; ?>
                    </div>
                    <div style="width: 21%; float: left; text-align: right;"><?php echo '$pro_est'; ?>
                    </div>
                </div>
              

                <div
                    style="width: 100%; border-style: solid; border-width: 0px 0px 1px 0px; border-color: gray; margin-top: 5px">
                    <div style="width:7%; float: left;">2
                    </div>
                    <div style="width: 30%; float: left;"><?php echo 'Total Internal Cost'; ?>
                    </div>
                    <div style="width: 21%; float: left; text-align: right;"><?php echo '$int_est'; ?>
                    </div>
                    <div style="width:21%; float: left; text-align: right;"><?php echo '$int_act'; ?>
                    </div>
                    <div style="width: 21%; float: left; text-align: right;"><?php echo '$int_est - $int_act'; ?>
                    </div>
                </div>
                <div
                    style="width: 100%; border-style: solid; border-width: 0px 0px 1px 0px; border-color: gray; margin-top: 5px">
                    <div style="width:7%; float: left;">3
                    </div>
                    <div style="width: 30%; float: left;"><?php echo 'Total Agents Cost'; ?>
                    </div>
                    <div style="width: 21%; float: left; text-align: right;"><?php echo 'round($ageco_est, 2)'; ?>
                    </div>
                    <div style="width:21%; float: left; text-align: right;"><?php echo 'round($ag_act, 2)'; ?>
                    </div>
                    <div style="width: 21%; float: left; text-align: right;"><?php echo 'round($ageco_est - $ag_act, 2)'; ?>
                    </div>
                </div>

               
                <div
                    style="width: 100%; border-style: solid; border-width: 0px 0px 1px 0px; border-color: gray; margin-top: 5px">
                    <div style="width:7%; float: left;">4
                    </div>
                    <div style="width: 30%; float: left;">Credit Note
                    </div>
                    <div style="width: 21%; float: left; text-align: right;">0
                    </div>
                    <div style="width:21%; float: left; text-align: right;">0
                    </div>
                    <div style="width: 21%; float: left; text-align: right;"><?php echo 'round($creditnotsof, 2)'; ?>
                    </div>
                </div>
                <div
                    style="width: 100%; border-style: solid; border-width: 0px 0px 1px 0px; border-color: gray; margin-top: 5px">
                    <div style="width:7%; float: left;">5
                    </div>
                    <div style="width: 30%; float: left;">Debit Note
                    </div>
                    <div style="width: 21%; float: left; text-align: right;">0
                    </div>
                    <div style="width:21%; float: left; text-align: right;">0
                    </div>
                    <div style="width: 21%; float: left; text-align: right;"><?php echo 'round($debitnotsof, 2)'; ?>
                    </div>
                </div>
            </div>
            <br>
            
            <h4 style="margin-bottom: 5px;"><?php echo 'Detailed Costing'; ?></h4>

            <div style="width: 100%; margin-top: 5px;">
                <div
                    style="width: 100%; font-weight: bold; border-style: solid; border-width: 0px 0px 1px 0px; border-color: gray;">
                    <div style="width:3%; float: left;">#
                    </div>
                    <div style="width: 22%; float: left;"><?php echo 'Description'; ?>
                    </div>
                    <div style="width: 10%; float: left;"> <?php echo 'Method'; ?>
                    </div>
                    <div style="width: 9%; float: left;"> <?php echo 'Status'; ?>
                    </div>
                    <div style="width:13%; float: left; text-align: center;"><?php echo 'Date'; ?>
                    </div>
                    <div style="width: 20%; float: left; text-align: center;"><?php echo 'Voucher'; ?>
                    </div>
                    <div style="width: 10%; float: left; text-align: right;"><?php echo 'Debit'; ?>
                    </div>
                    <div style="width: 8%; float: left; text-align: right;"><?php echo 'Credit'; ?>
                    </div>
                </div>
                
                <div
                    style="width: 100%; border-style: solid; border-width: 0px 0px 1px 0px; border-color: gray; ; margin-top: 5px;">
                    <div style="width:5%; float: left;"><?php echo '$key + 1;'; ?>
                    </div>
                    <div style="width: 20%; float: left;"><?php echo '$p->payment_status_name'; ?>
                    </div>
                    <div style="width: 10%; float: left;"><?php echo '$f_me'; ?>
                    </div>
                    <div style="width: 10%; float: left;"><?php echo '$pos'; ?>
                    </div>
                    <div style="width:13%; float: left; text-align: left;">

                    </div>
                    <div style="width: 20%; float: left; text-align: right;">

                    </div>
                    <div style="width: 10%; float: left; text-align: right;"><?php echo '$p->expense'; ?>
                    </div>
                    <div style="width: 10%; float: left; text-align: right;">0
                    </div>
                </div>
                
                <div
                    style="width: 100%; border-style: solid; border-width: 0px 0px 1px 0px; border-color: gray; margin-top: 5px;">
                    <div style="width:5%; float: left;"><?php echo '$sl_co + 1 + $keyn'; ?>
                    </div>
                    <div style="width: 20%; float: left;"><?php echo '$in->dis'; ?>
                    </div>
                    <div style="width: 10%; float: left;"><?php echo '$f_me'; ?>
                    </div>
                    <div style="width: 10%; float: left;"><?php echo '$pos'; ?>
                    </div>
                    <div style="width:13%; float: left; text-align: left;">
                        asdads
                    </div>
                    <div style="width: 20%; float: left; text-align: right;">dfsfsddsf
                    </div>
                    <div style="width: 10%; float: left; text-align: right;"><?php echo '$in->debit_amount'; ?>
                    </div>
                    <div style="width: 10%; float: left; text-align: right;"><?php echo '$in->credit_amount'; ?>
                    </div>
                </div>
                
                <div
                    style="width: 100%; border-style: solid; border-width: 0px 0px 1px 0px; border-color: gray; margin-top: 5px;">
                    <div style="width:5%; float: left;"><?php echo '$sl_co + 1 + $keynt'; ?>
                    </div>
                    <div style="width: 20%; float: left;"><?php echo '$ag->invoice' . '<br>( ' . '$ag->agent' . ')'; ?>
                    </div>
                    <div style="width: 10%; float: left;">-
                    </div>
                    <div style="width: 10%; float: left;"><?php echo '$pos'; ?>
                    </div>
                    <div style="width:13%; float: left; text-align: left;">gffhfhfgh
                    </div>
                    <div style="width: 20%; float: left; text-align: right;">dgdgfd

                    </div>
                    <div style="width: 10%; float: left; text-align: right;">
                        <?php echo 'round($ag->amount_tot - $ag->vat_tot, 2)'; ?>
                    </div>
                    <div style="width: 10%; float: left; text-align: right;">0
                    </div>
                </div>

                
                <div
                    style="width: 100%; border-style: solid; border-width: 0px 0px 1px 0px; border-color: gray; margin-top: 5px;">
                    <div style="width:5%; float: left;"><?php echo '$sl_co + 1 + $keynt'; ?>
                    </div>
                    <div style="width: 20%; float: left;"><?php echo '$ag->credit_num'; ?>
                    </div>
                    <div style="width: 15%; float: left;">-
                    </div>
                    <div style="width: 10%; float: left;">Posted
                    </div>
                    <div style="width:13%; float: left; text-align: left;">dfdfddgdg
                    </div>
                    <div style="width: 15%; float: left; text-align: right;">dfdfdf
                    </div>
                    <div style="width: 10%; float: left; text-align: right;">0
                    </div>
                    <div style="width: 10%; float: left; text-align: right;"><?php echo '$ag->ds'; ?>
                    </div>
                </div>

                <div
                    style="width: 100%; border-style: solid; border-width: 0px 0px 1px 0px; border-color: gray; margin-top: 5px;">
                    <div style="width:5%; float: left;"><?php echo '$sl_co + 1 + $keynt'; ?>
                    </div>
                    <div style="width: 20%; float: left;"><?php echo '$ag->credit_num'; ?>
                    </div>
                    <div style="width: 15%; float: left;">-
                    </div>
                    <div style="width: 10%; float: left;">Posted
                    </div>
                    <div style="width:13%; float: left; text-align: left;">asdasdsaddas
                    </div>
                    <div style="width: 15%; float: left; text-align: right;">adadass
                    </div>
                    <div style="width: 10%; float: left; text-align: right;"><?php echo '$ag->ds'; ?>
                    </div>
                    <div style="width: 10%; float: left; text-align: right;">0
                    </div>
                </div>

            </div>
            <br>
            
            <div class="row mt-4">
                <div style="width: 50%; float: left;">
                    <div class="inv--payment-info">
                        <div class="row">
                            <div class="col-sm-12 col-12">
                                <h4 style="margin-bottom: 5px;"><?php echo 'Payment Information'; ?></h4>
                            </div>
                            <div
                                style="width: 40%; float: left; border-style: dotted; border-width: 0px 0px 1px 0px;font-size: 13px;">

                                <?php echo 'Invoice Amount'; ?>
                            </div>
                            <div
                                style="width: 10%; float: left; text-align: right; border-style: dotted; border-width: 0px 0px 1px 0px;font-size: 13px;">
                                :
                            </div>
                            <div
                                style="width: 30%; float: left; text-align: right; border-style: dotted; border-width: 0px 0px 1px 0px;font-size: 13px;">
                                <?php echo 'dasdas'; ?>
                                {{-- number_format($am_inv_c, 2); --}}
                            </div>
                            <div style="width: 10%; float: left; text-align: right;font-size: 13px;">
                            </div>
                            <div
                                style="width: 40%; float: left; border-style: dotted; border-width: 0px 0px 1px 0px;font-size: 13px;">
                                <?php echo 'Advance Received'; ?>
                            </div>
                            <div
                                style="width: 10%; float: left; text-align: right; border-style: dotted; border-width: 0px 0px 1px 0px;font-size: 13px;">
                                :
                            </div>
                            <div
                                style="width: 30%; float: left;  text-align: right; border-style: dotted; border-width: 0px 0px 1px 0px;font-size: 13px;">
                                <?php echo 'dfdg'; ?>
                                {{-- number_format($j_ad_pri, 2); --}}
                            </div>
                            <div style="width: 10%; float: left;">
                            </div>
                            <div
                                style="width: 40%; float: left; border-style: dotted; border-width: 0px 0px 1px 0px;font-size: 13px;">
                                <?php echo 'Invoice Settlement'; ?>
                            </div>
                            <div
                                style="width: 10%; float: left; text-align: right; border-style: dotted; border-width: 0px 0px 1px 0px;font-size: 13px;">
                                :
                            </div>
                            <div
                                style="width: 30%; float: left;  text-align: right; border-style: dotted; border-width: 0px 0px 1px 0px;font-size: 13px;">
                                <?php echo 'sdfsd'; ?>
                                {{-- number_format($pay_in_pri, 2); --}}
                            </div>
                            <div style="width: 10%; float: left;">
                            </div>
                            <div
                                style="width: 40%; float: left; border-style: dotted; border-width: 0px 0px 1px 0px;font-size: 13px;">
                                <?php echo 'Due Amount'; ?>
                            </div>
                            <div
                                style="width: 10%; float: left; text-align: right; border-style: dotted; border-width: 0px 0px 1px 0px;font-size: 13px;">
                                :
                            </div>
                            <div
                                style="width: 30%; float: left;  text-align: right; border-style: dotted; border-width: 0px 0px 1px 0px;font-size: 13px;">
                                <?php echo 'sdfsfs'; ?>
                                {{-- number_format($j_ad_pri + $pay_in_pri, 2); --}}
                            </div>
                            <div style="width: 10%; float: left;">
                            </div>
                        </div>
                    </div>
                </div>
                <div style="width: 50%; float: left; padding-top: 30px; ">
                    <div class="inv--payment-info">
                        <div style="font-weight: bold; margin-top: 23px;">

                            <div class="col-sm-12 col-12">

                            </div>
                            <div
                                style="width: 25%; float: left; margin-left: 25%; border-style: dotted; border-width: 0px 0px 1px 0px;font-size: 14px;">

                                <?php echo 'Revenue'; ?>
                            </div>
                            <div
                                style="width: 10%; float: left; text-align: right; border-style: dotted; border-width: 0px 0px 1px 0px;font-size: 14px;">
                                :
                            </div>
                            <div
                                style="width: 40%; float: left; text-align: right; border-style: dotted; border-width: 0px 0px 1px 0px;font-size: 14px;">
                                <?php echo 'dfds'; ?>
                                {{-- round($am_inv_cnvat, 2); --}}
                            </div>

                            <div
                                style="width: 25%; float: left; margin-left: 25%; border-style: dotted; border-width: 0px 0px 1px 0px;font-size: 14px;">
                                <?php echo 'Total Cost'; ?>
                            </div>
                            <div
                                style="width: 10%; float: left; text-align: right; border-style: dotted; border-width: 0px 0px 1px 0px;font-size: 14px;">
                                :
                            </div>
                            <div
                                style="width: 40%; float: left;  text-align: right; border-style: dotted; border-width: 0px 0px 1px 0px;font-size: 14px;">
                                <?php echo 'dfdf'; ?>
                                {{-- round($pro_act + $int_act + $ag_act + ($sundeb - $suncre), 2); --}}
                            </div>

                            <div
                                style="width: 25%; float: left; margin-left: 25%; border-style: dotted; border-width: 0px 0px 1px 0px;font-size: 14px;">
                                <b><?php echo 'Net Profit'; ?> </b>
                            </div>
                            <div
                                style="width: 10%; float: left; text-align: right; border-style: dotted; border-width: 0px 0px 1px 0px;font-size: 14px;">
                                <b>:</b>
                            </div>
                            <div
                                style="width: 40%; float: left;  text-align: right; border-style: dotted; border-width: 0px 0px 1px 0px;font-size: 14px;">
                                <b>
                                    <?php echo ''; ?></b>
                            </div>



                        </div>
                    </div>



                </div>
            </div>
            <br>
            <br>

        </div>



    </span>
</body>

</html>
