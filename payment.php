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

	<TD>pay_id</TD>
	<TD>pay_slip</TD>
	<TD>pay_date</TD>
	<TD>pay_time</TD>
	<TD>order_id</TD>
	<TD>total_price</TD>
	<TD>status</TD>
</TR>

<?php
if ($_GET['id'] = '')
{
	$order_id = $_GET['id'];
	pg_query($db,"UPDATE FROM TABLE orderlist SET order_status = 'waiting for packing' WHERE order_id = '$order_id'");
	pg_query($db,"UPDATE FROM TABLE payment SET pay_check = '1' WHERE order_id = '$order_id'");
}




?>

<?php
//show payment list
$pay_array = pg_query($db,"SELECT * FROM payment WHERE pay_check = '0'");
while($pay = pg_fetch_row($pay_array))
{
	$pay_id = $pay("pay_id");
	$pay_slip = $pay("pay_slip");
	$pay_date = $pay("pay_date");
	$pay_time = $pay("pay_time");
	$order_id = $pay("order_id");
	$total_price = pg_query($db,"SELECT total_price FROM orderlist WHERE order_id = '$order_id'");
	
			echo "<TR>
			<TD>$pay_id</TD>
			<TD>$pay_slip</TD>
			<TD>$pay_date</TD>
			<TD>$pay_time</TD>
			<TD>$order_id</TD>
			<TD>$total_price</TD>
			<TD><div class='field_wrapper'>
			<div><a href='javascript:void(0);' class='replaceButton'><a href='payment.php?id=$order_id'><button NAME='confirm' id=$order_id>Confirm</button></a></a></div>
			</div></TD>
			</TR>";

}
?>

</table>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function()
{
	var replace_button = $('.replaceButton');
	var wrapper = $('.field_wrapper');
	var accepted = '<div><center>confirmed</center></div>';
	$(replace_button).click(function()
	{
    	$(this).parent().remove();
		$(wrapper).append(accepted);
		
	});
	
});

</script>






</body>
<HTML>
