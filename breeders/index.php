<?php
error_reporting(0);
session_start();
include('header.php');
require('../connect.php');
?>
<!--script-->

<div class="slide-section" style="height:200px; border-bottom:2px solid black ">
    <div class="slide-text">We offer the Best Services!!</div>
  </div>
  <div  class="content-container">
    <div class="" style="height:500px;">
    
    <h4></h4> 
        
   
      
         
    <div id="content_1" class="content" style="height:400px;">  
		<!-- Login form-->
		<form name="form1" onsubmit="return validateForm(this);" action="login_exe.php" method="post" >
			<table width="30%" height="250px" border="0" style="margin:0 auto" >	
				
				<tr><td style="text-align:center" >ADMIN LOGIN FORM</td></tr>
				<tr><td ><input name="username" type="text" style="width:80%; height:40px" placeholder="Username" required="required" id="username" /></td></tr>
				<tr><td ><input name="password" type="password" style="width:80%;height:40px" placeholder="Password" required="required" id="password"/></td></tr>
				<tr><td ><input name="login" type="submit" value="Login" style="width:100px; height:35px"/></td></tr>
            </table>
		</form>
        <!--end-->
        </div> 

         
      
    
    </div>
    </div>

    
  </div>

<?php include('footer.php');
?>
