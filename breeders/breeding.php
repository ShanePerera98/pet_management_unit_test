<?php
error_reporting(0);
session_start();
include('header.php');
require('../connect.php');
require('../funtion.php');
$userid=$_SESSION['id'];

if(isset($_POST['add_dog'])){
    $pdo = prepareConnection();
     $d_image= date("YmdHis").strtolower($_FILES['d_image']['name']);
    $d_name= $_POST['d_name'];
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
    $sql="SELECT `name`,`gender`,`user_id` FROM `dogs` ORDER BY `name`";
    $stmt=$pdo->prepare($sql);
    $stmt->execute();
    $pros=$stmt->fetchAll(PDO::FETCH_ASSOC);
    $pro=$pros[0];
    if($pro['name']==$d_name AND $pro['gender']==$gender AND $pro['user_id']==$userid){
        echo'<script>alert("This Dog Already Exist ");location.href="add_dog.php";</script>';
    }else{
		
		
    $sql ="INSERT INTO `dogs`(`name`, `category`, `gender`,`age`,`dob`, `image`, `price`, `quantity`,`petid`,`user_id`,`healthy`,`medication`,`date_added`)
    VALUES(:d_name,:category,:gender,:age,:dob,:d_image,:price,:quantity,:petid,:userid,:healthy,:medication,:date_added)";
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
    $stmt ->bindParam(':healthy',$healthy);
    $stmt ->bindParam(':medication',$medication);
	    $stmt ->bindParam(':date_added',$date);
        try{
        move_uploaded_file($_FILES['d_image']['tmp_name'], '../dogs/'.$d_image);
        $stmt->execute();
          
		echo '<script>alert("Dog added successfully!!!");
		 location.href="add_dog.php";</script>';

		}catch(Exception $e){
		echo $e->getMessage();
		// echo '<script>alert("Dog Not Added, Try again ");
		// location.href="add_dog.php";</script>';
		
        }

    }

}


?>

<style>
.product-container{
    width:250px;
     height:auto;
      float:left;
      margin-bottom:20px;
    margin-right:10px;
    margin-top:10px;
    padding-bottom:20px;
    border:1 solid #000;
    /* border-radius:20px; */
    background:#fff;
    text-align:center;

}
.product-container input[type=submit]{
    margin-top:3px;
    font-weight:bold;
    color:red;
    width:150px;
    height:30px;

}
.product-container input[type=submit]:hover{
    color:#000;
    background:#ccc;
}
</style>

  <div id="main-content" >

    <div class="content-left">
    <!-- Side bar here -->
    <?php include('b_side_bar.php');?>
    <!-- end of side bar -->
    </div>
    <div class="right" style="height:auto;">
    <table border="1px">
        <form>
        <tr>
            <td>
            <div class="product-container">
               
               
               <h4 style="align:left">Dog Name:</h4>
               <h4>Breed:Dog A <br/> Gender: female"</h4>
               <img src="../dogs/2023031710413548.jpg" alt="" width="100%" height="150px">
               <input type="hidden" name="dog_id" value="">
               
            </div> 
            </td>
           <td>
            <center><img src="../img/cross2.jpg" width="50%"><br><button type="submit">Cross Bread</button></center>
           </td>
            <td>
            <div class="product-container">
               
               
               <h4 style="align:left">Dog Name:</h4>
               <h4>Breed:Dog B <br/> Gender: male"</h4>
               <img src="../dogs/2023031710413548.jpg" alt="" width="100%" height="150px">
               <input type="hidden" name="dog_id" value="">
               
            </div> 
            </td>
        </tr>
        </form>
    </table>
   
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