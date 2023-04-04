

<?php
session_start();
error_reporting(0);
include('menu-2.php');
include('header.php');
require('connect.php');
$p_cat=$_GET['cid'];
//-----session cart---//
if(isset($_POST['add_to_chart']))
{
  if(isset($_SESSION["shopping_cart"]))
  {
    $item_array_id=array_column($_SESSION["shopping_cart"], "item_id");
    if(!in_array($_GET["drug_id"], $item_array_id))
    {
      $count = count($_SESSION["shopping_cart"]);
      $item_array = array(
        'item_id' => $_GET["drug_id"],
      'item_name' =>  $_POST['hid_name'],
      'item_price' => $_POST['hid_price'],
      'item_num' => $_POST['quantity']
      );
      $_SESSION["shopping_cart"][$count]=$item_array;
      echo '<script> alert("Item successfully Added")</script>';
    echo '<script>window.location="cart.php"</script>';
    }
    else{
      echo '<script> alert("Item Already Added")</script>';
      echo '<script>window.location="cart.php"</script>';
    }

  }else{
    $item_array=array(
      'item_id' => $_GET["d_id"],
      'item_name' =>  $_POST["hid_name"],
      'item_price' => $_POST["hid_price"],
      'item_num' => $_POST["quantity"]
      
    );
    $_SESSION["shopping_cart"][0]=$item_array;
    echo '<script> alert("Item successfully Added")</script>';
    echo '<script>window.location="cart.php"</script>';
  }
}

//-----session cart---//





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
    background:#eee;
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
    background:#fff;
}
</style>


  <div id="main-content" >

    <div class="content-left">
        <h2>CATEGORIES</h2>
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

<div class="right" style="height:auto;">

           
        
        
<?php
if(isset($_POST['search'])){
    $search=$_POST['search-product'];
// var_dump($search);
// exit;
$sql="SELECT * FROM dogs JOIN category JOIN sub_category ON dogs.category=category.id AND dogs.gender=sub_category.id WHERE dogs.d_name LIKE '$search' ORDER BY  d_name ASC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$products= $stmt->fetchAll(PDO::FETCH_ASSOC);

}

if($products[0]>0){
            
            
         foreach($products as $product){
            // while($product =$sql->fetch()){

           
          ?>
          <form action="d-category.php?action=add&product_id=<?php echo $product['d_id'];?>" method="post">
          <div class="product-container">
              
                <h4><?php echo$product['d_name'] ." ". $product['description'];?></h4>
                <h4>Breed:<?php echo $product['name']."  <br/> Gender: ". $product['sub_cat'];?></h4>
                <img src="product/<?php echo $product['d_image'];?>" alt="" width="100%" height="150px">
                <h4>Amount: N<?php echo $product['price'];?></h4>
                <span>Quantity:</span><input type="text" name="quantity" value="1" style="width:50px"><br>
                <input type="hidden" name="hid_name"  value="<?php echo $product['d_name'];?>">
                <input type="hidden" name="hid_price"  value="<?php echo $product['price'];?>">
                <input type="submit" name="add_to_chart" value="Add to Cart">
                 </td>
             </div> 
           </form>
           
           
           <?php
           
          }
      
        }else{
            echo"<p style='text-align:center;color:red;margin:center; padding-top:20px;'>";echo"Dog is Not  Found, Please Check the Name !!";  echo"</p>";
            
            
            
        }
        

           ?>


  </div>
</div>

<?php include('footer.php');
?>