<!DOCTYPE html>
<?php 

include ('navbar.php');
include ('connection.php');
 ?><head><title> <?php echo $_SESSION['name']; ?> </title></head>

<?php
		
		
		if ($_GET['action'] = 'edit_data'){
			echo "<div class=\"container\">
  <h4 class=\"text-primary\"> Edit your information </h4>
    <form method = \"post\" action=\"user.php?action=savedata\"> 
      	<div class=\"input-group col-xs-6 col-s-4 col-m-4\">
        	<span class=\"input-group-addon\"><i class=\"glyphicon glyphicon-user\"></i></span>
            	<input id=\"name\" type=\"text\" class=\"form-control\" name=\"name\" placeholder='".$_SESSION['name']."'>
					<div class=\"input-group-btn\">
                		<button class=\"btn btn-default\" type=\"submit\">
               			 <i class=\"glyphicon glyphicon-save\"></i>
               			</button>
            		</div></div>
					</form>
					
		
    <form method = \"post\" action=\"user.php?action=savedata\"> 
		<div class=\"input-group col-xs-6 col-s-4 col-m-4\">
			<span class=\"input-group-addon\"><i class=\"glyphicon glyphicon-phone\"></i></span>
            	<input id=\"username\" type=\"text\" class=\"form-control\" name=\"username\" placeholder=".$_SESSION['username'].">
             		<div class=\"input-group-btn\">
                		<button class=\"btn btn-default\" type=\"submit\">
               			 <i class=\"glyphicon glyphicon-save\"></i>
                </button>
            </div> </div>
            <p> </p>
      </div>
    </form>
	
	<form method = \"post\" action=\"user.php?action=savedata\"> 
		<div class=\"input-group col-xs-6 col-s-4 col-m-4\">
			<span class=\"input-group-addon\"><i class=\"glyphicon glyphicon-phone\"></i></span>
            	<input id=\"password\" type=\"text\" autocomplete=\"off\" class=\"form-control\" name=\"password\" placeholder=\"reset password here\">
             		<div class=\"input-group-btn\">
                		<button class=\"btn btn-default\" type=\"submit\">
               			 <i class=\"glyphicon glyphicon-save\"></i>
                </button>
            </div> </div>
            <p> </p>
      </div>
    </form>
</div>";
		}
		
	} ?>


 
<div class='container'>
    
    <h4 class= 'text-primary'> <?php echo "Welcome ".$_SESSION['name'];?> </h4>
    <TABLE class= 'text-muted'>
    <TR>
        <TD> staff id  </TD><TD>  :  <?php echo $_SESSION['staff_id'] ;?> </TD></TR>
    <TR>
        <TD> username  </TD><TD>  :   <?php echo $_SESSION['username'];?> </TD></TR>
    
    </TABLE>
    <br />
    
          <a href="user.php?action=edit_data" class="btn btn-info my-1 my-sm-0">
          <button type="button" class="btn btn-danger">edit data</button>
        </a> 
    <br />
    <br />
</div>
 

    

</html>