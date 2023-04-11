<?php
error_reporting(0);
session_start();
include('header.php');
require('../connect.php');
$dogid=$_GET['dogid'];
$sql="SELECT * FROM `dogs` WHERE id='$dogid'";
$stmt=$pdo->prepare($sql);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$categories_sql="SELECT * FROM `category`";
$stmt2=$pdo->prepare($categories_sql);
$stmt2->execute();
$categories = $stmt2->fetchAll(PDO::FETCH_ASSOC);


$genders_sql="SELECT * FROM `sub_category`";
$stmt3=$pdo->prepare($genders_sql);
$stmt3->execute();
$genders = $stmt3->fetchAll(PDO::FETCH_ASSOC);

if(isset($_POST['update'])){
    $pdo = prepareConnection();
    if(empty($_FILES['d_image']['name'])){
        $d_image=$_POST['prev_image']; 
    }
    else{
        $d_image= date("YmdHis").strtolower($_FILES['d_image']['name']);
  
    }
      $d_name= $_POST['d_name'];
      $id= $_POST['id'];
    $d_category=$_POST['d_category'];
    $gender=$_POST['gender'];
    $age=$_POST['age'];
    $dob=$_POST['dob'];
    $price=$_POST['price'];
    $quantity='1';
    $petid=$_POST['pet_id'];
    $healthy=$_POST['healthy'];
    $medication=$_POST['medication'];
    $date = date('Y/m/d');
    $sql="SELECT `id`,`name`,`gender`,`user_id` FROM `dogs` WHERE `name`='$d_image' AND `id`!='$id'";
    $stmt=$pdo->prepare($sql);
    $stmt->execute();
    $pro=$stmt->fetch(PDO::FETCH_ASSOC);
    if($pro['name']==$d_name AND $pro['gender']==$gender AND $pro['user_id']==$userid){
        echo '<script>alert("This Dog Already Exist ");location.href="update_dog.php?id='.$id.';</script>';
    }else{
    $sql ="UPDATE `dogs` SET `name`=:d_name, `category`=:category, `gender`=:gender,`age`=:age,`dob`=:dob, `image`=:d_image, `price`=:price,`petid`=:petid,`healthy`=:healthy,`medication`=:medication WHERE `id`=:id";
    $stmt = $pdo->prepare($sql);

    $stmt ->bindParam(':d_image',$d_image);
    $stmt ->bindParam(':d_name',$d_name);
    $stmt ->bindParam(':category',$d_category);
    $stmt ->bindParam(':gender',$gender);
    $stmt ->bindParam(':age',$age);
    $stmt ->bindParam(':dob',$dob);
    $stmt ->bindParam(':price',$price);
    $stmt ->bindParam(':petid',$petid);
    $stmt ->bindParam(':healthy',$healthy);
    $stmt ->bindParam(':medication',$medication);
    $stmt ->bindParam(':id',$id);
        try{
            if(!empty($_FILES['d_image']['name'])){
        move_uploaded_file($_FILES['d_image']['tmp_name'], '../dogs/'.$d_image);
            }
        $stmt->execute();
          
		echo '<script>alert("Dog updated successfully!!!");
		 location.href="manage_dogs.php";</script>';

		}catch(Exception $e){
		//echo $e->getMessage();
		echo '<script>alert("Dog fail to be updated, Try again ");
		location.href="manage_dogs.php";</script>';
		
        }

    }

}



?>



  <div id="main-content" >

    <div class="content-left">
        <!-- side bar here -->
       <?php include('b_side_bar.php');?>
       <!-- side bar end -->
    </div>
    <div id="add_product" class="right">
    <form action="update_dog.php?id=<?=$row['id'];?>" method="post" enctype="multipart/form-data">
            
            <div class="form-group">
                <label for="">Dog_Name</label><br>
                <input type="text" name="d_name" style="width:400px" value="<?=$row['name'];?>">
            </div>
            <div class="form-group">
                <label for="">Category</label><br>
                <select name="d_category" id="" style="width:400px">
                   <?php
                   foreach($categories as $category){ ?>
                    <option value="<?=$category['id']?>" <?=($category['id']==$row['category'])? "selected" : ""?>><?=$category['name']?></option>
                   <?php }
                   ?>
                </select>
            </div>
            <div class="form-group">
                <label for="">Gender</label><br>
                <select name="gender" style="width:400px">
                <?php
                   foreach($genders as $gender){ ?>
                    <option value="<?=$gender['id']?>" <?=($gender['id']==$row['gender'])? "selected" : ""?>><?=$gender['sub_cat']?></option>
                   <?php }
                   ?>
                </select>
               
            </div>
           <div class="form-group">
               <label for="">Date of Birth</label><br>
                <input type="date" name="dob" id="dob" style="width:400px; height:30px;" value="<?=$row['dob'];?>">
           </div>
           <div class="form-group">
               <label for="">Age</label><br>
                <input type="text" name="age" id="age" style="width:400px; height:30px;" value="<?=$row['age'];?>">
           </div>
            <div class="form-group">
                <label for="">Price</label><br>
                <input type="text" name="price" style="width:400px" value="<?=$row['price'];?>">
            </div>
            <div class="form-group">
                <label for="">Image</label>
                <input type="file" name="d_image" style="width:400px">
            </div>
			
			<div class="form-group">
                <label for="">Healthy Suppliment</label><br/>
                <textarea  name="healthy" style="width:400px"><?=$row['healthy'];?></textarea>
            </div>

            <div class="form-group">
                <label for="">Medication</label><br/>
                <textarea  name="medication" style="width:400px"><?=$row['medication'];?></textarea>
            </div>

            <div class="form-group">
                <label for="">Pet ID</label><br/>
                <input type="text" name="pet_id" style="width:400px" value="<?=$row['petid'];?>">
            </div>

            <div class="form-group">
                 <input type="hidden" name="id" value="<?=$_GET['dogid'];?>">
                 <input type="hidden" name="prev_image" value="<?=$row['image'];?>">
                <input type="submit"  value="update" name="update" style="width:150px">
            </div>
            

        </form>
    </div>
  </div>
</div>
<script src="../js/moment/moment.js"></script>
<script src="../js/jquery-3.3.1.min.js"></script>
<script>
     $("#dob").on('change',function(){
          let dob=$("#dob").val();
             if(parseInt(moment().diff(dob,'months',true)) >= 12){
                
                if(parseInt(moment().diff(dob,'months',true)) % 12 ==0){
                    var age=parseInt(moment().diff(dob,'years',true)) + " years";
                }
                else if(parseInt(moment().diff(dob,'months',true)) % 12 ==1){
                    var age=parseInt(moment().diff(dob,'years',true)) + " years " + parseInt(moment().diff(dob,'months',true)) % 12 + " month";
                }
                 else{
                    var age=parseInt(moment().diff(dob,'years',true)) + " years " + parseInt(moment().diff(dob,'months',true)) % 12 + " months";
             
                 }
             }
            else{
               if(parseInt(moment().diff(dob,'months',true)) == 1 || parseInt(moment().diff(dob,'months',true)) == 0){
                var age=parseInt(moment().diff(dob,'months',true)) + " month";
               } 
               else{
                var age=parseInt(moment().diff(dob,'months',true)) + " months";
               }
              }
           $("#age").val(age);
      });
</script>
<?php include('footer.php');
?>