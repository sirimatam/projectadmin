<?php
require("connection.php");
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<META NAME="Generator" CONTENT="EditPlus">
<META NAME="Author" CONTENT="">
<META NAME="Keywords" CONTENT="">
<META NAME="Description" CONTENT="">
</HEAD>

<BODY>
<?php
if ($_GET['id']!='')
{
	$order_id = $_GET['id'];
	echo '<h>'.$order_id.'</h>';
}
	
	if($_FILES["fileToUpload"])
	{
		if ($_FILES["fileToUpload"]["error"] > 0)
		{
			echo "Error: " . $_FILES["fileToUpload"]["error"] . "<br>";
			if($_FILES["fileToUpload"]["error"]==4) echo"No file upload";
		}
		else
		{
			$fname=explode(".",$_FILES["fileToUpload"]["name"]);
			$new_filename=$fid_prod.".".$fname[1]; 
			move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],
			"img/" . $new_filename);
			date_default_timezone_set("Asia/Bangkok");
			$date = date("Y-m-d");
			$time = date("H:i:s");
			pg_query($db,"INSERT INTO payment (pay_slip,pay_date,pay_time,order_id,pay_check) VALUES ('$new_filename','$date','$time','$order_id','0')")
			
		}
	}
	else 
	{
		echo "no file";
	}	

	
?>

<form action="uploading.php" method="post" enctype="multipart/form-data">
    <p>การแจ้งชำระเงิน:</p><br>
	<input type="text" name="รหัสใบสั่งซื้อ" id="orderid" value="<?php echo $order_id; ?>">
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>



</BODY>
</HTML>
