<?php
// session_start();
// top menu ///
error_reporting(0);
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
        'item_id' => $_GET["product_id"],
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
      'item_id' => $_GET["product_id"],
      'item_name' =>  $_POST["hid_name"],
      'item_price' => $_POST["hid_price"],
      'item_num' => $_POST["quantity"]
      
    );
    $_SESSION["shopping_cart"][0]=$item_array;
  }
}

//-----session cart---//


$sql="SELECT * FROM products JOIN category JOIN sub_category ON products.category=category.id AND products.sub_category=sub_category.id ORDER BY  product_name ASC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$products= $stmt->fetchAll(PDO::FETCH_ASSOC);



// $sql=$pdo->prepare("SELECT * FROM products ORDER BY product_name ASC");

// //$sql->getFetchMode(PDO:: FETCH_ASSOC);
// $sql->fetchAll(PDO:: FETCH_ASSOC);
// $sql->execute();
// $stmt = $pdo->prepare($sql);
// $stmt->execute();
// $cat = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
    background:#ccc;
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

    <!-- <div class="content-left">
       
    </div> -->

<div class="right" style="height:auto;width:100%;">
<div class="about" style="padding:50px; width:900px;">
            <h4>About Us</h4>
            <p style="width:80%;">
               Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic animi commodi necessitatibus at. Fuga iure minima dolor alias, debitis quis, natus ex quibusdam molestias illo omnis inventore voluptatibus. Cumque vero totam fugit unde quasi non! Quae, vero tempora exercitationem, cumque voluptate placeat corporis perspiciatis provident, autem velit tenetur cum impedit!
            </p>

        </div>
  </div>
</div>

<?php include('footer.php');
?>