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
	var new_field_html = '<div><p>รหัส sku <INPUT TYPE="text" NAME="sku_id[]" value="">สี <INPUT TYPE="text" NAME="sku_color[]" value="" >ไซส์<INPUT TYPE="text" NAME="sku_size[]" value="" >จำนวนสินค้า<INPUT TYPE="text" NAME="sku_qtt[]" value="" ><input type="file" name="files[]" multiple><a href="javascript:void(0);" class="remove_input_button"><button NAME="deletesku" id="deletesku" >delete</button></a></p></div>';
	
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
$prod_type_err = $prod_id_err = $prod_name_err = $prod_des_err = $sku_err = $sku_color_err = "";
$prod_price_err = $prod_pro_price_err = $sku_qtt_err = '';
$prod_type = $prod_id = $prod_name = $prod_des = "";
$prod_price = $prod_pro_price = $sku_qtt = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
if(empty($_POST['prod_type'])) { $prod_type_err = 'กรุณาใส่ประเภทสินค้า'; } else{$prod_type = $_POST["prod_type"];}
if(empty($_POST['prod_id'])) { $prod_id_err = 'กรุณาใส่รหัสสินค้า'; }
	else
	{
		$prod_id = $_POST['prod_id'];
		$prod_id_all = pg_query($db,"SELECT prod_id FROM product");
		while($prod_id_now = pg_fetch_row($prod_id_all)[0])
		{
			if($prod_id == $prod_id_now)
			{
				$prod_id_err = 'รหัสสินค้านี้มีอยู่แล้ว กรุณาใส่รหัสสินค้าใหม่อีกครั้ง';
			}
		}
	}
if(empty($_POST['prod_name'])) { $prod_name_err = 'กรุณาใส่ชื่อสินค้า'; } else{$prod_name = $_POST["prod_name"];}
if(empty($_POST['prod_description'])) { $prod_des_err = 'กรุณาใส่รายละเอียดสินค้า'; } else{$prod_des = $_POST["prod_description"];}
$sku_num =sizeof( $_POST['sku_id']);
$sku_id = $_POST['sku_id'];
/*if(sizeof($_POST['sku_id'] )== []) { $sku_id_err = 'กรุณาเติมช่องskuให้ครบ'; }
	else
	{
		$sku_id = $_POST['sku_id'];
		$sku_id_all = pg_query($db,"SELECT sku_id FROM stock");
		/*
		while($sku_id_now = pg_fetch_row($sku_id_all)[0])
		{
			if($sku_id == $sku_id_now)
			{
				$sku_id_err = 'รหัส sku นี้มีอยู่แล้ว กรุณาใส่ใหม่อีกครั้ง';
			}
		}
	}*/
$color = $_POST["sku_color"];
if($color[$sku_num-1]=='') { $sku_err = 'กรุณาเติมช่องskuใหม่ให้ครบ'; } else{$sku_color = $_POST["sku_color"];}
if($_POST['sku_size'][$sku_num-1]=='') { $sku_err = 'กรุณาเติมช่องskuใหม่ให้ครบ'; } else{$sku_size = $_POST["sku_size"];}
if(empty($_POST['prod_price'])) { $prod_price_err = 'กรุณาเติมช่องskuให้ครบ'; } else{$prod_price = $_POST["prod_price"];}
if(empty($_POST['prod_pro_price'])) { $prod_pro_price_err = 'กรุณาเติมช่องskuให้ครบ'; } else{$prod_pro_price = $_POST["prod_price"];}
if($_POST['sku_qtt'][$sku_num-1]=='') { $sku_err = 'กรุณาเติมช่องskuใหม่ให้ครบ'; } else{$sku_qtt = $_POST["sku_qtt"];}
}
?>

<?php
$sku_pic_check = "";
$prod_pic_check = "";
if($_FILES["file"]["name"][$sku_num-1]==''){$sku_pic_check = 'กรุณาใส่รูปskuให้ครบ';}
if($_FILES["file_pd"]['name'][0]==''){$prod_pic_check = 'กรุณาใส่รูปให้ครบ';}

