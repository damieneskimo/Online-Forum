<?php 
include('layouts/header.php'); 

if (!$session->is_logged_in()) { redirect_to("login.php"); } 

if(empty($_GET['id'])) {
	$session->message("No topic ID was provided.");
	redirect_to('topic_list.php');
}

$topic = Topic::find_by_id($_GET['id']);

if(isset($_POST['submit'])) {
	$topic->id = htmlentities($_GET['id']);
	$topic->title = htmlentities($_POST['title']);
	$topic->content = htmlentities($_POST['content']);
	$topic->user_id = $session->user_id;
	$topic->created_on = strftime("%Y-%m-%d %H:%M:%S", time());

	if($topic->save()) {
		// Success
  		$session->message("Topic edited successfully.");

		redirect_to('topic_list.php');
	} else {
		// Failure
 		 $message = join("<br />", $topic->errors);
	}
}


?>

<div class="row">

	<div class="col-xs-12 col-md-offset-2 col-md-8">
		<h2 class="section-title text-primary">Add a New Topic</h2>

		<?php echo output_message($message); ?>

    	<form action="update_topic.php?id=<?= $topic->id; ?>" method="post" class="form-horizontal">
    		<div class="form-group">
    			<div class="col-sm-1 control-label">
                	<label for="title" class="pull-left"><span class="">Title</span></label>
                </div>
                <div class="col-sm-11">
                	<input class="form-control" name="title" id="title" value="<?= $topic->title; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="content"></label>
                <textarea class="form-control" name="content" id="content" rows="10"><?= $topic->content; ?></textarea>
            </div>
            <button class="btn btn-primary center-block" name="submit" type="submit">Edit</button>
        </form>
    </div>

</div>

<?php include('layouts/footer.php'); ?>