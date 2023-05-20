<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="format-detection" content="telephone=no">

    <style type="text/css" media="all">
        @import "nucss2.css";
    </style>
    <link rel="stylesheet" type="text/css" media="print" href="print.css" />
    <title>Invoice</title>
    <style>
        .adds p {
            margin: 0 0 3px !important;
        }
    </style>
</head>

<body style="font-family:'Times New Roman', Times, serif;">
    <div class="invoice" style="width: 700px; margin: 0 auto;">

        <table style="width: 100%;">
            <tbody>
                <tr>
                    <td width=50%>
                        <h6 style="color: #05437D; font-size:2.2em; margin: 0; font-style: italic;
                            padding-left: 1em; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
                            INVOICE
                        </h6>
                    </td>
                    <td width=50%>
                        <figure style="margin: 0;text-align: right;">
                            <img src="{{asset('resources/assets/uploads/logo/'.$company->site_logo)}}" style="width: 80px;" alt="{{Helper::ProjectName()}}">
                        </figure>
                    </td>
                </tr>
            </tbody>
        </table>

        <table style="width: 100%; margin: 1.2em 0;">
            <tbody>
                <tr>
                    <td><strong>To</strong></td>
                    <td>{{$order->name}}</td>
                    <td style="padding:0 70px"></td>
                    <td style="text-align: right;"></td>
                </tr>
                <tr>
                    <td>Address:</td>
                    <td class="adds">{{$order->address}}</td>
                    <td style="text-align: right;"></td>
                    <td class="adds" style="text-align: right;">Address: {!!$company->address!!}</td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td> {{$order->email}}</td>
                    <td style="padding:0 70px"></td>
                    <td style="text-align: right;">Email: {{$company->email}}</td>
                </tr>
                <tr>
                    <td>Contact No.</td>
                    <td style="font-style: italic;">{{$order->phone}}</td>
                    <td style="padding:0 70px"></td>
                    <td style="text-align: right;">Conatct No.: {{$company->mobile}}</td>
                </tr>

            </tbody>
        </table>

        <hr style="background-color: #05437D; height: 2px; border: none;">
        <h5 style="width: 100%; margin: 0; text-align: center; font-size: 1.2em; font-weight: 400; padding-top: 1.2em;">
            This document is an <strong>EMAIL</strong> invoice for the items indicated below.</td>

        </h5>

        <table style="width: 100%;">
            <tbody>
                <tr style="font-size: 1.2em;">
                    <td>
                        <h5 style="font-weight: 400;">Invoice Date: {{date("d-m-Y", strtotime($order->date))}}</h5>
                    </td>
                    <td style="text-align: right;">
                        <h5 style="font-weight: 400;">Payment due on invoice date plus Lorem ispum.</h5>
                    </td>
                </tr>
            </tbody>
        </table>


        <table style="margin: 1em 0 2em 0; width: ;">
            <tbody>
                <tr style="display:none;">
                    <td>
                        <figure style="margin: 0;">
                            <img src="https://www.samwebstudio.co.in/apora/beta/resources/assets/uploads/checkbox_mark.png" alt="checkbox_mark">
                            <img src="https://www.samwebstudio.co.in/apora/beta/resources/assets/uploads/checkbox_unmark.png" alt="checkbox_mark">
                        </figure>
                    </td>
                    <td style="font-size: 1.2em;">Bank Wire Transfer to Lorem ispum
                    </td>
                </tr>
                <tr style="display:none;">
                    <td>
                        <figure style="margin: 0;">
                            <img src="https://www.samwebstudio.co.in/apora/beta/resources/assets/uploads/checkbox_mark.png" alt="checkbox_mark">
                        </figure>
                    </td>
                    <td style="font-size: 1.2em;">Bank Draft Payable to Lorem ispum. at
                        the address above</td>
                </tr>
            </tbody>
        </table>

        <hr style=" height: 2px; background-color: #05437D; border: none;">


        <table style="width:100%; margin-bottom: 0.8em;">
            <tbody>
                <tr>
                    <td style="font-size: 1.2em; display:none;">License Aggrement</td>
                </tr>
            </tbody>
        </table>

        <table style="width: 45%;margin-left: auto; margin-bottom: 4em;">
            <tbody>
                @foreach($order_detail as $i)
                <tr>
                    <td style="padding-bottom:20px">{{$i->title}}</td>
                    <td style="padding-bottom:20px"></td>
                    <td style="padding-bottom:20px">{{$i->currency}} {{$i->amount}}/-</td>
                </tr>
                @endforeach
                @if($order->subtotal)
                <tr>
                    <td>Sub Total</td>
                    <td style="text-align: right;">{{$order->currency}} {{$order->subtotal}}/-</td>
                </tr>
                @endif
                @if($order->discount)
                <tr>
                    <td>Discount</td>
                    <td style="text-align: right;">{{$order->currency}} {{$order->discount}}/-</td>
                </tr>
                @endif
                @if($order->igst)
                <tr>
                    <td>GST {{$company->gst}}%</td>
                    <td style="text-align: right;">{{$order->currency}} {{$order->igst}}/-</td>
                </tr>
                @endif
                @if($order->total)
                <tr>
                    <td style="padding-bottom:20px"><strong>TOTAL</strong></td>
                    <td style="text-align: right; padding-bottom:20px"><strong>{{$order->currency}} {{$order->total}}/-</strong></td>
                </tr>
                @endif
            </tbody>
        </table>

        <br>
        <br>
        <br>
        <table style="width: 100%; margin-top:4em">
            <tbody>
                <tr>
                    <td style="font-size: 1.2em; margin-top: 6em; margin-bottom: 2em;">
                    </td>
                </tr>
            </tbody>
        </table>

        <hr style="height: 2px; background-color: #05437D; border: none;">

        <table style="width: 100%;">
            <tbody>
                <tr style="font-size:1.2em;">
                    <td width=50%>Invoice #: {{$InvoiceNo}}</td>
                    <td width=50% style="text-align: right;">GSTN: {{$company->gstn}}</td>
                </tr>
                <tr style="margin-top:20px;">
                    <td colspan="2">NOTE : {{$company->note}} </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>