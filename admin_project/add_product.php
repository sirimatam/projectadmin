<?php 
require("connection.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<HTML>
<head>
<style>
.error {color: #FF0000;}
</style>
<META NAME="Generator" CONTENT="EditPlus">
<META NAME="Author" CONTENT="">
<META NAME="Keywords" CONTENT="">
<META NAME="Description" CONTENT="">
<META charset="UTF-8">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function()
{
	var add_button = $('.add_input_button');
	var wrapper = $('.field_wrapper');
	var new_field_html = '<div><p>รหัส sku <INPUT TYPE="text" NAME="sku_id[]" value="">สี <INPUT TYPE="text" NAME="sku_color[]" value="" >ไซส์<INPUT TYPE="text" NAME="sku_size[]" value="" >จำนวนสินค้า<INPUT TYPE="text" NAME="sku_qtt[]" value="" ><input type="file" name="file" id="file"><a href="javascript:void(0);" class="remove_input_button"><button NAME="deletesku" id="deletesku" >delete</button></a></p></div>';
	
	//Add button dynamically
	$(add_button).click(function()
	{
		$(wrapper).append(new_field_html);
	});
	// Remove dynamically added button
	$(wrapper).on('click', '.remove_input_button', function(e)
	{
		e.preventDefault();
		$(this).parent().remove();
	});
});
</script>


</head>
<body>

<?php
$prod_type_err = $prod_id_err = $prod_name_err = $prod_des_err = $sku_size_err = $sku_id_err = $sku_color_err = "";
$prod_price_err = $prod_pro_price_err = $sku_qtt_err = 0;
if(empty($_POST['prod_type'])) { $prod_type_err = 'กรุณาใส่ประเภทสินค้า'; }
if(empty($_POST['prod_id'])) { $prod_name_err = 'กรุณาใส่รหัสสินค้า'; }
	else
	{
		$prod_id = $_POST['prod_id'];
		$prod_id_all = pg_query($db,"SELECT prod_id FROM product");
		while($prod_id_now = pg_query($prod_id_all))
		{
			if($prod_id == $prod_id_now)
			{
				$prod_id_err = 'รหัสสินค้านี้มีอยู่แล้ว กรุณาใส่รหัสสินค้าใหม่อีกครั้ง';
			}
		}
	}
if(empty($_POST['prod_name'])) { $prod_name_err = 'กรุณาใส่ชื่อสินค้า'; }
if(empty($_POST['prod_des'])) { $prod_des_err = 'กรุณาใส่รหัสสินค้า'; }
if(empty($_POST['sku_id'])) { $sku_id_err = 'กรุณาใส่รหัส sku'; }
	else
	{
		$sku_id = $_POST['sku_id'];
		$sku_id_all = pg_query($db,"SELECT sku_id FROM stock");
		while($sku_id_now = pg_query($sku_id_all))
		{
			if($sku_id == $sku_id_now)
			{
				$sku_id_err = 'รหัส sku นี้มีอยู่แล้ว กรุณาใส่ใหม่อีกครั้ง';
			}
		}
	}
if(empty($_POST['sku_color'])) { $sku_color_err = 'กรุณาใส่สีสินค้า'; }
if(empty($_POST['sku_size'])) { $sku_size_err = 'กรุณาใส่สีสินค้า'; }
if(empty($_POST['prod_price'])) { $prod_price_err = 'กรุณาใส่ราคา'; }
if(empty($_POST['prod_pro_price'])) { $prod_pro_price_err = 'กรุณาใส่ราคาโปรโมชั่น'; }
if(empty($_POST['sku_qtt'])) { $sku_qtt_err = 'กรุณาใส่จำนวนสินค้า'; }
?>


<h2>เพิ่มรายการสินค้า</h2>
<p><span class="error">* required field</span></p>


<FORM METHOD="POST" ACTION="add_product_handler.php" enctype="multipart/form-data">


<TABLE>
<TR>
	<TD>ประเภทสินค้า</TD>
	<TD><INPUT TYPE="text" NAME="prod_type" value=""></TD>
</TR>
<TR>
	<TD>รหัสสินค้า</TD>
	<TD><INPUT TYPE="text" NAME="prod_id" value=""></TD>
</TR>
<TR>
	<TD>ชื่อสินค้า</TD>
	<TD><INPUT TYPE="text" NAME="prod_name" value="" ></TD>
</TR>
<TR>
	<TD>รายละเอียด</TD>
	<TD><INPUT TYPE="text" NAME="prod_description" value="" ></TD>
</TR>
<TR>
	<TD>ราคา</TD>
	<TD><INPUT TYPE="text" NAME="prod_price" value=""></TD>
</TR>

</TABLE>
<input type="file" name="file_pd" id="file_pd">

<div class="field_wrapper">
<div>
	<p>รหัส sku <INPUT TYPE="text" NAME="sku_id[]" value="">
	สี <INPUT TYPE="text" NAME="sku_color[]" value="" >
	ไซส์<INPUT TYPE="text" NAME="sku_size[]" value="" >
	จำนวนสินค้า<INPUT TYPE="text" NAME="sku_qtt[]" value="" >
	<input type="file" name="file" id="file">
	<a href="javascript:void(0);" class="add_input_button">add_sku</a></p>
</div>
</div>

<INPUT TYPE='hidden' name='action' value='add'><INPUT TYPE='submit' value='add'>
<INPUT TYPE="reset" value="clear">

</form>


</body>
<HTML>