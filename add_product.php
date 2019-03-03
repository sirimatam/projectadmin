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

<?php

//add
if($_POST['action']=='add')
{
	$prod_type = $_POST["prod_type"];
	$prod_id = $_POST["prod_id"];
	$prod_name = $_POST["prod_name"];
	$prod_des = $_POST["prod_description"];
	$prod_price = $_POST["prod_price"];
	$prod_pro_price = $_POST["prod_pro_price"];
	$sku_id = $_POST["sku_id"];
	$sku_color = $_POST["sku_color"];
	$sku_qtt = $_POST["sku_qtt"];
	$fid_sku = array();
	for($i=0;$i<sizeof($sku_id);$i++)
	{
		pg_query($db,"INSERT INTO stock (sku_id,prod_id,sku_qtt,sku_color,sku_size) VALUES ('$sku_id[$i]','$prod_id','$sku_qtt[$i]','$sku_color[$i]','$sku_size[$i]')");
		$fid_sku[$i] = $sku_id;
	}

	pg_query($db,"INSERT INTO product (prod_id,prod_name,prod_type,prod_description,prod_price,prod_pro_price) VALUES ('$prod_id','$prod_name','$prod_type','$prod_description','$prod_price','$prod_pro_price')");
	$fid_prod = $prod_id;
}
	//upload pic
	if($_FILES["file"])
	{
		if ($_FILES["file"]["error"] > 0)
		{
			echo "Error: " . $_FILES["file"]["error"] . "<br>";
			if($_FILES["file"]["error"]==4) echo"No file upload";
		}

		else
		{
			foreach($fid_sku as $fid)
			{
				$fname=explode(".",$_FILES["file"]["name"]);
				$new_filename=$fid.".".$fname[1]; 
				move_uploaded_file($_FILES["file"]["tmp_name"],
				"upload/" . $new_filename);
				pg_query($db,"UPDATE stock SET sku_pic='$new_filename' WHERE sku_id='$fid'" ; 
			}
			$fname=explode(".",$_FILES["file"]["name"]);
			$new_filename=$fid_prod.".".$fname[1]; 
			move_uploaded_file($_FILES["file"]["tmp_name"],
			"upload/" . $new_filename);
			pg_query($db,"UPDATE product SET prod_pic='$new_filename' WHERE prod_id='$fid_prod'" ; 
		}

	}

	else 
	{
		echo "no file";
	}
	
	
	if($_FILES["file_pd"])
	{
		if ($_FILES["file_pd"]["error"] > 0)
		{
			echo "Error: " . $_FILES["file_pd"]["error"] . "<br>";
			if($_FILES["file_pd"]["error"]==4) echo"No file upload";
		}

		else
		{
			foreach($fid_sku as $fid)
			{
				$fname=explode(".",$_FILES["file_pd"]["name"]);
				$new_filename=$fid.".".$fname[1]; 
				move_uploaded_file($_FILES["file_pd"]["tmp_name"],
				"upload/" . $new_filename);
				pg_query($db,"UPDATE stock SET sku_pic='$new_filename' WHERE sku_id='$fid'" ; 
			}
			$fname=explode(".",$_FILES["file_pd"]["name"]);
			$new_filename=$fid_prod.".".$fname[1]; 
			move_uploaded_file($_FILES["file_pd"]["tmp_name"],
			"upload/" . $new_filename);
			pg_query($db,"UPDATE product SET prod_pic='$new_filename' WHERE prod_id='$fid_prod'" ; 
		}

	}

	else 
	{
		echo "no file";
	}



?>



<FORM METHOD=POST ACTION="add_product.php" enctype="multipart/form-data">


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
	<TD>ราคา</TD>
	<TD><INPUT TYPE="text" NAME="prod_price" value="<?php echo $prod_price;?>"></TD>
</TR>
<TR>
	<TD>ราคาโปรโมชั่น</TD>
	<TD><INPUT TYPE="text" NAME="prod_pro_price" value="<?php echo $prod_pro_price;?>"></TD>
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
	<a href="javascript:void(0);" class="add_input_button"><button NAME="addsku" id="addsku"" >Add SKU</button></a></p>
</div>
</div>

<INPUT TYPE='hidden' name='action' value='add'><INPUT TYPE='submit' value='add'>
<INPUT TYPE="reset" value="clear">

</form>


</body>
<HTML>
