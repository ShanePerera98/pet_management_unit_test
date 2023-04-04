<?php
session_start();
error_reporting(0);
include_once 'connect.php';
$order_id=intval($_GET['oid']);
 ?>
<script language="javascript" type="text/javascript">
function f2()
{
window.close();
}ser
function f3()
{
window.print(); 
}
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Order Tracking Details</title>
<link href="style.css" rel="stylesheet" type="text/css" />

</head>
<body>

<div style="margin-left:50px;">
 <form name="updateticket" id="updateticket" method="post"> 
<table width="100%" border="0" cellspacing="0" cellpadding="0">

    <tr height="50">
      <td colspan="2" style="padding-left:0px;"><div class="fontpink2"> <b>Order Tracking Details !</b></div></td>
      
    </tr>
    <tr height="30">
      <td><b>order Id:</b></td>
      <td><?php echo $order_id;?></td>
    </tr>
    <?php 
$ret ="SELECT * FROM ordertrackhistory WHERE orderId='$order_id'";
$stmt=$pdo->prepare($ret);
$stmt->execute();
$nums=$stmt->fetchAll(PDO::FETCH_ASSOC);
if($nums[0]>0)
{
$num=$nums[0];
     ?>
		
    
    
      <tr height="20">
      <td><b>At Date:</b></td>
      <td><?php echo $num['postingDate'];?></td>
    </tr>
     <tr height="20">
      <td><b>Status:</b></td>
      <td><?php echo $num['status'];?></td>
    </tr>
     <tr height="20">
      <td><b>Remark:</b></td>
      <td><?php echo $num['remark'];?></td>
    </tr>

   
    <tr>
      <td colspan="2"><hr /></td>
    </tr>
   <?php  }
else{
   ?>
   <tr>
   <td colspan="2">Order Not Process Yet</td>
   </tr>
   <?php  }
$st='Delivered';
   $rt ="SELECT * FROM orders WHERE order_id='$order_id'";
   $stmt=$pdo->prepare($rt);
   $stmt->execute();
   $rows=$stmt->fetchAll(PDO::FETCH_ASSOC);

   $row=$rows[0];
   
     $currrentSt=$row['orderStatus'];
   
     if($st==$currrentSt)
     { ?>
   <tr><td colspan="2"><b>
      Product Delivered successfully </b></td>
   <?php } 
 
  ?>
</table>
 </form>
</div>

</body>
</html>

     
