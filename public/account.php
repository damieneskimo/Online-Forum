<?php include('layouts/header.php'); ?>

<?php 
	// update account
	if (!$session->is_logged_in()) { redirect_to("login.php"); }

	// must have an ID
	if(empty($_GET['id'])) {
	  	$session->message("No user ID was provided.");
	  	redirect_to('topic_list.php');
	}

	// find the current user
	$user = User::find_by_id($_GET['id']);


	if(isset($_POST['submit'])) {
	  	$user->name = trim($_POST['name']);

	  	if(empty($user->name)){
			$message = "User name cannot be empty.";
		} elseif ($user && $user->save()) {
			$message = "Account updated successfully!";
		}
	} 

	if(isset($database)) { $database->close_connection(); } 
?>

<!-- breadcrumb -->
<ol class="breadcrumb">
  <li><a href="index.php">Home</a></li>
  <li><a href="topic_list.php">Topic List</a></li>
  <li class="active">Account</li>
</ol>

<section>
    <div class="col-md-6 col-md-offset-3">
        <header><h3>Your Account</h3></header>
        <?php echo output_message($message); ?>
        <form action="account.php?id=<?= $user->id; ?>" method="post"">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" value="<?= $user->name; ?>" id="name" <?php if($session->user_id !== $user->id){ echo 'disabled'; } ?> >
            </div>
            <div class="form-group">
                <label for="contribution">Contribution</label>
                <input type="text" name="contribution" class="form-control" value="<?= $user->contribution; ?>" id="contribution" disabled>
            </div>
            <div class="form-group">
                <label for="image">Email</label>
                <input type="text" name="email" class="form-control" id="email" value="<?= $user->email; ?>" disabled>
            </div>
            <!-- only when the logged in user is the account owner-->
            <?php if($session->user_id == $user->id){ ?>
            	<button type="submit" name="submit" class="btn btn-primary">Save Account</button>
            <?php } ?>
        </form>
    </div>
</section>

<?php include('layouts/footer.php'); ?>