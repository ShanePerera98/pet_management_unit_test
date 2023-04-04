<?php
include('header.php');
require('../connect.php');
require('session.php');
if(isset($_POST['add_category'])){
$category=$_POST['category'];

$sql="SELECT * FROM category";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$cats= $stmt->fetchAll(PDO::FETCH_ASSOC);
$cat=$cats[0];
if($category==$cat['name']){
    echo'Category Already Exist!!';
}else{
$sql="INSERT INTO category(`name`) VALUES(:cate)";
$stmt=$pdo->prepare($sql);
$stmt->bindParam(":cate",$category);
try{
$stmt->execute();

echo'<script>alert("Category Have Been Added!");
location.href="category.php";
</script>';


}catch(Exception $e){
    echo $e->getMessage();
    echo '<script>alert("Category Not Added!! Try Again");
    location.href="category.php";</script>';
}
}
}

?>


  <div id="main-content" >

    <div class="content-left">
       <!-- side bar here -->
       <?php include('admin_side_bar.php');?>
       <!-- side bar end -->
    </div>
    <div id="add_product" class="right">
        <form action="category.php" method="post">
           
            <div class="form-group">
                <label for="">Category</label>
                <input type="text" name="category" placeholder="Enter Product Category">
            </div>
                       
            <div class="form-group">
                
                <input type="submit"  value="Add Category" name="add_category">
            </div>
            

        </form>

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