<?php
require('connect.php');
if(isset($_POST['register'])){
	
    $pdo = prepareConnection();
    if(strlen($_POST['password']) < 8){
		echo '<script>alert("Password cannot be less than eight");
		location.href="login_reg.php";</script>';
		exit();
	}
$fname = $_POST['first_name'];
$lname = $_POST['last_name'];
$password = password_hash($_POST['password'],PASSWORD_DEFAULT);
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$role = '2';
$date = date('Y/m/d');

$sql = "select * from users where email = :email";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(":email", $email);
	
		$stmt->execute();
		if($stmt->rowCount() > 0){
	echo '<script>alert("User with this email exist");
	location.href="login_reg.php";</script>';	
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
        echo '<script>alert("Account Registeration Success full");
		 location.href="login_reg.php";</script>';

		}catch(Exception $e){
		echo $e->getMessage();
	echo '<script>alert("Account Registeration fail");
		 location.href="login_reg.php";</script>';
}
}


?>