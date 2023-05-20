<?php
   $MERCHANT_KEY = env('PAYUMONEY_MERCHANT_KEY');
   $SALT = env('PAYUMONEY_MERCHANT_SALT');
   if(env('APP_ENV')=='local'){ $PAYU_BASE_URL = "https://test.payu.in"; }
   else{ $PAYU_BASE_URL = "https://secure.payu.in"; }
   
   $action = '';
   $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
   $posted = array();
   $posted = array(
       'key' => $MERCHANT_KEY,
       'txnid' => $txnid,
       'amount' => $data->paid_amount,
       'firstname' => $data->user_name,
       'email' => $data->user_email,
       'productinfo' => 'Slot Booking No : #'.$data->booking_id,
       'surl' => url('payment-success/'.$data->booking_id.'?userinfo='.userinfo()->user_id),
       'furl' => url('payment-failed/'.$data->booking_id.'?userinfo='.userinfo()->user_id),
       'service_provider' => 'payu_paisa',
   );

   if(empty($posted['txnid'])) {
       $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
   }
   else
   {
       $txnid = $posted['txnid'];
   }
   $hash = '';
   $hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
   if(empty($posted['hash']) && sizeof($posted) > 0) {
       $hashVarsSeq = explode('|', $hashSequence);
       $hash_string = '';
       foreach($hashVarsSeq as $hash_var) {
           $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
           $hash_string .= '|';
       }
       $hash_string .= $SALT;
       $hash = strtolower(hash('sha512', $hash_string));
       $action = $PAYU_BASE_URL . '/_payment';
   }
   elseif(!empty($posted['hash']))
   {
       $hash = $posted['hash'];
       $action = $PAYU_BASE_URL . '/_payment';
   }
?>
<html>
<head>
<title>Payment Process...</title>
<style>
body{margin:0;padding:0;text-align:center;background:#ebebeb;height:100vh;}
</style>
<script>
var hash = '<?php echo $hash ?>';
function submitPayuForm() {
    if(hash == '') {
    return;
    }
    var payuForm = document.forms.payuForm;
        payuForm.submit();
}
</script>
</head>
<!-- onload="submitPayuForm()" -->
<body onload="submitPayuForm()" style="background: #ebebeb">
    <br><br>
<img src="{{asset('frontend/image/ZZ5H.gif')}}" style="width: 20px;"> Please Wait...
    <form action="<?php echo $action; ?>" method="post" name="payuForm">
        <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>" />
        <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
        <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
        <input type="hidden" name="amount" value="<?=$data->paid_amount?>" />
        <input type="hidden" name="firstname" id="firstname" value="<?=$data->user_name?>" />
        <input type="hidden" name="email" id="email" value="<?=$data->user_email?>" />
        <input type="hidden" name="productinfo" value="Slot Booking No : #<?=$data->booking_id?>">
        <input type="hidden" name="surl" value="<?=$posted['surl'];?>" />
        <input type="hidden" name="furl" value="<?=$posted['furl'];?>" />
        <input type="hidden" name="service_provider" value="payu_paisa" />
        <?php
        if(!$hash) { ?>
            <input type="submit" value="Submit" />
        <?php } ?>
    </form>
</body>
</html>