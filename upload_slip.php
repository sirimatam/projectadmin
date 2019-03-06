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


<form action="uploading.php" method="post" enctype="multipart/form-data">
    <p>การแจ้งชำระเงิน:</p><br>
	<input type="text" name="รหัสใบสั่งซื้อ" id="orderid">
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>



</BODY>
</HTML>
