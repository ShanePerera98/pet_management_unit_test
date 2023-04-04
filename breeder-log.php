<?php
session_start();
include('header.php');
//require('connect')
include('connect.php');

if(isset($_POST['login'])){

	$email = $_POST['email'];
	$password = $_POST['password'];

	$sql = "select * from users where email= :email";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(":email", $email);
	
		$stmt->execute();
		if($stmt->rowCount() > 0){ 
			$row = $stmt->fetch(PDO::FETCH_ASSOC);

            if(password_verify($password,$row['password'])){
			@session_start();
			$_SESSION['id'] = $row['id'];
		    $_SESSION['role_id'] = $row['role_id'];
			$_SESSION['name'] = $row['firstname']. " ".$row['lastname'];
		  	$_SESSION['loggedin'] = true;
             
			if($row['role_id'] == 3){ 
			
			header('location:breeders/breeders_home.php');
		}
			else{ 
				header('location:breeder-log.php');
			}
		}
		else{
			echo "<script>alert('Invalid Username/Password. Please Try Again or Contact the Admin'); location.href='breeder-log.php'; </script>";
		}
    }else{
		echo "<script>alert('Invalid Username/Password. Please Try Again or Contact the Admin'); location.href='breeder-log.php'; </script>";
	}
}
	
	if(isset($_POST['signup'])){
		if(strlen($_POST['password']) < 8){
			echo '<script>alert("Password cannot be less than eight");
			location.href="breeder-log.php";</script>';
			exit();
		}
    $pdo = prepareConnection();
$fname = $_POST['first_name'];
$lname = $_POST['last_name'];
$password = password_hash($_POST['password'],PASSWORD_DEFAULT);
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$role = '3';
$date = date('Y/m/d');

$sql = "select * from users where email = :email";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(":email", $email);
	
		$stmt->execute();
		if($stmt->rowCount() > 0){
	echo '<script>alert("User with this email exist");
	location.href="breeder-log.php";</script>';	
		}

$sql = "INSERT INTO users(`firstname`,`lastname`,`role_id`,`password`,`email`,`phone`,`address`,`date_joined`) VALUES(:firstname,:lastname,:role,:password,:email,:phone,:address,:date)";
$stmt = $pdo->prepare($sql);
$stmt ->bindParam(':firstname',$fname);
$stmt ->bindParam(':lastname',$lname);
$stmt ->bindParam(':role',$role);
$stmt ->bindParam(':password',$password);
$stmt ->bindParam(':email',$email);
$stmt ->bindParam(':phone',$phone);
$stmt ->bindParam(':address',$address);
$stmt ->bindParam(':date',$date);

try{
	   $stmt->execute();
       @session_start();
		$_SESSION['username'] = $username;
          
		echo '<script>alert("Account Registeration Successful");
		 location.href="breeder-log.php";</script>';

		}catch(Exception $e){
		echo $e->getMessage();
		// echo '<script>alert("Registration Failed Contact The Admin at dgw@dogworld.org");
		// location.href="breeder-log.php";</script>';
}
}





  ?>


<!--script-->

  <div  class="content-container">
    <div class="content-left">
    <div id="tabbed_box" class="tabbed_box">  
    <h4></h4> 
        <hr/>	
    <div class="tabbed_area">  
      
        <ul class="tabs">  
            <li><a href="javascript:tabSwitch('tab_1', 'content_1');" id="tab_1" class="active" style="width:100px;height:30px"> Breeders Login</a></li>  
            <li><a href="javascript:tabSwitch('tab_2', 'content_2');" id="tab_2" style="width:100px;height:30px">Breeders Signup</a></li>  
              
        </ul>  
    <div id="content_1" class="content">  
		<!-- Login form-->
		<form name="form1" onsubmit="return validateForm(this);" action="" method="post" >
			<table width="80%" height="160px" border="0" >	
				
				<tr><td ><input name="email" type="email" style="width:270px;height:37px;" placeholder="Email address" required="required" id="email" /></td><td rowspan="3"><img src="img/user.jpg" alt="" style="width:180px;height:170px;"></td></tr>
				<tr><td ><input name="password" type="password" style="width:270px;height:37px;" placeholder="Password" required="required" id="password"/></td></tr>
				<tr><td><input name="login" type="submit" value="Login" style="width:100px;height:30px;margin-top:8px;"/></td></tr>
            </table>
		</form>
        <!--end-->
        </div> 

        <div id="content_2" class="content"> 
          
		           <!--Pharmacist-->
				  
		<form name="form1" onsubmit="return validateForm(this);" action="" method="post" >
			<table width="80%" height="200px"cellpadding="5px" border="0" >	
				<tr><td >First Name: <br><input name="first_name" type="text" style="width:270px;height:37px;"   required="required" id="first_name" /></td><td rowspan="8"><img src="img/user.jpg" alt="" style="width:230px;height:400px;"></td></tr>
				<tr><td >Last Name: <br><input name="last_name" type="text" style="width:270px;height:37px;"  required="required" id="last_name" /></td></tr>
				<tr><td >Email: <br><input name="email" type="email" style="width:270px;height:37px;"  id="email" /></td></tr>
				<tr><td >Password: <br><input name="password" type="password" style="width:270px;height:37px;" required="required" id="password"/></td></tr>
           
				<tr><td>Phone : <br><input name="phone" type="text" maxlength="11" style="width:270px;height:37px; " pattern="[0-9]{11}" title="Please Enter a valied phone Number(11 digits!)"  required="required" id="phone" /></td></tr>  
				<tr><td >Address: <br><textarea name="address" style="width:270px;height:37px;"  required="required" id="address"></textarea></td></tr>  
				<tr><td ><input name="signup" type="submit" value="register" style="width:100px;height:30px;margin-top:8px;"/></td></tr>
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
