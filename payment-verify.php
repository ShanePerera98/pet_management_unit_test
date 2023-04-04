<?php
require('connect.php');
require_once('paystack_function.php');
$reference = isset($_GET['reference']) ? $_GET['reference'] : '';
if(!$reference){
  die('No reference supplied');
}
$response=paystack_verify($reference);

$tranx = json_decode($response);

if('success' == $tranx->data->status){
  $refid=$tranx->data->reference;
  $amt=$tranx->data->amount;
  $amount=$amt/100;
  $email=$tranx->data->customer->email;
  $order_id=$tranx->data->metadata->order_id;
$create_at=date("d-m-Y h:i:a");

$sql="UPDATE orders SET payment_status ='paid',payment_date ='".$create_at."' WHERE id='".$order_id."'";
$stmt=$pdo->prepare($sql);
$stmt->execute();
echo'<script>alert("Payment Successfull, Thank You!!");
location.href="order-history.php";</script>';	
}
?>