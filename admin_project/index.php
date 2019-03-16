
<?php
/*
	if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
		$uri = 'https://';
	} else {
		$uri = 'http://';
	}
	$uri .= $_SERVER['HTTP_HOST'];
	header('Location: '.$uri.'/dashboard/');
	exit;
	*/
?>


<?php 
require("connection.php");
include("navbar.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<HTML>
<head>

<title> Fashion Store Admin </title>
<META NAME="Generator" CONTENT="EditPlus">
<META NAME="Author" CONTENT="">
<META NAME="Keywords" CONTENT="">
<META NAME="Description" CONTENT="">
<META charset="UTF-8">

</head>
<body>
<br><br>
<p><center><a href='show_product.php'><input type='button' value='show/edit product'></a></center></p><br><br><br>
<p><center><a href='add_product.php'><input type='button' value='add product'></a></center></p><br><br><br>

<p><center><a href='payment.php'><input type='button' value='payment'></a></center></p><br><br><br>

<p><center><a href='packing.php'><input type='button' value='tracking'></a></center></p><br><br>









</body>
<HTML>
