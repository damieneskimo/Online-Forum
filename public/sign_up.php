<?php 
include('layouts/header.php');
require_once("../includes/initialize.php");

// Remember to give your form's submit tag a name="submit" attribute!
if (isset($_POST['submit'])) { 

	$name = htmlentities(trim($_POST['name']));
  	$email = htmlentities(trim($_POST['email']));
  	if(trim($_POST['password']) == trim($_POST['confirm-password'])) {
  		$password = htmlentities(trim($_POST['password']));
		
		// Create user in the database
  		$user = User::make($name, $email, $password);

		if ($user) {
			$session->login($user);
			redirect_to("topic_list.php");
		} else {
			// Validation
			if(empty($_POST['confirm-password']) || empty($_POST['password'])) {
				$message = 'The password cannot be empty';
			}
			if(empty($name)) {
				$message = 'The name cannot be empty.';
			}
			if(empty($email)) {
				$message = 'The email cannot be empty.';
			}
		}
  	} else {
  		$message = 'The password cannot be confirmed.';
  	}
  	
}
?>

<div class="row">
    <div class="col-xs-12 col-md-10 col-md-offset-1">

		<div class="well well-lg col-sm-offset-2 col-sm-8">
			<?php echo output_message($message); ?>
		    <form class="form-horizontal" action="sign_up.php" method="post">
			    <div class="form-group">
			        <label for="name" class="col-sm-3 control-label">Name</label>
			        <div class="col-sm-9">
			        	<input type="text" class="form-control" id="name" name="name" value="" placeholder="Your name">
		        	</div>	
			    </div>
			    <div class="form-group">
			        <label for="email" class="col-sm-3 control-label">Email address</label>
			        <div class="col-sm-9">
			        	<input type="email" class="form-control" id="email" name="email" value="" placeholder="Email">
		        	</div>	
			    </div>
			    <div class="form-group">
			        <label for="password" class="col-sm-3 control-label">Password</label>
			        <div class="col-sm-9">
			        	<input type="password" class="form-control" id="password" name="password" value="" placeholder="Password">
		        	</div>
			    </div>
			    <div class="form-group">
			        <label for="confirm-password" class="col-sm-3 control-label">Confirm Password</label>
			        <div class="col-sm-9">
			        	<input type="password" class="form-control" id="confirm-password" name="confirm-password" value="" placeholder="Confirm Your Password">
		        	</div>
			    </div>
			    <div class="form-group">
				    <div class="col-sm-offset-3 col-sm-9">
				      	<div class="checkbox">
				        	<label>
				          	<input type="checkbox"> Remember me
				        	</label>
				      	</div>
				    </div>
			  	</div>
			    <div class="form-group">
				    <div class="col-sm-offset-3 col-sm-9">
				      	<button type="submit" name="submit" class="btn btn-primary">Sign up</button>
				    </div>
			  	</div>
			</form>
			<div class="row">
				<div class="col-xs-12 col-md-9 col-md-offset-3">
					<p>Or log in if you have an account already</p>
					<a href="login.php"><button class="btn btn-primary">Log in</button></a>
				</div>
			</div>		
		</div>
       
	</div>
</div><!-- /.row -->      

<?php include('layouts/footer.php'); ?>