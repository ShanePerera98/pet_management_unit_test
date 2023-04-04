<?php
require('../connect.php');

$dogid=$_GET['dogid'];

$sql="DELETE FROM dogs WHERE d_id='$dogid'";
$stmt=$pdo->prepare($sql);
try{
    $stmt->execute();
    echo'<script>alert("Dog Deleted Successfull ...."); 
    location.href="manage_dogs.php";</script>';
    
    
     }catch(Exception $e){
     echo $e->getMessage();
     echo '<script>alert("Dog not Deleted");
     location.href="manage_dogs.php";</script>';

     }



?>