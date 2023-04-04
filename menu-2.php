<style>
   .menu-container{
        width:100%;
        height:30px;
        text-align:right;
        /* opacity:0.8; */
        margin-bottom:25px;
    }
    .menu-container ul{
        margin:0;
        padding:0;
        float:right;

    }
    .menu-container li{
        
        list-style-type:none;
        display:inline-block;
    }
    .menu-container a{
        display:block;
        color:#333;
        background:#ccc;
        padding:10px;
        font-weight:bold;
        text-decoration:none;
        
        height:100%;
        margin-right:5px;
    }
    .menu-container a:hover{
        color:#fff;

    }
</style>

<?php
	if($_SESSION==false){
		echo'<div class="menu-container">
    <ul>
        <li><a href="user-account.php">My Account</a></li>
        <li><a href="cart.php">My Cart</a></li>
        <li><a href="order-history.php">Order History</a></li>
        <li><a href="login_reg.php">Login/Register</a></li>
        
    </ul>
</div>';
	}else{
		echo'
		<div class="menu-container">
    <ul>
        <li><a href="user-account.php">My Account</a></li>
        <li><a href="cart.php">My Cart</a></li>
        <li><a href="order-history.php">Order History</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</div>
		';
	}
	
?>