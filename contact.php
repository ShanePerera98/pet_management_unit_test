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

///
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

<div class="about" style="padding:20px;width:900px;">
            <h4>Our Contact Info</h4>
            <table cellpadding:5px;>
                <tr>
                    <td style="font-weight:bold;">Our Location:</td><td>No K/S6/7 st  raod, jega, lagos State</td>
                </tr>

                <tr>
                    <td style="font-weight:bold;">Email:</td><td> dw@gmail.com</td>
                </tr>
                <tr>
                    <td style="font-weight:bold;">Phone:</td><td>+234812211234567</td>
                </tr>

            </table>

        </div>
        
  </div>
</div>

<?php include('footer.php');
?>