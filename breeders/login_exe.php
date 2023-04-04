<?php
include('../connect.php');
	$username = $_POST['username'];
	$password = $_POST['password'];


	// var_dump($username);
	// var_dump($password);
	// exit();

	$sql = "select * from users where username = :username and password = :password";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(":username", $username);
	$stmt->bindParam(":password", $password);
	
		$stmt->execute();
		if($stmt->rowCount() == 1){
			$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
      	// $row = $rows[0];
    //   var_dump($row);
    //   exit();
			@session_start();
			$_SESSION['id'] = $rows[0]['id'];
      		$_SESSION['roleid'] = $rows[0]['roleid'];

			$_SESSION['username'] = $rows[0]['username'];
			// $_SESSION['password'] = md5($rows[0]['password']);
			$_SESSION['password'] = $rows[0]['password'];
			
      		$_SESSION['loggedin'] = true;

			if($rows[0]['role_id'] == 1){ // if admin
				header('location:admin.php');
			}else{ // if bidder
				// header('location:index.php');
				echo'<script>alert("Login Failed. Contact The Admin at admin@hamdala.com"); location.href="index.php"; </script>';
			}
    }else{
		echo'<script>alert("login fail");location.href="index.php";</script>';
	}
			

  ?>
