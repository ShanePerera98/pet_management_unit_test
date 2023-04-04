<?php
// session_start();
require('../connect.php');
$f1="00:00:00";
$from=date('Y-m-d')." ".$f1;
$t1="23:59:59";
$to=date('Y-m-d')." ".$t1;
$sql ="SELECT * FROM orders JOIN users JOIN products ON orders.userId=users.id and orders.productid=products.product_id WHERE orderDate BETWEEN '$from' AND '$to' and OrderStatus is Null";
$stmt=$pdo->prepare($sql);
$stmt->execute();
$tods=$stmt->fetchAll(PDO::FETCH_ASSOC);
// $today=$todays[0];
// $today=$todays[0];

//echo $today['firstname'];
include('header.php');


?>


  <div id="main-content" >

    <div class="content-left">
        <!-- side bar here -->
        <?php include('admin_side_bar.php');?>
        <!-- side bar end -->

    </div>

<div class="right">
    <!-- todays order table -->
        <table border="1" style="width:95%; text-align:center; margin-top:20px;">
            <tr style="background:#333; color:#fff;">
                <th>#</th>
                <th>Name</th>
                <th>Email/Contact No</th>
                <th>Shopping Address</th>
                <th>product</th>
                <th>Qty</th>
                <th>Amount</th>
                <th>Order Date</th>
                <th>Action</th>
            </tr>

            <?php
            $i=1;
            foreach($tods as $tod){
                // Full texts	id	firstname	lastname
                            
            ?>
            <tr>
                <td><?php echo $i;?></td>
                <td><?php echo ($tod['firstname']." ".$tod['lastname']);?></td>
                <td><?php echo $tod['email']."  ".$tod['phone'];?></td>
                <td><?php echo $tod['address'];?></td>
                <td><?php echo $tod['product_name'];?></td>
                <td><?php echo $tod['order_quantity'];?></td>
                <td><?php echo $tod['price'];?></td>
                <td><?php echo $tod['orderDate'];?></td>
                <td><a href="update-order.php?oid=<?php echo $tod['order_id'];?>"><img src="../img/action.png" alt="" style="text-align:center;"></a></td>
            </tr>

            <?php
            $i++;
            }
            ?>
        </table>
    <!-- todays order table end -->
  </div>
</div>

<?php include('footer.php');
?>