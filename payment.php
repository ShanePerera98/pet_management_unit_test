<?php
session_start();
require('connect.php');
// top menu
include('menu-2.php');
// top menu end
require_once('paystack_function.php');


if(!isset($_SESSION['loggedin']))
    {   
header('location:login_reg.php');
}
elseif(!isset($_SESSION['order_id'])){
    header('location:cart.php');
}
else{
    $userid=$_SESSION['id'];
    $order_id=$_SESSION['order_id'];
    $sql="SELECT * FROM users WHERE id='$userid'";
$stmt=$pdo->prepare($sql);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$sql3="SELECT * FROM orders WHERE id='$order_id'";
$stmt3=$pdo->prepare($sql3);
$stmt3->execute();
$row2 = $stmt3->fetch(PDO::FETCH_ASSOC);

	if(isset($_POST['submit'])) {
            
        if($_POST['paymethod']=="paystack"){
            $newAmount =$row2['total']*100;  //the amount in kobo.
            $reference=time().mt_rand(99,999999);
            $fields = [
              'email' =>$row['email'],
              'amount' =>$newAmount,
              'reference' =>$reference,
              'callback_url'=>'http://localhost/dog-world/payment-verify.php',
              'channels'=>['card'],
              'metadata'=>json_encode([
                    'order_id'=>$order_id
                     ])
            ];
            $pay=paystack($fields);
            $decode_pay=json_decode($pay,true);
            $status=$decode_pay['status'];
            $msg=$decode_pay['msg'];
            if($status==true){
                $sql="UPDATE orders SET paymentMethod='".$_POST['paymethod']."',delivery_address='".$_POST['delivery_address']."' WHERE id='".$_SESSION['order_id']."'";
                $stmt=$pdo->prepare($sql);
                $stmt->execute();
                unset($_SESSION['shopping_cart']);
                unset($_SESSION['order_id']);
                echo "<script>window.location.href='{$msg}';</script>";
                exit();
            }
            else{
              echo "<script>alert('{$msg}');window.location.href='cart.php';</script>"; 
              exit();
            }

        }
        else{
            $sql="UPDATE orders SET paymentMethod='".$_POST['paymethod']."',delivery_address='".$_POST['address']."' WHERE id='".$_SESSION['order_id']."'";
            $stmt=$pdo->prepare($sql);
            $stmt->execute();
       
            unset($_SESSION['shopping_cart']);
            unset($_SESSION['order_id']);
            echo'<script>alert("Payment Successfull, Thank You!!");
            location.href="order-history.php";</script>';
    
        }
      
    }
}
include('header.php');
//require('connect')
?>
<script>
  function Changepay(val){
 var element=document.getElementById('show');
 if(val=='Card-Payment')
//  if(val=='Card-Payment' || val=='Debit Card')
   element.style.display='block';
 else  
   element.style.display='none';
}
  
</script>    
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
    <div class="content-left" style="height:400px;">
  
     <fieldset id="pay" style="height:300px;width:40%">
         <legend>SELECT PAYMENT METHOD</legend>
         <form action="payment.php" method="post">
         <div class="form-group" >
         <label for="address">Address</label><br>
      <textarea name="delivery_address" style="width:350px; height:70px; margin-bottom:5px;"><?=$row['address']?></textarea>
                </div>
        <!-- <ul>
            <li> Payament on Delivery<input type="radio" name="paymethod" value="payment_on_delivery"/></li>
            <li>Credit/Debit Card <input type="radio" name="paymethod" value="Credit_Debit_card" /></li>
            <li><input type="submit" name="submit" value="Submit" /></li>
        </ul> -->
        <img src="img/payment-icons.png" alt="" style="width:250px;height:35px; margin-bottom:10px;"> <br>
        <div class="form-group">
                <!-- <label for="#">SELECT METHOD OF PAYMENT</label><br> -->

                <select name="paymethod" style="width:40%; height:40px; margin-bottom:20px;" onchange='Changepay(this.value);'>
                    <option value="">- Select Method -</option>
                    <option value="on delivery">Payament on Delivery</option>
                    <option value="paystack">Card Payment</option>
                    <!-- <option value="Bank Payment">Bank Payment</option> -->
</select>
            </div>
           
            <input type="submit" name="submit" value="Submit" />
     </form>
     </fieldset>
       
    </div>

    
  </div>

<?php include('footer.php');
?>