//add
if($prod_type_err==''&&$prod_id_err==''&&$prod_pic_check==''&&$prod_name_err==''&&$prod_des_err==''&&$sku_err==''&&$prod_price_err==0&&$prod_pro_price_err==0&&$sku_pic_check=='')
{
if($_POST['action']=='add')
{
	
	$check_pic_pd = 0;
	$check_pic_sku = [];
	
	$fid_sku = array();
	for($i=0;$i<sizeof($sku_id);$i++)
	{
		pg_query($db,"INSERT INTO stock (sku_id,prod_id,sku_qtt,sku_color,sku_size) VALUES ('$sku_id[$i]','$prod_id',$sku_qtt[$i],'$sku_color[$i]','$sku_size[$i]')");
		$fid_sku[$i] = $sku_id[$i];
	}
	pg_query($db,"INSERT INTO product (prod_id,prod_name,prod_type,prod_description,prod_price,prod_pro_price) VALUES ('$prod_id','$prod_name','$prod_type','$prod_des',$prod_price,$prod_pro_price)");
	$fid_prod = $prod_id;
	
	echo $prod_id."<br>".$prod_name."<br>".$prod_type."<br>";
	for($i=0;$i<sizeof($sku_id);$i++)
	{
		echo $sku_id[$i]."<br>";
	}
	
}

	
	//upload pic
if($_FILES["files"])
	{
		for($i=0;$i<$sku_num;$i++)
		{
		if ($_FILES["files"]["error"][$i] > 0)
		{
			echo "Error: " . $_FILES["files"]["error"][$i] . "<br>";
			if($_FILES["files"]["error"][$i]==4) echo"No file upload";
		}
		else
		{
			
				$fname1=explode(".",$_FILES["files"]["name"][$i]);
				$new_filename=$fid_sku[$i].".".$fname1[1]; 
				move_uploaded_file($_FILES["files"]["tmp_name"][$i],
				"img/" . $new_filename);
				pg_query($db,"UPDATE stock SET sku_img='$new_filename' WHERE sku_id='$fid_sku[$i]'") ; 
				$check_pic_sku[$i] = 1;
		}
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
			$fname=explode(".",$_FILES["file_pd"]["name"]);
			$new_filename=$fid_prod.".".$fname[1]; 
			move_uploaded_file($_FILES["file_pd"]["tmp_name"],
			"img/" . $new_filename);
			pg_query($db,"UPDATE product SET prod_img='$new_filename' WHERE prod_id='$fid_prod'") ; 
			$check_pic_pd = 1;
		}
	}
	else 
	{
		echo "no file";
	}
	
if($check_pic_pd==1 && sizeof($check_pic_sku)==$sku_num){echo 'บันทึกสำเร็จแล้ว';}

	
	
}
?>


<h2>เพิ่มรายการสินค้า</h2>
<p><span class="error">* required field</span></p>


<FORM METHOD=POST ACTION="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">


<TABLE>
<TR>
	<TD>ประเภทสินค้า</TD>
	<TD><INPUT TYPE="text" NAME="prod_type" value="<?php echo $prod_type;?>"></TD>
	<TD><span class="error">* <?php echo $prod_type_err;?></span></TD>
</TR>
<TR>
	<TD>รหัสสินค้า</TD>
	<TD><INPUT TYPE="text" NAME="prod_id" value="<?php echo $prod_id;?>"></TD>
	<TD><span class="error">* <?php echo $prod_id_err;?></span></TD>
</TR>
<TR>
	<TD>ชื่อสินค้า</TD>
	<TD><INPUT TYPE="text" NAME="prod_name" value="<?php echo $prod_name;?>" ></TD>
	<TD><span class="error">* <?php echo $prod_name_err;?></span></TD>
</TR>
<TR>
	<TD>รายละเอียด</TD>
	<TD><INPUT TYPE="text" NAME="prod_description" value="<?php echo $prod_des;?>" ></TD>
	<TD><span class="error">* <?php echo $prod_des_err;?></span></TD>
</TR>
<TR>
	<TD>ราคา</TD>
	<TD><INPUT TYPE="text" NAME="prod_price" value="<?php echo $prod_price;?>"></TD>
	<TD><span class="error">* <?php echo $prod_price_err;?></span></TD>
</TR>
<TR>
	<TD>ราคาโปรโมชั่น</TD>
	<TD><INPUT TYPE="text" NAME="prod_pro_price" value="<?php echo $prod_price;?>"></TD>
</TR>
</TABLE>
<input type="file" name="file_pd" id="file_pd">

<div class="field_wrapper">
<div>
	<p>รหัส sku <INPUT TYPE="text" NAME="sku_id[]" value="">
	สี <INPUT TYPE="text" NAME="sku_color[]" value="" >
	ไซส์<INPUT TYPE="text" NAME="sku_size[]" value="" >
	จำนวนสินค้า<INPUT TYPE="text" NAME="sku_qtt[]" value="" >
	<input type="file" name="files[]" multiple>
	<a href="javascript:void(0);" class="add_input_button">add_sku</a></p>
</div>
</div>
<p><span class="error">* <?php echo $sku_err;?></span></p>
<INPUT TYPE='hidden' name='action' value='add'><INPUT TYPE='submit' value='add'>
<INPUT TYPE="reset" value="clear">

</form>

<?php
echo $sku_pic_check.'<br>';
echo $prod_pic_check.'<br>';
echo "<h2>Your Input:</h2>";
echo "รหัสสินค้า ".$prod_id."<br>".$prod_name."<br>".$prod_type."<br>";
	for($i=0;$i<sizeof($sku_id);$i++)
	{
		
		echo $sku_id[$i]."<br>".$color[$i]."<br>";
		echo $_FILES["file"]["name"][$i];
	}
echo $_FILES["file"]["name"];
//echo $fname1[0]."<br>".$fname1[1];

/*
$x = $_POST['sku_id'];
$y = $_POST['sku_color'];
echo sizeof($_POST['sku_id']);
echo sizeof($_POST['sku_color']);

echo $x[0];
echo $y[0];
if ($y[sizeof($_POST['sku_color'])-1]==''){echo 'ok';}

echo $prod_pic_check.' '.$sku_pic_check;
echo sizeof($_FILES["file"]["name"]);
echo sizeof($_FILES["file_pd"]["name"])
*/
?>

</body>
<HTML>