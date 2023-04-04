<?php
error_reporting(0);
session_start();
include('header.php');
require('../connect.php');
require('../funtion.php');
$userid=$_SESSION['id'];
// $valid_file=true;
if(isset($_POST['add_dog'])){
    $pdo = prepareConnection();
    
    //$product_name = $_POST['product_name'];
    $d_image= date("YmdHis").strtolower($_FILES['d_image']['name']);
    $d_name= $_POST['d_name'];
    $d_category=$_POST['d_category'];
    $gender=$_POST['gender'];
    $age=$_POST['age'];
    $dob=$_POST['dob'];
    $price=$_POST['price'];
    $quantity='1';
    $petid=$_POST['petid'];
    $date = date('Y/m/d');
    $sql="SELECT `d_name`,`gender`,`age` FROM `dogs` ORDER BY `d_name`";
    $stmt=$pdo->prepare($sql);
    $stmt->execute();
    $pros=$stmt->fetchAll(PDO::FETCH_ASSOC);
    $pro=$pros[0];
    if($pro['d_name']==$d_name AND $pro['gender']==$gender AND $pro['age']==$age){
        echo'<script>alert("This Dog Already Exist ");location.href="add_dog.php";</script>';
    }else{
		
//INSERT INTO `dogs`(`d_id`, `d_name`, `category`, `gender`, `age`, `d_image`, `price`, `quantity`, `petid`, `user_id`, `date_added`)
		
    $sql ="INSERT INTO `dogs`(`d_name`, `category`, `gender`,`age`,`dob`, `d_image`, `price`, `quantity`,`petid`,`user_id`,`date_added`)
    VALUES(:d_name,:category,:gender,:age,:dob,:d_image,:price,:quantity,:petid,:userid,:date_added)";
    $stmt = $pdo->prepare($sql);

    $stmt ->bindParam(':d_image',$d_image);
    $stmt ->bindParam(':d_name',$d_name);
    $stmt ->bindParam(':category',$d_category);
    $stmt ->bindParam(':gender',$gender);
    $stmt ->bindParam(':age',$age);
    $stmt ->bindParam(':dob',$dob);
    $stmt ->bindParam(':price',$price);
    $stmt ->bindParam(':quantity',$quantity);
    $stmt ->bindParam(':petid',$petid);
    $stmt ->bindParam(':userid',$userid);
	    $stmt ->bindParam(':date_added',$date);
        try{
        move_uploaded_file($_FILES['d_image']['tmp_name'], '../product/'.$d_image);
        $stmt->execute();
       //@session_start();
		//$_SESSION['admissionNo'] = $admin;
          
		echo '<script>alert("Dog added successfully!!!");
		 location.href="add_dog.php";</script>';

		}catch(Exception $e){
		echo $e->getMessage();
		/*echo '<script>alert("Dog Not Added, Try again ");
		location.href="add_dog.php";</script>';
		*/
        }

    }

}


?>



  <div id="main-content" >

    <div class="content-left">
    <!-- Side bar here -->
    <?php include('b_side_bar.php');?>
    <!-- end of side bar -->
    </div>
    <div id="add_product" class="right">
        <form action="add_dog.php" method="post" enctype="multipart/form-data">
            
            <div class="form-group">
                <label for="">Dog_Name</label><br>
                <input type="text" name="d_name" style="width:400px">
            </div>
            <div class="form-group">
                <label for="">Category</label><br>
                <select name="d_category" id="" style="width:400px">
                   <?php echo $cat_list;?>
                </select>
            </div>
            <div class="form-group">
                <label for="">Gender</label><br>
                <select name="gender" style="width:400px">
                <?php echo $product_list;?>
                </select>
            </div>
           <div class="form-group">
               <label for="">Date of Birth</label><br>
                <input type="date" name="dob" id="dob" style="width:400px; height:30px;">
           </div>
           <div class="form-group">
               <label for="">Age</label><br>
                <input type="text" name="age" id="age" style="width:400px; height:30px;">
           </div>
            <div class="form-group">
                <label for="">Price</label><br>
                <input type="text" name="price" style="width:400px">
            </div>
            <div class="form-group">
                <label for="">Image</label>
                <input type="file" name="d_image" style="width:400px">
            </div>
			
			<div class="form-group">
                <label for="">Pet ID</label><br/>
                <input type="text" name="pet_id" style="width:400px">
            </div>
            <div class="form-group">
                
                <input type="submit"  value="Add Dog" name="add_dog" style="width:150px">
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
           var age = parseInt(moment().diff(dob,'years',true));
          $("#age").val(age);
      });
</script>
<?php include('footer.php');
?>