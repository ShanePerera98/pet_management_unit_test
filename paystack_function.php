<?php

function paystack($fields){
    $secret_key='sk_test_f7d67101573ca9b12c876925edfd677acfbc623e';
    $url = "https://api.paystack.co/transaction/initialize";
     $fields_string = http_build_query($fields);
     //open connection
     $ch = curl_init();
     
     //set the url, number of POST vars, POST data
     curl_setopt($ch,CURLOPT_URL, $url);
     curl_setopt($ch,CURLOPT_POST, true);
     curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
     curl_setopt($ch, CURLOPT_HTTPHEADER, array(
       "Authorization: Bearer ".$secret_key,
       "Cache-Control: no-cache",
     ));
     
     //So that curl_exec returns the contents of the cURL; rather than echoing it
     curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 
     
     //execute post
     $request = curl_exec($ch);
     $err = curl_error($ch);
     curl_close($ch);
     if($err){
       // there was an error contacting the Paystack API
       return json_encode(['status'=>false,'msg'=>'Network error, please connect to internet']);
   }
   else{
       $response = json_decode($request, true);
       if($response['status']===true){
           return json_encode(['status'=>true,'msg'=>$response['data']['authorization_url']]);
    
       }
       else{
           return json_encode(['status'=>false,'msg'=>'Transaction failed']);
       }
       
   }
}

function paystack_verify($reference){
    $secret_key='sk_test_f7d67101573ca9b12c876925edfd677acfbc623e';
    $curl=curl_init();
   curl_setopt_array($curl, array(
       CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . rawurlencode($reference),
       CURLOPT_RETURNTRANSFER => true,
       CURLOPT_HTTPHEADER => [
         "accept: application/json",
         "Authorization: Bearer ".$secret_key,
         "cache-control: no-cache"
       ],
     ));
     
     $response = curl_exec($curl);
     $err = curl_error($curl);
     curl_close($curl);
     
     if($err){
         // there was an error contacting the Paystack API
       return "network error";
     }
     else{
         return $response;
     }
}