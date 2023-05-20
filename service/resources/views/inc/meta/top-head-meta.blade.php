<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-P4XMV6K');</script>
<!-- End Google Tag Manager -->
@if(Request::segment(1)=='gateway-response')
@php
if(!empty($transaction_id)){
    $data = DB::table('order')->where('transaction_id',$transaction_id)->first();
    $products = DB::table('order_details')->where('order_id',$data->id)->get();
    $Html='';
    $Html2='';
    foreach($products as $key => $Roe):
       $category_detail = DB::table('nav_category')
                            ->leftJoin('pricing', 'nav_category.id', '=', 'pricing.category_id')
                            ->select('nav_category.title as category')
                            ->where('pricing.id', $Roe->price_id)
                            ->first();
        $Html .='{
                item_name: "'.$Roe->title.'",
                item_id: "'.$Roe->price_id.'",
                price: '.$Roe->amount.',
                item_category: "'.$category_detail->category.'",
                item_variant: "'.$Roe->text.'",
                quantity: 1
              }';
        if($products->count()!=($key+1)){$Html .=',';}   
        
         $Html2 .='{
                name: "'.$Roe->title.'",
                id: "'.$Roe->price_id.'",
                price: '.$Roe->amount.',
                category: "'.$category_detail->category.'",
                variant: "'.$Roe->text.'",
                quantity: 1
              }';
        if($products->count()!=($key+1)){$Html2 .=',';}   
    endforeach;

@endphp
<script>
     dataLayer.push({ ecommerce: null });  // Clear the previous ecommerce object.
        dataLayer.push({
          event: "purchase",
          ecommerce: {
              transaction_id: "{{$transaction_id}}",
              affiliation: "Online Store",
              value: "{{$data->total}}",
              tax: "{{$data->igst}}",
              shipping: "0",
              currency: "{{$data->currency}}",
              items: [{!! $Html !!}]
          }
        });
        
     dataLayer.push({ ecommerce: null });  // Clear the previous ecommerce object.
        dataLayer.push({
          'ecommerce': {
            'purchase': {
              'actionField': {
                'id': '{{$transaction_id}}',                         // Transaction ID. Required for purchases and refunds.
                'affiliation': 'Online Store',
                'revenue': '{{$data->total}}',                     // Total transaction value (incl. tax and shipping)
                'tax':'{{$data->igst}}',
                'shipping': '0',
              },
              'products': [{!! $Html2 !!}
               ]
            }
          }
        });  
        
</script>
@php } @endphp
@endif
