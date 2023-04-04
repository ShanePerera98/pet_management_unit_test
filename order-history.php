<?php
session_start();
require('connect.php');
// top menu
//error_reporting(0);
require_once('session.php');
include('menu-2.php');
// top menu    
    $userid=$_SESSION['id'];
$sql="SELECT orders.id AS order_id,orders.paymentMethod,orders.payment_status,orders.orderDate,orders.orderStatus FROM `orders` INNER JOIN `users` ON users.id=orders.user_id  WHERE orders.user_id='$userid'";
$stmt=$pdo->prepare($sql);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

include('header.php');

?>
<style>
    #pay ul{
        margin:0;
        padding:0;

    }
    #pay li{
        float:left;
        list-style-type:none;
    }
</style>

  <div  class="content-container">
    <div class="content-left">
    
     <table border="2" class="" cellpadding="" align="center" style="width:80%; margin:0 auto; border-collapse:collapse; text-align:center;margin-top:10px; margin-bottom:20px;">
         <tr>
             <th>
                 S/No
             </th>
             <th>Order Id</th>
             <th>
                 Payment Method
             </th>
             <th>
                 Payment Status
             </th>
             <th>
                 Order Status
             </th>
             <th>
                 Order Date
             </th>
             <th>
                 Action
             </th>
         </tr>
         <?php 
         $i=1; 
            foreach($rows as $row){

           
         ?>
         <tr>
             <td><?php echo $i;?></td>
             <td><?php echo "#".$row['order_id'];?></td>
             <td><?php echo $row['paymentMethod'];?></td>
             <td><?php echo $row['payment_status'];?></td>
             <td><?php echo $row['orderStatus'];?></td>
             <td><?php echo $row['orderDate'];?></td>
             <td><a href="order-detail.php?oid=<?php echo $row['order_id'];?>" target="_blank">View</a></td>
         </tr>
         <?php
         //$i++;
            
            $i++;
        }
        
         ?>
     </table>
       
    </div>

    
  </div>

<?php include('footer.php');
?>
