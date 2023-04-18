<?php
// session_start();
// top menu ///
//error_reporting(0);
session_start();

include('menu-2.php');
// top menu end//
include('header.php');
require('connect.php');
//-----session cart---//
if(isset($_POST['add_to_chart']))
{
  if(isset($_SESSION["shopping_cart"]))
  {
    $item_array_id=array_column($_SESSION["shopping_cart"], "item_id");
    if(!in_array($_GET["product_id"], $item_array_id))
    {
      $count = count($_SESSION["shopping_cart"]);
      $item_array = array(
        'item_id' => $_POST["dog_id"],
      'item_name' =>  $_POST['hid_name'],
      'item_price' => $_POST['hid_price'],
      'item_num' => $_POST['quantity']
      );
      $_SESSION["shopping_cart"][$count]=$item_array;
    }
    else{
      echo '<script> alert("Item Already Added")</script>';
      echo '<script>window.location="index.php"</script>';
    }

  }else{
    $item_array=array(
      'item_id' => $_POST["dog_id"],
      'item_name' =>  $_POST["hid_name"],
      'item_price' => $_POST["hid_price"],
      'item_num' => $_POST["quantity"]
      
    );
    $_SESSION["shopping_cart"][0]=$item_array;
  }
}

//-----session cart---//


$sql="SELECT dogs.id AS dog_id,dogs.name AS dog_name,dogs.image AS dog_image,dogs.price AS price,dogs.age,
category.name AS category_name, 
sub_category.sub_cat AS sub_cat,dogs.category,dogs.gender,category.id,sub_category.id
 FROM `dogs` INNER JOIN `category` ON dogs.category=category.id INNER JOIN `sub_category` ON dogs.gender=sub_category.id ORDER BY dog_name ASC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$dogs= $stmt->fetchAll(PDO::FETCH_ASSOC);

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
    background:#fff;
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
</style>


  <div id="main-content" >

    <div class="content-left">
        <h3 style="text-align:center">DOG CATEGORIES</h3>
		<hr>
        <div class="admin_panel">
            <ul>
                <li>
                <?php 
                
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
          foreach($dogs as $dog){
            // while($product =$sql->fetch()){

           
          ?>
         <form action="d-category.php?action=add" method="post">
          <div class="product-container">
               
                <h4 style="align:left">Dog Name:<?php echo  $dog['dog_name'] ;?></h4>
                <h4>Breed:<?php echo $dog['category_name']." <br/> Gender: ". $dog['sub_cat'];?></h4>
                <img src="dogs/<?php echo $dog['dog_image'];?>" alt="" width="100%" height="150px">
                <h4>Age: <?=$dog['age'];?></h4>
                <h4>Amount:  N<?php echo number_format($dog['price'],2);?></h4>
                <br>
                <input type="hidden" name="hid_name"  value="<?php echo $dog['dog_name'];?>">
                <input type="hidden" name="hid_price"  value="<?php echo $dog['price'];?>">
                <input type="hidden" name="quantity"  value="1">
                <input type="hidden" name="dog_id" value="<?php echo $dog['dog_id'];?>">
                <input type="submit" name="add_to_chart" value="Add to Cart">
                 </td>
             </div> 
           </form>
           
           
           <?php
           
          }
           ?>
  </div>
</div>

<?php include('footer.php');
?>