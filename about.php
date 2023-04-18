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