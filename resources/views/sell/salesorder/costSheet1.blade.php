<html>

<head>
    <?php

    $pdfheader_top = 100;
    $pdffooter_bottom = 160;
    $revenue = 0;
    $totalCost = 0;
    if (Session::get('pdfheader_top')) {
        $pdfheader_top = Session::get('pdfheader_top');
    }
    if (Session::get('pdffooter_bottom')) {
        $pdffooter_bottom = Session::get('pdffooter_bottom');
    }
    ?>

    <style>
        {
            font-family: 'Tajawal', sans-serif;
        }

        h1 {
            font-size: 24px;
        }

        h4 {
            font-size: 12px;
        }



        @page {
            margin: 5px;
        }

        body {
            font-size: 12px;
            font-family: 'Tajawal', sans-serif;
        }


        body {
            margin: 0px;
        }

        @page {
            margin: <?php echo $pdfheader_top; ?>px 0px <?php echo $pdffooter_bottom; ?>px 0px;
        }

        @page {
            header: page-header;
            footer: page-footer;
        }
    </style>

    <htmlpageheader name="page-header">
        <img src='{{ asset($branchsettings->pdfheader) }}' border='0' width='100%'>
    </htmlpageheader>

    <htmlpagefooter name="page-footer">
        <img src='{{ asset($branchsettings->pdffooter) }}' border='0' width='100%'>
    </htmlpagefooter>

    <div class="container" style="padding-right: 25px;padding-left: 25px;  padding-bottom: 0px; padding-top:10px;">
        <div class="row" style="margin-top:0px;">
            <h1>COST SHEET</h1>
            <table style="width:100%;" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="border-color: white;   padding-top: 0; padding-right: 0; padding-bottom: 0; width: 50%; ">
                        <table style=" width: 100%; ">
                            <tr>
                                <td style="border-color: white; padding: 0; font-weight: bold;  font-size:11px; width: 30%;">
                                    Salesorder ID</td>
                                <td style="border-color: white; padding: 0;text-align: left;  font-size:11px; color: red;">
                                    SO {{ $saleorder->id }}</td>
                                <td style="border-color: white; padding: 0;text-align: right;  font-size:11px; width: 30%;">
                                </td>
                            </tr>
                            <tr>
                                <td style="border-color: white; padding: 0; font-weight: bold;  font-size:11px;">Date
                                </td>
                                <td style="border-color: white; padding: 0;text-align:  left;  font-size:11px;">
                                    {{ $saleorder->quotedate != '' ? date('d-m-Y', strtotime($saleorder->quotedate)) : '' }}
                                </td>
                                <td style="border-color: white; padding: 0;text-align:  right;  font-size:11px;">
                                </td>
                            </tr>
                            <tr>
                                <td style="border-color: white; padding: 0; font-weight: bold;  font-size:11px;">QTN Ref
                                </td>
                                <td style="border-color: white; padding: 0;text-align:  left;  font-size:11px;">
                                    {{ $saleorder->qtn_ref }}
                                </td>

                            </tr>
                            <tr>
                                <td style="border-color: white; padding: 0; font-weight: bold;  font-size:11px;">PO
                                    Reference</td>
                                <td style="border-color: white; padding: 0;text-align:  left;  font-size:11px;">
                                    {{ $saleorder->po_ref }}
                                </td>

                            </tr>
                        </table>
                    </td>
                    <td cellspacing="0" cellpadding="0" valign="right">

                    </td>
                </tr>
            </table>

            <br>
            <h3>Ticket Details</h3>
            <table style=" width: 100%; ">
                <tr>
                    <td style="text-align:left;">#</td>
                    <td style="text-align:left;">Ticket Id</td>
                    <td style="text-align:left;">Name</td>
                    {{-- <td style="text-align:left;">Email</td> --}}
                    <td style="text-align:left;">Passport Number</td>
                    <td style="text-align:left;">Country </td>
                    <td style="text-align:right;">Total Amount</td>
                </tr>
                <tr class="str">
                    <td style="background-color: white !important;border-color: white; border: 0px;  padding: 0;" colspan="11">
                        <hr style="height: 2px; color:black; font-size: 5px; background-color: black; margin: 0;">
                    </td>

                </tr>
                @foreach ($tickets as $key => $value)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ 'TKT ' . $value->id }}</td>
                    <td>{{ $value->name }}</td>
                    {{-- <td>{{ $value->email }}</td> --}}
                    <td>{{ $value->passport_no }}</td>
                    <td>{{ $value->cntry_name }}</td>
                    <td style="text-align:right;">{{ $value->total_amount }}</td>
                </tr>
                @endforeach
            </table>

            <br>
            <h3>Expenditure Details</h3>
            <table style=" width: 100%; ">
                <tr>
                    <td style="text-align:left; width: 3%;">#</td>
                    <td style="text-align:center; width: 10%;">Id</td>
                    <td style="text-align:left; width: 7%;">Date</td>
                    <td style="text-align:center; width: 30%;">Supplier Name</td>
                    <td style="text-align:right; width: 15%;">Total Amount Before Tax</td>
                    <td style="text-align:right; width: 10%;">Discount</td>
                    <td style="text-align:right; width: 10%;">VAT Amount </td>
                    <td style="text-align:right; width: 15%;">Total Amount</td>
                </tr>
                <tr class="str">
                    <td style="background-color: white !important;border-color: white; border: 0px;  padding: 0;" colspan="11">
                        <hr style="height: 2px; color:black; font-size: 5px; background-color: black; margin: 0;">
                    </td>

                </tr>
                @foreach ($expenditures as $key => $value)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td style="text-align:center;">{{ 'EXP -' . $value->id }}</td>
                    <td>{{ $value->quotedate != '' ? date('d-m-Y', strtotime($value->quotedate)) : '' }}</td>
                    <td>{{ $value->sup_name }}</td>
                    <td style="text-align:right;">{{ $value->totalamount }}</td>
                    <td style="text-align:right;">{{ $value->discount }}</td>
                    <td style="text-align:right;">{{ $value->vatamount }}</td>
                    <td style="text-align:right;">{{ $value->grandtotalamount }}</td>

                    <?php
                    $totalCost += $value->totalamount;
                    ?>
                </tr>
                @endforeach
            </table>

            <h3>Invoice Details</h3>
            <table style=" width: 100%; ">
                <tr>
                    <td style="text-align:left; width: 3%;">#</td>
                    <td style="text-align:center; width: 10%;">Id</td>
                    <td style="text-align:left; width: 7%;">Date</td>
                    <td style="text-align:center; width: 30%;">Customer Name</td>
                    <td style="text-align:right; width: 15%;">Total Amount Before Tax</td>
                    <td style="text-align:right; width: 10%;">Discount</td>
                    <td style="text-align:right; width: 10%;">VAT Amount </td>
                    <td style="text-align:right; width: 15%;">Total Amount</td>
                </tr>
                <tr class="str">
                    <td style="background-color: white !important;border-color: white; border: 0px;  padding: 0;" colspan="11">
                        <hr style="height: 2px; color:black; font-size: 5px; background-color: black; margin: 0;">
                    </td>

                </tr>

                @foreach ($invoices as $key => $value)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ 'INV -' . $value->id }}</td>
                    <td>{{ $value->quotedate != '' ? date('d-m-Y', strtotime($value->quotedate)) : '' }}</td>
                    <td>{{ $value->cust_name }}</td>
                    <td style="text-align:right;">{{ $value->totalamount }}</td>
                    <td style="text-align:right;">{{ $value->discount }}</td>
                    <td style="text-align:right;">{{ $value->vatamount }}</td>
                    <td style="text-align:right;">{{ $value->grandtotalamount }}</td>
                </tr>
                <?php
                $revenue += $value->totalamount;
                ?>
                @endforeach
                <?php
                $profit =  $revenue - $totalCost;
                ?>

            </table>

            <br>
            <br>

            <h2>Detailed Invoice </h2>

            <table style=" width: 100%; ">
                <tr>
                    <td style="text-align:left; width: 3%;">#</td>
                    <td style="text-align:center; width: 10%;">Invoice ID</td>
                    <td style="text-align:right; width: 7%;">Purchase Amount</td>
                    <td style="text-align:right; width: 30%;">Sellig Amount</td>
                    <td style="text-align:right; width: 15%;">Profit</td>
                </tr>
                <tr class="str">
                    <td style="background-color: white !important;border-color: white; border: 0px;  padding: 0;" colspan="5">
                        <hr style="height: 2px; color:black; font-size: 5px; background-color: black; margin: 0;">
                    </td>

                </tr>
                @foreach ($invoiceProducts as $key => $product)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td style="text-align:center;">{{ 'INV -' . $product->id }}</td>
                    <td style="text-align:right;">{{ $product->purchaseamount }}</td>
                    <td style="text-align:right;">{{ $product->amount }}</td>
                    <td style="text-align:right;">{{ $product->amount-$product->purchaseamount }}</td>


                </tr>
                <?php
                $revenue += $value->totalamount;
                ?>
                @endforeach
            </table>

            <br>
            <br>
            <h2>Cost Details</h2>

            <table style="width:100%;" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="border-color: white;   padding-top: 0; padding-right: 0; padding-bottom: 0; width: 50%; ">
                        <table style=" width: 100%; ">
                            <tr>
                                <td style="border-color: white; padding: 0; font-weight: bold;  font-size:14px; width: 30%;">
                                    Revenue</td>
                                <td style="border-color: white; padding: 0;text-align: left;  font-size:11px; ">
                                    {{ $revenue }}
                                </td>
                                <td style="border-color: white; padding: 0;text-align: left;  font-size:14px; width: 30%;">
                                </td>
                            </tr>
                            <tr>
                                <td style="border-color: white; padding: 0; font-weight: bold;  font-size:14px;">Total
                                    Cost
                                </td>
                                <td style="border-color: white; padding: 0;text-align:  left;  font-size:14px;">
                                    {{ $totalCost }}
                                </td>
                                <td style="border-color: white; padding: 0;text-align:  left;  font-size:14px;">
                                </td>
                            </tr>
                            <tr>
                                <td style="border-color: white; padding: 0; font-weight: bold;  font-size:14px;">Net
                                    Profit
                                </td>
                                <td style="border-color: white; padding: 0;text-align:  left;  font-size:14px;">
                                    {{ $profit }}
                                </td>
                                <td style="border-color: white; padding: 0;text-align:  left;  font-size:14px;">
                                </td>
                            </tr>

                        </table>
                    </td>
                    <td cellspacing="0" cellpadding="0" valign="right" style="width: 50%;">
                        <table style=" width: 100%; ">

                        </table>
                    </td>
                </tr>
            </table>

        </div>
    </div>