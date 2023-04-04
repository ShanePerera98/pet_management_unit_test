<?php
require('../connect.php');

$sql="SELECT * FROM `orders` JOIN dogs JOIN users ON orders.productId=dogs.d_id AND orders.userId=users.id WHERE orderStatus='Delivered' ";
$stmt=$pdo->prepare($sql);
$stmt->execute();
$rows=$stmt->fetchAll(PDO::FETCH_ASSOC);

include('header.php');
?>

<script type="text/javascript">

function print1(strid)
{
if(confirm("Do you want to print?"))
{
var values = document.getElementById(strid);
var printing =
window.open('','','left=0,top=0,width=550,height=400,toolbar=0,scrollbars=0,sta­?tus=0');
printing.document.write(values.innerHTML);
printing.document.close();
printing.focus();
printing.print();
printing.close();
}
}
</script>
  <div id="main-content" >

    <div class="content-left">
        <!-- side bar here -->
        <?php include('b_side_bar.php');?>
        <!-- side bar end -->

    </div>

<div class="right">
    <div class="sales" style="margin-top:20px;" id="sales">
        <table cellpadding="15px;">
        <tr style="background:#333;color:#fff;">
            <td>#</td>
            <td>Dog Name</td>
            <td>Quantity</td>
            <td>Customer</td>
            <td>Order Date</td>
            <td>Method of Payment</td>
            <td>Status</td>
            <td>Price</td>
            </tr>
        <?php
        $i=1;
        foreach($rows as $row){

        
        ?>
         <!-- order_id	productId	 -->
            <tr>
                <td><?php echo $i;?></td>
                <td><?php echo $row['d_name'];?></td>
                <td><?php echo $row['order_quantity'];?></td>
                <td><?php echo $row['firstname']." ".$row['lastname'];?></td>
                <td><?php echo $row['orderDate'];?></td>
                <td><?php echo $row['paymentMethod'];?></td>
                <td><?php echo $row['orderStatus'];?></td>
                <td><?php echo $row['price'];?></td>
                             
            </tr>

            <?php
            $i++;
        }
            $sql="SELECT *, SUM(dogs.price) as priceTotal FROM `orders` JOIN dogs ON orders.productId=dogs.d_id   WHERE `orderStatus`='Delivered'";
            $stmt=$pdo->prepare($sql);
            $stmt->execute();
            $tots=$stmt->fetchAll(PDO::FETCH_ASSOC);
            $total=$tots[0];
            ?>
            <tr align="right">
                <td colspan="7" style="background:#ccc;">Total</td><td style="background:#ccc;"><?php echo $total['priceTotal'];?></td>
            </tr>
        </table>
    </div>
    <hr>
    <input type="button" style="width:100px; height:40px;color:#fff; background:#333;" name="printbutton" value="Print Sales" onclick="return print1('sales')"/>
  </div>
</div>

<?php include('footer.php');
?>