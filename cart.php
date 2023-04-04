<?php
/* error_reporting(0); */
session_start();

include('menu-2.php');
include('header.php');
require('connect.php');

if(isset($_GET["action"]))
{
  if($_GET["action"] == "delete")
  {
    foreach($_SESSION["shopping_cart"] as $keys => $values)
    {
      if($values["item_id"] == $_GET["product_id"])
      {
        unset($_SESSION["shopping_cart"] [$keys]);
        echo '<script>alert("dog Removed form Cart")</script>';
        echo '<script>window.location="cart.php"</script>';

      }
    }
  }
}




$sql="SELECT `id`,`name`  FROM category";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$cts= $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<style>
.product-container{
    width:250px;
     height:auto;
      float:left;
      margin-bottom:20px;
    margin-right:10px;
    margin-top:10px;
    padding-bottom:20px;
    border:1 solid #000;
    /* border-radius:20px; */
    background:#33f;
    text-align:center;

}
.product-container input[type=submit]{
    margin-top:3px;
    font-weight:bold;
    color:red;
    width:150px;
    height:30px;

}
.product-container input[type=submit]:hover{
    color:#000;
    background:#ccc;
}
#checkout{
  text-decoration:none;
  font-size:15px;
  color:red;
  font-weight:bold;
}
#checkout:hover{
  color:#333;

}
</style>


  <div id="main-content" >

    <div class="content-left">
        <h3 style="text-align:center">DOG CATEGORIES</h3>
		<hr>
        <div class="admin_panel">
            <ul>
                <li>
                <?php 
                // while($ct =$stmt->fetch()){
                // while($row=mysqli_fetch_array($sql))
                foreach($cts as $ct){
                    ?>
                <a href="d-category.php?cid=<?php echo $ct['id'];?>">
                <?php echo $ct['name'];?></a>
                
                <?php }?>

                </li>
                
            </ul>
        </div>

    </div>

<div class="right" style="height:500px;">
<form action="checkout.php" method="post">
<table border="1" width="100%" cellpadding="15px;" style="border-collapse:collapse;border-color:black; margin-top:5%">
          <tr>
            <th colspan="5"><h3>Dogs Added to Cart</h3></th>  
          </tr>
          <tr>
              <th width="20%">Dogs Name</th>
              <th width="20%">Quantity</th>
              <th width="20%">Price</th>
              
              <th width="10%">Action</th>
          </tr>
          <?php
         
          if(!empty($_SESSION['shopping_cart']))
          {
            $total = 0;
            // print_r($_SESSION["shopping_cart"]);
            // exit();
            foreach($_SESSION["shopping_cart"] as $keyd => $values)
            {
              ?>
              <tr>
                <td>
					<input type="hidden" name="productid[]" value="<?php echo $values['item_id']?>">   
					<?php echo $values["item_name"];?>
				</td>
                <td><?php echo $values["item_num"];?>
				         </td>

                <td>N<?php echo number_format($values["item_price"],2);?>
					<input type="hidden" name="price" value="<?php echo $values["item_price"];?>">
                </td>
                
                <td><a href="cart.php?action=delete&product_id=<?php echo $values["item_id"];?>" style="color:red"><span>Remove from Cart</span></a></td>
              </tr>
              <?php
              $total =$total + 1 * $values["item_price"];
            }
            ?>
            <tr>
                <th align="right" colspan="2">Total:</th>
                <th align="right">N<?php echo number_format($total, 2);?></th>
                <th>
                  <input type="hidden" name="total" value="<?=$total?>">
                      <input type="submit" name="check-out" id="checkout" value="Check Out">
				</th>
            </tr>
            <?php
            
          }
          else{
            echo '<tr style="text-align:center; color:red"><td colspan="5">Cart is empty!!!</td></tr>';
            }
          ?>
        </table>

        </form>
  </div>
</div>

<?php include('footer.php');
?>