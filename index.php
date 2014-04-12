<?php include ('header.php'); ?> 

      <div class="masthead">
        
        <h3 class="muted">NTOSS</h3>
      </div>

      <hr>

      <div class="jumbotron">
        <h1>NASA Technologist One Stop Shop</h1>
        <p class="lead">All information on projects, business opportunities, suppliers, vendors and competitions related to NASA</p>
		
		<?php $message = $_GET['message'];
		
		
		if($message == 1) {
		echo '
		<div class="alert">
		  <button type="button" class="close" data-dismiss="alert">&times;</button>
		  <strong>Invalid username or password</strong>
		</div>
		';
		}
		
		else if($message == 2) {
		echo '
		<div class="alert alert-success">
		  <button type="button" class="close" data-dismiss="alert">&times;</button>
		  <strong>You have successfully logged out! </strong>
		</div>
		';
		}
		
		?>
		
		
		<form action="auth_check.php" method="post" class="form-signin">
        <h2 class="form-signin-heading">Please sign in</h2>
        <input name="username" type="text" class="input-block-level" placeholder="Username">
        <input name="password" type="password" class="input-block-level" placeholder="Password"> 	
        <button class="btn btn-large btn-primary" type="submit">Sign in</button>
      </form>
	  
	  
        <a class="btn btn-large btn-success" href="register.php">Register New User</a>
      </div>


<?php include ('footer.php'); ?> 