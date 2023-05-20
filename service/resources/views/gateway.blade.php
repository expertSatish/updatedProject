<center><img src="https://upload.wikimedia.org/wikipedia/commons/5/54/Ajux_loader.gif"></center>


<?php

$MERCHANT_KEY = "HymH2saI";
$SALT = "YRucf3Dt0E";
// Merchant Key and Salt as provided by Payu.

$PAYU_BASE_URL = "https://sandboxsecure.payu.in";       // For Sandbox Mode
//$PAYU_BASE_URL = "https://secure.payu.in";            // For Production Mode

$action = '';

$txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
$action = $PAYU_BASE_URL . '/_payment';

?>


<html>
  <head>
  
  </head>
  <body >
   
   
    <form action="<?php echo $action; ?>" method="post" name="payuForm">
        @csrf
      <input type="hidden" name="key" id="key" value="<?php echo $MERCHANT_KEY ?>" />
      <input type="hidden" name="salt" id="salt" value="<?php echo $SALT ?>" />
      <input type="hidden" name="hash" id="hash" value=""/>
      <input type="hidden" name="txnid" id="txnid" value="<?php echo $txnid ?>" />
      <input type="hidden" name="amount" id="amount" value="{{$amount}}" />
      <input type="hidden" name="firstname" id="fname" value="{{$name}}" />
      <input type="hidden" name="email" id="email" value="{{$email}}" />
      <input type="hidden" name="phone" id="phone" value="{{$phone}}" />
      <textarea style="display: none;" id="pinfo" name="productinfo">{!! $productinfo !!}</textarea>
      <input type="hidden" name="surl" value="{{url('gateway-response')}}" size="64" />
      <input type="hidden" name="furl" value="{{url('payment-canceled')}}" size="64" />
      <input type="hidden" type="hidden" name="service_provider" value="payu_paisa" size="64" />
      <input name="lastname" type="hidden" id="lastname" value="" />
      <input name="curl" type="hidden" value="" />
      <input name="address1" type="hidden" value="{{$address}}" />
      <input name="address2" type="hidden" value="" />
      <input name="city" type="hidden" value="{{$city}}" />
      <input name="state" type="hidden" value="{{$state}}" />
      <input name="country" type="hidden" value="" />
      <input name="zipcode" type="hidden" value="" />
      <input name="udf1" type="hidden" id="udf1" value="" />
      <input name="udf2" type="hidden" id="udf2" value="" />
         
            <td colspan="4"><input type="submit" id="button" value="Submit" /></td>
         
        
      </table>
    </form>
  </body>
</html>



<script type="text/javascript" passive src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
    
<script type="text/javascript">
    

    $(document).ready(function(){

        GenerateHash();

        setTimeout(function(){

            $('#button').click();

        },1000);

    });


    function GenerateHash()
            {
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
                    mobile: $('#phone').val(),
                    udf5: $('#udf1').val()
                  },
                 
                  success: function(json) {

                    
                        $('#hash').val(json);
                   
                  }
                });
            }


</script>
