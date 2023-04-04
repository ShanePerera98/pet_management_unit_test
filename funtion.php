<?php 
$sql = "select * from category order by name asc";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$cat = $stmt->fetchAll(PDO::FETCH_ASSOC);
$cat_list='<option selected disabled>-[Select Category ]-</option>';
foreach($cat as $cats){
$cat_list .="<option value='".$cats['id']."'>".$cats['name']."</option>";
}




$sql = "select * from sub_category order by sub_cat asc";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$pc = $stmt->fetchAll(PDO::FETCH_ASSOC);
$product_list='<option selected disabled>-[Select Gender]-</option>';
foreach($pc as $pcs){
$product_list .="<option value='".$pcs['id']."'>".$pcs['sub_cat']."</option>";
}




?>