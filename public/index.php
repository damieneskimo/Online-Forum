<?php 

include('layouts/header.php'); 
// require_once("../includes/initialize.php");

$brand = new Brand();
?>

<div class="row">
    <div class="col-xs-12 col-md-10 col-md-offset-1">

		<div class="jumbotron">
		    <p><?= $brand->getDescription(); ?></p>
            <p><a class="btn btn-primary btn-lg" href="login.php" role="button">Start Now</a></p>

		</div>
       
	</div>
</div><!-- /.row -->      

<?php include('layouts/footer.php'); ?>