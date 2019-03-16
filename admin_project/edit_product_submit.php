
<h2>edit success</h2>
<table>
<?php

//edit submit

if($_POST['action']=='edit_submit')
{
	$prod_type = $_POST["prod_type"];
	$prod_id = $_POST["prod_id"];
	$prod_name = $_POST["prod_name"];
	$prod_des = $_POST["prod_description"];
	$prod_price = $_POST["prod_price"];
	$prod_pro_price = $_POST["prod_pro_price"];
	$sku_id = $_POST["sku_id"];
	$sku_color = $_POST["sku_color"];
	$sku_size = $_POST["sku_size"];
	$sku_qtt = $_POST["sku_qtt"];
	
	//pg_query($db,"UPDATE product SET prod_type = '$prod_type', prod_id = '$prod_id', prod_name = '$prod_name', prod_description = '$prod_des, prod_price = '$prod_price', prod_pro_price = '$prod_pro_price' WHERE prod_id = '$prod_id'");

}


echo "<tr><td>ประเภทสินค้า</td><td>$prod_type</td></tr>
	<tr><td>รหัสสินค้า</td><td>$prod_id</td></tr>
	<tr><td>ชื่อสินค้า</td><td>$prod_name</td></tr>
	<tr><td>รายละเอียดสินค้า</td><td>$prod_des</td></tr>
	<tr><td>ราคาสินค้า</td><td>$prod_price</td></tr>
	<tr><td>ราคาโปรโมชั่น</td><td>$prod_pro_price</td></tr>
	<tr><td>รหัส sku</td><td>$sku_id</td></tr>
	<tr><td>สี</td><td>$sku_color</td></tr>
	<tr><td>ไซส์</td><td>$sku_size</td></tr>
	<tr><td>จำนวน</td><td>$sku_qtt</td></tr>";





?>
</table>