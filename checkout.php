<?php
// session_start();
require('connect.php');
session_start();
if(strlen($_SESSION['loggedin'])==0)
// if($_SESSION['loggedin']==false)
  {   
header('location:login_reg.php');
}
if(isset($_POST['check-out'])){
 
 
  $productid=$_POST['productid'];
  $quant='1';
  $price=$_POST['price'];
  $userid=$_SESSION['id'];
  $total=$_POST['total'];
  $created_at=date('d-m-Y');
  $sql="INSERT INTO order(userId,productId,quantity )";
  $sql="INSERT INTO orders(user_id,total) VALUES('$userid','$total')";
  $stmt=$pdo->prepare($sql);
  $stmt->execute();
  $order_id = $pdo->lastInsertId();
 
  

  $sql2 = "INSERT INTO order_details(dog_id,quantity,order_id,created_at) VALUES";
foreach ($productid as $key =>$did){

$sql2.="('$did','$quant','$order_id','$created_at'),";
}
$sql2 = substr($sql2,0, strlen($sql2)-1);
$stmt2 = $pdo->prepare($sql2);
   
try{
	$stmt2->execute();
  $_SESSION['order_id']=$order_id;
	echo '<script>alert("Successfully");
		 location.href="payment.php";</script>';
 
}

	catch(Exception $e){
	echo $e->getMessage();
	// echo '<script>alert("Server error");
	// 	 location.href="cart.php";</script>';
	}
}
  ?>