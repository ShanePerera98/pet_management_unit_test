<?php
session_start();
include('header.php');
//require('connect')
?>
<!--script-->
  <div  class="content-container">
    <div class="content-left">
    <div id="tabbed_box" class="tabbed_box">  
    <h4></h4> 
        <hr/>	
    <div class="tabbed_area">  
      
        <ul class="tabs">  
            <li><a href="javascript:tabSwitch('tab_1', 'content_1');" id="tab_1" class="active" style="width:100px;height:30px"> Client Login</a></li>  
            <li><a href="javascript:tabSwitch('tab_2', 'content_2');" id="tab_2" style="width:100px;height:30px">Client Signup</a></li>  
              
        </ul>  
    <div id="content_1" class="content">  
		<!-- Login form-->
		<form name="form1" onsubmit="return validateForm(this);" action="login_exe.php" method="post" >
			<table width="80%" height="160px" border="0" >	
				
				<tr><td ><input name="email" type="text" style="width:270px;height:37px;" placeholder="Email address" required="required" id="email" /></td><td rowspan="3"><img src="img/user.jpg" alt="" style="width:180px;height:170px;"></td></tr>
				<tr><td ><input name="password" type="password" style="width:270px;height:37px;" placeholder="Password" required="required" id="password"/></td></tr>
				<tr><td><input name="login" type="submit" value="Login" style="width:100px;height:30px;margin-top:8px;"/></td></tr>
            </table>
		</form>
        <!--end-->
        </div> 
        <div id="content_2" class="content"> 
         
		           <!--Pharmacist-->
		  
		<form name="form1" onsubmit="return validateForm(this);" action="reg_exe.php" method="post" >
			<table width="80%" height="200px"cellpadding="5px" border="0" >	
				<tr><td >First Name: <br><input name="first_name" type="text" style="width:270px;height:37px;"  required="required" id="first_name" /></td><td rowspan="8"><img src="img/user.jpg" alt="" style="width:230px;height:400px;"></td></tr>
				<tr><td >Last Name: <br><input name="last_name" type="text" style="width:270px;height:37px;"  required="required" id="last_name" /></td></tr>
			   
        <tr><td >Email: <br><input name="email" type="email" style="width:270px;height:37px;"  required="required" id="email" /></td></tr>   
				<tr><td >Password: <br><input name="password" type="password" style="width:270px;height:37px;"   required="required" id="password"/></td></tr>
				<tr><td>Phone : <br><input name="phone" type="text" maxlength="11" style="width:270px;height:37px;"  pattern="[0-9]{11}" title="Please Enter a valied phone Number(11 digits!)" required="required" id="phone" /></td></tr>  
				<tr><td >Address: <br><textarea name="address"  style="width:270px;height:37px;" placeholder="Address" required="required" id="address"></textarea></td></tr>  
				<tr><td ><input name="register" type="submit" value="register" style="width:100px;height:30px;margin-top:8px;"/></td></tr>
        </table>
		</form>
        </div>  
      </div>
      </div>
    </div>
    </div>

    
  </div>

<?php include('footer.php');
?>
