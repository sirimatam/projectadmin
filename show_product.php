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
	<TD>รหัส sku</TD>
	<TD>สี</TD>
	<TD>ราคา</TD>
	<TD>ราคาโปรโมชั่น</TD>
	<TD>จำนวนสินค้า</TD>
	<TD>แก้ไข</TD>
</TR>

<?php
//show all product
$type_array = pg_query($db,"SELECT prod_type FROM product GROUP BY prod_type");
while($type = pg_fetch_row($type_array))
{
	$prod_array = pg_query($db,"SELECT * FROM product");
	while($prod = pg_query($prod_array))
	{
		$sku_array = pg_query($db,"SELECT * FROM stock WHERE prod_id = $prod");
		while($sku = pg_fetch_row($sku_array))
		{
			$prod_type = $prod("prod_type");
			$prod_id = $prod("prod_id");
			$prod_name = $prod("prod_name");
			$prod_des = $prod("prod_description");
			$sku_id = $sku("sku_id");
			$sku_color = $sku("sku_color");
			$prod_price = $prod("prod_price");
			$prod_pro_price = $prod("prod_pro_price");
			$sku_qtt = $sku("sku_qtt");
			
			echo "<TR>
			<TD>$prod_type</TD>
			<TD>$prod_id</TD>
			<TD>$prod_name</TD>
			<TD>$prod_des</TD>
			<TD>$sku_id</TD>
			<TD>$sku_color</TD>
			<TD>$prod_price</TD>
			<TD>$prod_pro_price</TD>
			<TD>$sku_qtt</TD>
			<TD><A HREF='show_product.php.php?id=$sku_id'>แก้ไข</A></TD>
			</TR>";
		}
	}
}
?>

<?php

//edit

if($_GET['id']!="")
{
	$action = 'edit';
	$sku_id = $_GET['id'];

	$sku = pg_fetch_row(pg_query($db,"SELECT * FROM stock WHERE sku_id = '$sku_id'"));
	$prod = pg_fetch_row(pg_query($db,"SELECT * FROM product WHERE prod_id = '$sku['prod_id']'"));
	
	$prod_type = $prod("prod_type");
	$prod_id = $prod("prod_id");
	$prod_name = $prod("prod_name");
	$prod_des = $prod("prod_description");
	$sku_id = $sku("sku_id");
	$sku_color = $sku("sku_color");
	$prod_price = $prod("prod_price");
	$prod_pro_price = $prod("prod_pro_price");
	$sku_qtt = $sku("sku_qtt");
	
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
	$sku_id = $_POST["sku_id"];
	$sku_color = $_POST["sku_color"];
	$prod_price = $_POST["prod_price"];
	$prod_pro_price = $_POST["prod_pro_price"];
	$sku_qtt = $_POST["sku_qtt"];
	
	pg_query($db,"UPDATE product SET prod_type = '$prod_type', prod_id = '$prod_id', prod_name = '$prod_name', prod_description = '$prod_des, prod_price = '$prod_price', prod_pro_price = '$prod_pro_price' WHERE prod_id = '$prod_id'");

}

?>

<script language="Javascript">




</script>



<FORM METHOD=POST ACTION="show_promotion.php" enctype="multipart/form-data">


<TABLE>
<TR>
	<TD>ประเภทสินค้า</TD>
	<TD><INPUT TYPE="text" NAME="prod_type" value="<?php echo $prod_type;?>"></TD>
</TR>
<TR>
	<TD>รหัสสินค้า</TD>
	<TD><INPUT TYPE="text" NAME="prod_id" value="<?php echo $prod_id;?>"></TD>
</TR>
<TR>
	<TD>ชื่อสินค้า</TD>
	<TD><INPUT TYPE="text" NAME="prod_name" value="<?php echo $prod_name;?>" ></TD>
</TR>
<TR>
	<TD>รายละเอียด</TD>
	<TD><INPUT TYPE="text" NAME="prod_description" value="<?php echo $prod_des;?>" ></TD>
</TR>
<TR>
	<TD>รหัส sku</TD>
	<TD><INPUT TYPE="text" NAME="sku_id" value="<?php echo $sku_id;?>"></TD>
</TR>
<TR>
	<TD>สี</TD>
	<TD><INPUT TYPE="text" NAME="sku_color" value="<?php echo $sku_color;?>" ></TD>
</TR>
<TR>
	<TD>ราคา</TD>
	<TD><INPUT TYPE="text" NAME="prod_price" value="<?php echo $prod_price;?>"></TD>
</TR>
<TR>
	<TD>ราคาโปรโมชั่น</TD>
	<TD><INPUT TYPE="text" NAME="prod_pro_price" value="<?php echo $prod_pro_price;?>"></TD>
</TR>
<TR>
	<TD>จำนวนสินค้า</TD>
	<TD><INPUT TYPE="text" NAME="sku_qtt" value="<?php echo $sku_qtt;?>" ></TD>
</TR>

</TABLE>

<br>

<INPUT TYPE='hidden' name='action' value='edit_submit'><INPUT TYPE='submit' value='submit'>

</form>


</body>
<HTML>