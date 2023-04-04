<?php
error_reporting(0);
session_start();
include('header.php');
require('../connect.php');
if(isset($_POST['update'])){
    $product_id=$_POST['productid'];
    $price=$_POST['price'];
    $quantity=$_POST['quantity'];

    $sql="UPDATE products SET price=:pric,quantity=:quant WHERE product_id=:productid ";
    $stmt=$pdo->prepare($sql);
    $stmt->bindParam(":pric",$price);
    $stmt->bindParam(":quant",$quantity);
    $stmt->bindParam(":productid",$product_id);
    try{
        $stmt->execute();
        echo"<script>alert('Updated Successfully');
        location.href='manage_products.php';</script>";

    }catch(Exception $e){
		echo $e->getMessage();
		echo '<script>alert("Update  Contact The Admin at admin@blb.com.ng");
		location.href="manage_products.php";</script>';

		}
}
$productid=$_GET['productid'];
$sql="SELECT * FROM `products` JOIN category  ON products.category=category.id  WHERE product_id=$productid";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
$row=$rows[0];

?>



  <div id="main-content" >

    <div class="content-left">
        <!-- side bar here -->
       <?php include('admin_side_bar.php');?>
       <!-- side bar end -->
    </div>
    <div id="add_product" class="right">
        <form action="update_products.php" method="post" >
            <div class="form-group">
               
                <img src="../product/<?php echo $row['product_image']?>" alt="" style="width:150px; height:100;">
            </div>
            <div class="form-group">
                <label for="">product Name</label>
                <input type="text" name="product_name" disabled value="<?php echo $row['product_name']; ?>">
            </div>
            <div class="form-group">
                <label for="">Categoty</label>
                <input type="text" disabled value="<?php echo $row['name']; ?>">
            </div>
            
                               
            <div class="form-group">
                <label for="">Price</label>
                <input type="text" name="price" value="<?php echo $row['price']; ?>">
            </div>
            <div class="form-group">
                <label for="">Quantity</label>
                <input type="text" name="quantity" value="<?php echo $row['quantity']; ?>">
            </div>
            <input type="hidden" name="productid" value="<?php echo $row['product_id']?>">
            <div class="form-group">
                
                <input type="submit"  value="Update" name="update">
            </div>
            

        </form>
    </div>
  </div>
</div>

<?php include('footer.php');
?>