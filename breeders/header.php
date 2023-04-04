<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>DOGS WORLD</title>
  <link rel="stylesheet" href="../css/style.css">
  <script src="../js/function.js" type="text/javascript"></script>
  
</head>
<body>
<div class="container">
  <div class="header" style="border-bottom:2px solid black; ">
    
  </div>
  <div class="nav">
       <?php
    // error_reporting(0);
    session_start();
    if($_SESSION['loggedin']==true){
     
     echo' <ul>
   
      <li><a href="breeders_home.php">Home</a></li>
      <li><a href="services.php">Service</a></li>
      <li><a href="about.php">About</a></li>
      <li><a href="contact.php">Contact Us</a></li>
      <li><a href="../logout.php">Logout</a></li>
        
      
    </ul>';
    }else{
      echo'<ul>
   
      <li><a href="index.php">Home</a></li>
      <li><a href="services.php">Service</a></li>
      <li><a href="about.php">About</a></li>
      <li><a href="contact.php">Contact Us</a></li>
      <li><a href="index.php">Login</a></li>
        
      
    </ul>';
    }
    ?>
  </div>
  