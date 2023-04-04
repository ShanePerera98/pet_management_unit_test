<?php
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
				 
				  if($row['role_id'] == 2){
					header('Location:customerhome.php');
				}
				else{ 
					header('Location:login_reg.php');
				}

			}
			else{
				echo "<script>alert('Invalid Username/Password. Please Try Again or Contact the Admin'); location.href='login_reg.php'; </script>";
			}
		}else{
			echo "<script>alert('Invalid Username/Password. Please Try Again or Contact the Admin'); location.href='login_reg.php'; </script>";
		}
	}
		



  ?>
