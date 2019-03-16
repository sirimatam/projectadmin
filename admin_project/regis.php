<!DOCTYPE html>
<?php 
include 'navbar.php';
?>

<html>
<head><title> Project Store Admin </title></head>
<!-- registration /-->
<div class="container">
  <h4 class="text-primary"> Registeration </h4>

  
  
    <form method = "post" action="regis.php"> 
      <div class="input-group col-xs-6 col-s-4 col-m-4">
        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
            <input id="username" type="text" class="form-control" name="username" placeholder="username"></div>
     <div class="input-group col-xs-6 col-s-4 col-m-4">
        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
            <input id="password" type="text" class="form-control" name="password" placeholder="password"></div>
            <div class="input-group col-xs-6 col-s-4 col-m-4">
     <div class="input-group col-xs-6 col-s-4 col-m-4">
        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
            <input id="staff_name" type="text" class="form-control" name="staff_name" placeholder="name"></div>
            <div class="input-group col-xs-6 col-s-4 col-m-4">       
        
                <button class="btn btn-default" type="submit">
                <i class="glyphicon glyphicon-log-in"></i>
                </button>
            </div></div>
            <p> </p>
      </div>
    </form>
</div>

<!-- registeration check and sql -->

<?php
  include 'connection.php';
  if(isset($_POST['username']) AND isset($_POST['password']) AND isset($_POST['staff_name'])){

      $username = $_POST['username'];
	  $password = $_POST['password'];
      $name = $_POST['staff_name'];
	  
	 if ($username!='' AND $password != '' AND $name != ''){
		 
     $x = pg_query($db,"INSERT INTO staff (username,password,staff_name) VALUES ('$username','$password','$name')");
	  
	 
	  
		if(pg_affected_rows($x)[0] > 0){
			
			
	  
			echo "<div class='container'><p>Registeration Completed!</p>";
 			echo " <a href=index.php>Go Back to index</a></div>";}
  }
  	
  	else{
		echo "<div class='container'> <p class=\"text-danger\"> Incomplete Data, Please try again</p></div>";
		}}

  ?>

</html>