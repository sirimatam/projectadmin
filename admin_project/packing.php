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

	<TD>order_id</TD>
	<TD>order_desc</TD>
	<TD>sku_id</TD>
	<TD>tracking no.</TD>
	<TD>submit</TD>
</TR>

<?php
/*
if ($_POST['action'] != '')
{
	$order_array = pg_query($db,"SELECT order_id FROM payment WHERE pay_check = '0'");
	for($i=0;$i<pg_num_rows($order_array);$i++)
	{
	if ($_POST['action'] == pg_fetch_row($order_array)[0])
	{
	$order_id = $_POST['action'];
	pg_query($db,"UPDATE orderlist SET order_status = 'shipping' WHERE order_id = '$order_id'");
	}
	}
}*/
?>

<?php
//show packing list
$order_array = pg_query($db,"SELECT * FROM orderlist WHERE order_status = 'waiting for packing'");
while($order = pg_fetch_row($order_array))
{
	$order_id = $order[0];
	$cartp_id = $order[1];
	$sku_array = pg_query($db,"SELECT sku_id FROM cart_product WHERE cartp_id = '$cartp_id'");
	$cus_id = pg_fetch_row(pg_query($db,"SELECT cus_id FROM createcart WHERE cartp_id = '$cartp_id'"))[0];
	$order_desc = pg_fetch_row(pg_query($db,"SELECT cus_description FROM customer WHERE cus_id = '$cus_id' AND cus_default = '1'"))[0];
	$detail = "";
	while($skuid = pg_fetch_row($sku_array)[0])
	{
		$sku_qtt = pg_fetch_row(pg_query($db,"SELECT cart_prod_qtt FROM cart_product WHERE sku_id = '$skuid' AND cartp_id = '$cartp_id'"))[0];
		$sku = pg_fetch_row(pg_query($db,"SELECT * FROM stock WHERE sku_id = '$skuid'"));
		$prod = pg_fetch_row(pg_query($db,"SELECT prod_name FROM product WHERE prod_id = '$sku[1]'"))[0];
		$detail .= $skuid." ".$prod." ".$sku[3]." ".$sku[4]." "."# ".$sku_qtt."<br>";
	}
			echo "<FORM METHOD=POST ACTION='packing_handler.php'><TR>
			<TD>$order_id</TD>
			<TD>$order_desc</TD>
			<TD>$detail</TD>
			<TD><INPUT TYPE='text' name='track_no' value=''></TD>
			<TD><INPUT TYPE='hidden' name='track_submit' id=$order_id value='$order_id'><INPUT TYPE='submit' value='Confirm'></TD>
			</TR></form>";
}
?>

</table>





</body>
<HTML>