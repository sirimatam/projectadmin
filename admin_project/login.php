<!DOCTYPE html>
<?php 

    include ('navbar.php');
    include ('connection.php');?>
    
<html>

<head><title> Login  </title></head><br><br><br>
<div class="container">
    <h4 class="text-primary"> Login  </h4>
    <p class="text-muted"> to access only-member function </p>
  </div>
  <div class="container">
  
  
  
     <form method = "post" action="login.php"> 
      <div class="input-group col-xs-6 col-s-4 col-m-4">
       <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input id="username" type="text" class="form-control" name="username" placeholder="username"></div>
     <div class="input-group col-xs-6 col-s-4 col-m-4">
        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input id="password" type="text" class="form-control" name="password" placeholder="password">
             <div class="input-group-btn">
                <button class="btn btn-default" type="submit">
                <i class="glyphicon glyphicon-log-in"></i>
                </button>
            </div></div>
            <p>
  </div>

<?php 

	if (isset($_POST['username']) AND isset($_POST['password'])){
	$username = $_POST['username'];
	$pw = $_POST['password'];
	
	echo $username , $pw;


    if (($username !='')AND($pw !='')){
		echo "hello";
		
        $query = pg_query($db,"SELECT staff_id,staff_name  
        FROM staff WHERE username = '$username' 
        AND password = '$pw' LIMIT 1;");
        
       

       if (pg_num_rows($query) !=1){
        echo "Wrong username or password";
        echo "<a href='login.php' >Go back</a>";}
    
       else{
       $list=pg_fetch_row($query);
	  
       $_SESSION['id']=$list['staff_id'];
	   $_SESSION['name']=$list['staff_name'];
	   $_SESSION['username']=$list['username'];
       
	   header('Location: index.php');
	   }}
    else
    {
        echo "<div class=\"container\"><p class=\"text-danger\">login failed</p>";
        echo "<p class=\"text-danger\">login or password is not completed</p>";
    } }
?>




</html>