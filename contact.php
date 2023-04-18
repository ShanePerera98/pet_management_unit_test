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

<div class="about" style="padding:20px;width:900px;">
            <h4>Our Contact Info</h4>
            <table cellpadding:5px;>
                <tr>
                    <td style="font-weight:bold;">Our Location:</td><td>No 6 alakija lagos</td>
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