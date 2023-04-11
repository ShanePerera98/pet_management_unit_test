<?php
include('header.php');
require('../connect.php');
//session_start();
$userid=$_SESSION['id'];

$sql="SELECT dogs.id as dogid,dogs.name as dogname,dogs.age,dogs.gender,dogs.image,dogs.price,dogs.category,dogs.petid,category.name as catname FROM `dogs` JOIN category ON dogs.category=category.id  where dogs.user_id='$userid' order by dogs.id desc";
$stmt=$pdo->prepare($sql);
$stmt->execute();
$rows=$stmt->fetchAll(PDO::FETCH_ASSOC);

?>


  <div id="main-content" >

    <div class="content-left">
    <?php include('b_side_bar.php');?>
       
    </div>
    <div id="add_drug" class="right">
        <table cellpadding="10px;" style="width:100%;">
            <tr style="background:#333; color:#fff;">
                <th >#</th>
                <th>Dog Image</th>
                <th>Dog Name</th>
                <th>Category</th>
                <th>Gender</th>
                <th>Age</th>
                <th>Price</th>
                <th>Pet Id</th>
                <th>Action</th>
                <!-- <th>Date Added</th> -->
            </tr>
            <?php
            $i=1;
            foreach($rows as $row){

            
            ?>
            <tr>
                <td><?php echo $i;?></td>
                <td><img src="../dogs/<?php echo $row['image'];?>" alt="" style="width:150px; height:100px"></td>
                <td><?php echo $row['dogname'];?></td>
                <td><?php echo $row['catname'];?></td>
                <td><?=($row['gender']=="1") ? "Male" : "Female";?></td>
                <td><?php echo $row['age'];?></td>
                <td><?php echo "N".number_format($row['price'],2);?></td>
                <td><?php echo $row['petid'];?></td>
                <td>
                    <a href="update_dog.php?dogid=<?php echo $row['dogid'];?>">Edit</a><br>
                    <a href="delete_dog.php?dogid=<?php echo $row['dogid'];?>" onclick="return confirm('Are you want to delete this dog?');">Delete</a>
                </td>
                
            </tr>
            <?php
            $i++;
            }
            ?>
        </table>

    </div>
  </div>
</div>

<?php include('footer.php');
?>

<script>
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