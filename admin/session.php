<?php
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']==false){
    header('Location:index.php');
}
else{
    if(trim($_SESSION['role_id']) !== '1'){
        header('Location:index.php');
    }
}