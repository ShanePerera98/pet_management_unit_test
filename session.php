<?php
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']==false){
    header('Location:login_reg.php');
}
else{
    if(trim($_SESSION['role_id']) !== '2'){
        header('Location:login_reg.php');
    }
}