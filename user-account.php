<?php
session_start();
error_reporting(0);
require_once('session.php');
require('connect.php');
include('menu-2.php');

include('header.php');
$userid=$_SESSION['id'];
$sql="SELECT * FROM users where id='$userid'";
$stmt=$pdo->prepare($sql);
$stmt->execute();
$rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
$row=$rows[0];

if(isset($_POST['update-info'])){
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$address=$_POST['address'];

$sql="UPDATE users SET firstname=:fname, lastname=:lname, email=:email, phone=:phone, address=:address WHERE id='$userid'";
$stmt=$pdo->prepare($sql);
$stmt->bindParam(":fname",$fname);
$stmt->bindParam(":lname",$lname);
$stmt->bindParam(":email",$email);
$stmt->bindParam(":phone",$phone);
$stmt->bindParam(":address",$address);

try{
    $stmt->execute();

    echo'<script>alert("Update Successfull");location.href="user-account.php";</script>';
}catch(Exception $e){
    echo $e->getMessage();
    echo '<script>alert("Update  failed");
    location.href="user-account.php";</script>';

    }
}

// change password//
if(isset($_POST['change-pass'])){
    $current=$_POST['current-pass'];
    $new=$_POST['new-pass'];
    $verify=$_POST['verify-pass'];
    $sql="SELECT password FROM users WHERE password=$current && id='$userid'";
    $stmt=$pdo->prepare($sql);
    $stmt->execute();
    $rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if($rows>0 && $new==$verify){
        $sql="UPDATE users SET password=:password WHERE id='$userid'";
        $stmt=$pdo->prepare($sql);
        $stmt->bindParam(":password",$new);
        
        try{
            $stmt->execute();
            echo'<script>alert("Password Changed Successfully");
            location.href="login_reg.php";</script>';
        }catch(Exception $e){
            echo $e->getMessage();
            echo'<script>alert("Password Not Chaged");</script>';
        }
    }else{
        echo'<script>alert("Failed Password not Changed");
        location.href="user-account.php";</script>';
        
    }



}
// change password//


?>
<style>
.my-profile-con{
    width:100%;
    display: grid;
  grid-template-columns:45% 45%;
  grid-gap: 3%;
  margin-top:10px;
  margin-bottom:10px;
}

.my-profile-con .form-group{
    width:100%;
}
.my-profile-con .form-group input{
    width:100%;
    height:30px;
    padding-top:5px;
    margin-top:5px;
    margin-bottom:5px;
}
</style>

  <div id="main-content" >

    <div class="content-left">
        <?php include('customer-sidebar.php');?>
        
    </div>
    <div class="my-profile-con">
            <div class="my-info">
                <fieldset>
                    <legend>
                        MY PROFILE
                    </legend>
                    <form action="user-account.php"  method="post">
                        <div class="form-group">
                            <label for="">First Name</label>
                            <input type="text" name="fname" value="<?php echo $row['firstname'];?>">
                        </div>
                        <div class="form-group">
                            <label for="">Last Name</label>
                            <input type="text" name="lname" value="<?php echo $row['lastname'];?>">
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" name="email" value="<?php echo $row['email'];?>">
                        </div>
                        <div class="form-group">
                            <label for="">Phone</label>
                            <input type="text" name="phone" value="<?php echo $row['phone'];?>">
                        </div>
                        <div class="form-group">
                            <label for="">Address</label>
                            <input type="text" name="address" value="<?php echo $row['address'];?>">
                        </div>
                        <div class="form-group">
                            
                            <button type="submit" name="update-info">Update</button>
                        </div>
                    </form>
                </fieldset>
            </div>
                <!-- Change password -->
                <div class="my-info">
                <fieldset>
                    <legend>
                        CHANGE PASSWORD
                    </legend>
                    <form action="user-account.php" method="post">
                        <div class="form-group">
                            
                            <input type="text" name="current-pass" placeholder="Current Password">
                        </div>
                        <div class="form-group">
                            
                            <input type="text" name="new-pass" placeholder="New Password">
                        </div>
                        <div class="form-group">
                            
                            <input type="text" name="verify-pass" placeholder="Verify Password">
                        </div>
                        <div class="form-group">
                            <button type="submit" name="change-pass">Change</button>
                        </div>
                    </form>
                </fieldset>
            </div>
                <!-- Change password end -->


        </div>
  </div>
</div>

<?php include('footer.php');
?>