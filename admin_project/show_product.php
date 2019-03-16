<?php 
require("connection.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<HTML>
<head>

<META NAME="Generator" CONTENT="EditPlus">
<META NAME="Author" CONTENT="">
<META NAME="Keywords" CONTENT="">
<META NAME="Description" CONTENT="">
<META charset="UTF-8">

</head>
<body>

<TABLE border=1>
<TR>
	<TD>ประเภทสินค้า</TD>
	<TD>รหัสสินค้า</TD>
	<TD>ชื่อสินค้า</TD>
	<TD>รายละเอียด</TD>
	<TD>ราคา</TD>
	<TD>ราคาโปรโมชั่น</TD>
	<TD>รหัส sku</TD>
	<TD>สี</TD>
	<TD>ไซส์</TD>
	<TD>จำนวนสินค้า</TD>
	<TD>แก้ไข</TD>
</TR>

<?php
//show all product
$type_array = pg_query($db,"SELECT prod_type FROM product GROUP BY prod_type");
while($type = pg_fetch_row($type_array))
{
	$prod_array = pg_query($db,"SELECT * FROM product");
	while($prod = pg_fetch_row($prod_array))
	{
		$sku_array = pg_query($db,"SELECT * FROM stock WHERE prod_id = '$prod[0]'");
		while($sku = pg_fetch_row($sku_array))
		{
			$prod_type = $prod[3];
			$prod_id = $prod[0];
			$prod_name = $prod[1];
			$prod_des = $prod[4];
			$prod_price = $prod[5];
			$prod_pro_price = $prod[6];
			$sku_id = $sku[0];
			$sku_color = $sku[3];
			$sku_size = $sku[4];
			$sku_qtt = $sku[2];
			
			echo "<TR>
			<TD>$prod_type</TD>
			<TD>$prod_id</TD>
			<TD>$prod_name</TD>
			<TD>$prod_des</TD>
			<TD>$prod_price</TD>
			<TD>$prod_pro_price</TD>
			<TD>$sku_id</TD>
			<TD>$sku_color</TD>
			<TD>$sku_size</TD>
			<TD>$sku_qtt</TD>
			<TD><A HREF='show_product_handler.php?id=$sku_id'>แก้ไข</A></TD>
			</TR>";
		}
	}
}
?>

<?php
/*
//edit

if($_GET['id']!="")
{
	$action = 'edit';
	$sku_id = $_GET['id'];

	$sku = pg_fetch_row(pg_query($db,"SELECT * FROM stock WHERE sku_id = '$sku_id'"));
	$prod = pg_fetch_row(pg_query($db,"SELECT * FROM product WHERE prod_id = '$sku[1]'"));
	
	$prod_type = $prod[3];
	$prod_id = $prod[0];
	$prod_name = $prod[1];
	$prod_des = $prod[4];
	$sku_id = $sku[0];
	$sku_color = $sku[3];
	$prod_price = $prod[5];
	$prod_pro_price = $prod[6];
	$sku_qtt = $sku[2];
	
}

?>

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
	$sku_size = $_POST["sku_size"]
	$sku_qtt = $_POST["sku_qtt"];
	
	pg_query($db,"UPDATE product SET prod_type = '$prod_type', prod_id = '$prod_id', prod_name = '$prod_name', prod_description = '$prod_des, prod_price = '$prod_price', prod_pro_price = '$prod_pro_price' WHERE prod_id = '$prod_id'");

}
*/
?>




</body>
<HTML>