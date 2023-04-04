<?php
// session_start();
require_once('../connect.php');

// for today order
$f1="00:00:00";
$from=date('Y-m-d')." ".$f1;
$t1="23:59:59";
$to=date('Y-m-d')." ".$t1;
 $sql ="SELECT count(*) as todayorder FROM orders WHERE orderDate BETWEEN '$from' AND '$to'";
$stmt=$pdo->prepare($sql);
$stmt->execute();
$todays=$stmt->fetchAll(PDO::FETCH_ASSOC);
$today=$todays[0];
// echo $today['todayorder'];
// todays order end

// pending order
$status='Delivered';
$sql="SELECT count(*) as pending FROM orders WHERE orderStatus!='$status' || orderStatus is null ";
$stmt=$pdo->prepare($sql);
$stmt->execute();
$pendings=$stmt->fetchAll(PDO::FETCH_ASSOC);
$pending=$pendings[0];									 

// echo $pending['pending'];
// pending order end

// Delivered Order
$sql="SELECT count(*) as deliver FROM Orders where orderStatus='$status'";
$stmt=$pdo->prepare($sql);
$stmt->execute();
$delivereds=$stmt->fetchAll(PDO::FETCH_ASSOC);
$delivered=$delivereds[0];
// echo $delivered['deliver'];
// Delivered Order end

?>
				
										

