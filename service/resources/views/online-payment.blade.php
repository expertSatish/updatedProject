<?php
ob_start();
$active = 'Home';
?>
@include('inc.html')

<head>
    @php
    $meta=DB::table('page_section')->where('id',51)->first();
    @endphp
    <title>{!! $meta->meta_title !!}</title>
    <meta name="keywords" content="{!! $meta->meta_keywords !!}">
    <meta name="description" content="{!! $meta->meta_description !!}">
    @include('inc.header')
    <section class="blog pb0 pt20px Contact d-block">
        <div class="breadcrumb-main">
            <div class="breadcrumb-bg">
                <div class="container">
                    <div class="row">
                        <div class="col s12">
                            <a href="{{url('/')}}" class="breadcrumb">Home</a>
                            <a href="{{url('/online-payment')}}" class="breadcrumb">Online Payment</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="Home TexeBlock Contact pt30px">
        <div class="container">
            <div class="center">
                <h1 class="h4 Heading">Online Payment</h1>
            </div>
            <div class="row">
                <div class="col s12">
                    <div class="w70">
                        <div class="ContactForm">
                            <form action="" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col s12 l6">
                                        <div class="input-field"><input type="text" name="name" id="name" placeholder="" required><label for="name" class="active">Name*</label></div>
                                    </div>
                                    <div class="col s12 l6">
                                        <div class="input-field"><input type="text" name="amount" id="amount" placeholder="" required><label for="amount" class="active">Amount*</label></div>
                                    </div>
                                    <div class="col s12 l6">
                                        <div class="input-field"><input type="email" name="email" id="email" placeholder="" required><label for="email" class="active">Email ID*</label></div>
                                    </div>
                                    <div class="col s12 l6">
                                        <div class="input-field"><input type="number" name="contact" id="contactno" maxlength="10" data-length="10" oninput="maxLengthCheck(this)" placeholder="" required><label for="contactno" class="active">Contact No.*</label></div>
                                    </div>
                                    <div class="col s12">
                                        <div class="input-field"><textarea name="message" id="message" class="materialize-textarea" maxlength="300" data-length="300" placeholder="" required></textarea><label for="message" class="active">Message*</label></div>
                                    </div>
                                </div>
                                <div class="input-field center"><button type="button" onclick="PaymenProcess();" class="btn btn-main waves-effect waves-light">Pay Now</button></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('inc.footer')
    <script>
        function maxLengthCheck(object) {
            if (object.value.length > object.maxLength)
                object.value = object.value.slice(0, object.maxLength)
        }
    </script>
















    <form action="#" id="payment_form" method="post">
        @csrf
        <input type="hidden" id="udf5" name="udf5" value="" />
        <input type="hidden" id="surl" name="surl" value="" />
        <input type="hidden" id="key" name="key" placeholder="Merchant Key" value="HymH2saI" />
        <input type="hidden" id="salt" name="salt" placeholder="Merchant Salt" value="YRucf3Dt0E" />
        <input type="hidden" id="txnid" name="txnid" id="txnid" placeholder="Transaction ID" value="" />
        <input type="hidden" id="amount" name="amount" placeholder="Amount" value="" />
        <input type="hidden" id="pinfo" name="pinfo" placeholder="Product Info" value="" />
        <input type="hidden" id="fname" name="fname" placeholder="First Name" value="" />
        <input type="hidden" id="email" name="email" placeholder="Email ID" value="" />
        <input type="hidden" id="mobile" name="mobile" placeholder="Mobile/Cell Number" value="" />
        <input type="hidden" id="hash" name="hash" placeholder="Hash" value="" />
        <input type="submit" style="display: none;" value="Pay" onclick="launchBOLT();" />
    </form>

    <script id="bolt" src="https://checkout-static.citruspay.com/bolt/run/bolt.min.js" bolt- color="e34524" bolt-logo="https://www.expertbells.com/resources/assets/uploads/logo/2021-05-133507886.png"></script>



    <script>
        function PaymenProcess() {
            var name = $('input[name=name]').val();
            var email = $('input[name=email]').val();
            var amount = $('input[name=amount]').val();
            var contact = $('input[name=contact]').val();
            var message = $('textarea[name=message]').val();

            var URL = "{{url('/online-payment-save/')}}";

            $.get(URL, {
                name: name,
                email: email,
                amount: amount,
                contact: contact,
                message: message,

            }, function(data) {
                var Ret = data.split('^');

                $('#amount').val(Ret[2]);
                $('#pinfo').val('Online Payment');
                $('#fname').val(Ret[1]);
                $('#mobile').val(Ret[4]);
                $('#email').val(Ret[3]);
                $('#surl').val(Ret[5]);
                $('#txnid').val(Ret[6]);
                $('#orderId').val(Ret[7]);
                GenerateHash();
                setTimeout(function() {
                    launchBOLT();
                }, 1000);
            });
        }




        function GenerateHash() {
            $.ajax({
                url: "{{url('generate-hash')}}",
                type: 'get',
                data: {
                    key: $('#key').val(),
                    salt: $('#salt').val(),
                    txnid: $('#txnid').val(),
                    amount: $('#amount').val(),
                    pinfo: $('#pinfo').val(),
                    fname: $('#fname').val(),
                    email: $('#email').val(),
                    mobile: $('#mobile').val(),
                    udf5: $('#udf5').val()
                },

                success: function(json) {


                    $('#hash').val(json);

                }
            });
        }


        function launchBOLT() {


            bolt.launch({
                key: $('#key').val(),
                txnid: $('#txnid').val(),
                hash: $('#hash').val(),
                amount: $('#amount').val(),
                firstname: $('#fname').val(),
                email: $('#email').val(),
                phone: $('#mobile').val(),
                productinfo: $('#pinfo').val(),
                udf5: $('#udf5').val(),
                surl: $('#surl').val(),
                furl: $('#surl').val(),
                mode: 'dropout'
            }, {
                responseHandler: function(BOLT) {
                    console.log(BOLT.response.txnStatus);

                    if (BOLT.response.txnStatus != 'CANCEL') {

                        //Salt is passd here for demo purpose only. For practical use keep salt at server side only.
                        var fr = '<form action=\"' + $('#surl').val() + '\" method=\"get\">' +
                            '<input type=hidden name=_token value={{csrf_token()}}>' +
                            '<input type=\"hidden\" name=\"key\" value=\"' + BOLT.response.key + '\" />' +
                            '<input type=\"hidden\" name=\"salt\" value=\"' + $('#salt').val() + '\" />' +
                            '<input type=\"hidden\" name=\"txnid\" value=\"' + BOLT.response.txnid + '\" />' +
                            '<input type=\"hidden\" name=\"amount\" value=\"' + BOLT.response.amount + '\" />' +
                            '<input type=\"hidden\" name=\"productinfo\" value=\"' + BOLT.response.productinfo + '\" />' +
                            '<input type=\"hidden\" name=\"firstname\" value=\"' + BOLT.response.firstname + '\" />' +
                            '<input type=\"hidden\" name=\"email\" value=\"' + BOLT.response.email + '\" />' +
                            '<input type=\"hidden\" name=\"udf5\" value=\"' + BOLT.response.udf5 + '\" />' +
                            '<input type=\"hidden\" name=\"mihpayid\" value=\"' + BOLT.response.mihpayid + '\" />' +
                            '<input type=\"hidden\" name=\"status\" value=\"' + BOLT.response.status + '\" />' +
                            '<input type=\"hidden\" name=\"hash\" value=\"' + BOLT.response.hash + '\" />' +
                            '</form>';
                        var form = jQuery(fr);
                        jQuery('body').append(form);
                        form.submit();
                    }
                },
                catchException: function(BOLT) {
                    alert(BOLT.message);
                }
            });
        }
    </script>