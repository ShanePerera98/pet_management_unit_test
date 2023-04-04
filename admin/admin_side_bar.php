<?php
  include('order-function.php');
  ?>
<style>
  
.dropbtn {
    background-color:#eec6c6dc;
    color: #000;
    padding: 10px;
    font-size: 20px;
    font-family:Cambria;
    /* border: none; */
    cursor: pointer;
    width:286px;
    border:1px solid #000;
    font-weight:bold;
}

.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: relative;
    background-color: #eec6c6dc;
    min-width: 240px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
}
.dropdown-content a {
    color: black;
    /* padding: 10px 10px; */
    text-decoration: none;
    display: block;
   min-width:270px;
}

.dropdown-content a:hover {
  background-color: #333;
  color:#000;
  

}

.dropdown:hover .dropdown-content {
    display: block;
    color:#333;
  
}
/* .dropdown:hover{
  background-color: #ccc;
    color:#000;
} */
.dropdown:hover .dropbtn {
    background-color: #333;
    color:#fff;
}

#order-status{
  display:inline-block;
  width:30px;
  height:25px;
  padding:2px;
  margin-top:5px;
  margin-left:10px;
  border-radius:10px;
  color:#fff;
  background:red;
  opacity:0.8;
}
</style>
<div class="admin_panel">
            <ul>
                <li><a href="category.php">Add Category</a></li>
                <li><a href="manage_dogs.php">Manage Dogs</a></li>
                <li><a href="../logout.php">Logout</a></li>
            </ul>
        </div>

        <!-- <div class="dropdown">
  <button class="dropbtn">Process Orders</button>
  <div class="dropdown-content">
  <a href="#">Today's Orders</a>
<a href="#">Pending Order</a>
<a href="#">Delivered Order</a>
  </div>
</div> -->


        