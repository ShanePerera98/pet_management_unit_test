
<?php
include('header.php');
require('../connect.php');

$sql="SELECT * FROM `orders` JOIN category JOIN patient_group ON drugs.category=category.id and drugs.patient_group=patient_group.id";
$stmt=$pdo->prepare($sql);
$stmt->execute();
$rows=$stmt->fetchAll(PDO::FETCH_ASSOC);

?>


  <div id="main-content" >

    <div class="content-left">
    <?php include('admin_side_bar.php');?>
        
    </div>
    <div id="add_drug" class="right">
        <table cellpadding="10px;" style="width:100%;">
            <tr style="background:#333; color:#fff;">
                <th >#</th>
                <th>Drug Image</th>
                <th>Drug Name</th>
                <th>Category</th>
                <th>P-Group</th>
                <th>Description</th>
                <th>Company</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Action</th>
                <!-- <th>Date Added</th> -->
            </tr>
            <?php
            $i=1;
            foreach($rows as $row){

            
            ?>
            <tr>
                <td><?php echo $i;?></td>
                <td><img src="../drugs/<?php echo $row['drug_image'];?>" alt="" style="width:150px; height:100px"></td>
                <td><?php echo $row['drug_name'];?></td>
                <td><?php echo $row['name'];?></td>
                <td><?php echo $row['p_group'];?></td>
                <td><?php echo $row['description'];?></td>
                <td><?php echo $row['company'];?></td>
                <td><?php echo $row['price'];?></td>
                <td><?php echo $row['quantity'];?></td>
                <td>
                    <a href="update_drugs.php?drugid=<?php echo $row['drug_id'];?>">Edit</a><br>
                    <a href="delete_drug.php?drugid=<?php echo $row['drug_id'];?>" onclick="return confirm('Are you want to delete this Drug?');">Delete</a>
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