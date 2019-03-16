<!DOCTYPE html>

<html lang"en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src= "https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
<nav class="navbar">


  <div class="container-fluid">
    <div class="navbar-header">
	
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">

      </button>
      <a class="navbar-brand" > Project Store Admin </a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
	    
        <li><a href="index.php"> Homepage </a></li>
        
      </ul>
      <ul class="nav navbar-nav navbar-right">
      <?php
      if(isset($_SESSION['name'])){  
          echo "<li><a href=\"user.php\"><span class=\"glyphicon glyphicon-user\"></span>".$_SESSION['name']."    </a></li>
        <li><a href=\"logout.php\"><span class=\"glyphicon glyphicon-log-out\"></span> Logout</a></li>";
      }
      else{
		  echo "<li><a href=\"regis.php\"><span class=\"glyphicon glyphicon-user\"></span> Sign up</a></li>";
        echo "<li><a href=\"login.php\"><span class=\"glyphicon glyphicon-log-in\"></span> Login</a></li>";
      } ?>
      </ul>
    </div>
  </div>
</nav>



</html>