<?php
// session_start();
require('../connect.php');
// $f1="00:00:00";
// $from=date('Y-m-d')." ".$f1;
// $t1="23:59:59";
// $to=date('Y-m-d')." ".$t1;
$status='Delivered';
$sql ="SELECT * FROM orders JOIN users JOIN products ON orders.userId=users.id AND orders.productid=products.product_id WHERE  orderStatus='$status'";
$stmt=$pdo->prepare($sql);
$stmt->execute();
$pends=$stmt->fetchAll(PDO::FETCH_ASSOC);
// $pend=$pendings[0];
// $today=$todays[0];

// echo $pending['firstname'];
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
            foreach($pends as $pend){
                // Full texts	id	firstname	lastname
                            
            ?>
            <tr>
                <td><?php echo $i;?></td>
                <td><?php echo ($pend['firstname']." ".$pend['lastname']);?></td>
                <td><?php echo $pend['email']."  ".$pend['phone'];?></td>
                <td><?php echo $pend['address'];?></td>
                <td><?php echo $pend['product_name'];?></td>
                <td><?php echo $pend['order_quantity'];?></td>
                <td><?php echo $pend['price'];?></td>
                <td><?php echo $pend['orderDate'];?></td>
                <td><a href="update-order.php?oid=<?php echo $pend['order_id'];?>"><img src="../img/action.png" alt=""></a></td>
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