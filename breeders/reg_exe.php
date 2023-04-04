<?php
echo'<script>
function validateForm()
{
//for alphabet characters only
var str=document.form1.first_name.value;
	var valid="abcdefghijklmnopqrstuvwxyz ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	//comparing user input with the characters one by one
	for(i=0;i<str.length;i++)
	{
	//charAt(i) returns the position of character at specific index(i)
	//indexOf returns the position of the first occurence of a specified value in a string. this method returns -1 if the value to search for never ocurs
	if(valid.indexOf(str.charAt(i))==-1)
	{
	alert("First Name Cannot Contain Numerical Values");
	document.form1.first_name.value="";
	document.form1.first_name.focus();
	return false;
	}}
	
if(document.form1.first_name.value=="")
{
alert("Name Field is Empty");
return false;
}

//for alphabet characters only
var str=document.form1.last_name.value;
	var valid="abcdefghijklmnopqrstuvwxyz ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	//comparing user input with the characters one by one
	for(i=0;i<str.length;i++)
	{
	//charAt(i) returns the position of character at specific index(i)
	//indexOf returns the position of the first occurence of a specified value in a string. this method returns -1 if the value to search for never ocurs
	if(valid.indexOf(str.charAt(i))==-1)
	{
	alert("Last Name Cannot Contain Numerical Values");
	document.form1.last_name.value="";
	document.form1.last_name.focus();
	return false;
	}}
	

if(document.form1.last_name.value=="")
{
alert("Name Field is Empty");
return false;
}

}

</script>
<!--script-->';
require('connect.php');


if(isset($_POST['submit'])){
    $pdo = prepareConnection();
    
$fname = $_POST['first_name'];
$lname = $_POST['last_name'];
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$date = date('Y/m/d');

/*/$state = $_REQUEST["state"];
//if (!preg_match("/[A-Z]{2}/", $fname)) {
//?>
<h2>Error, invalid state submitted.</h2>
<?php
}*/

$sql = "INSERT INTO users(firstname,lastname,username,password,email,phone,address,date_joined) VALUES(:firstname,:lastname,:username,:password,:email,:phone,:address,:date)";
$stmt = $pdo->prepare($sql);
$stmt ->bindParam(':firstname',$fname);
$stmt ->bindParam(':lastname',$lname);
$stmt ->bindParam(':username',$username);
$stmt ->bindParam(':password',$password);
$stmt ->bindParam(':email',$email);
$stmt ->bindParam(':phone',$phone);
$stmt ->bindParam(':address',$address);
$stmt ->bindParam(':date',$date);

try{
	   $stmt->execute();
       @session_start();
		$_SESSION['username'] = $username;
          
		echo '<script>alert("Account Registeration Success full");
		 location.href="index.php";</script>';

		}catch(Exception $e){
		echo $e->getMessage();
		echo '<script>alert("Registration Failed Contact The Admin at ksusta@ksusta.edu.ng");
		location.href="index.php";</script>';
}
}


?>