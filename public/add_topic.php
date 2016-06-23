<?php 
include('layouts/header.php'); 

if (!$session->is_logged_in()) { redirect_to("login.php"); } 

// Find the logged in user
$user = User::find_by_id($session->user_id);

if(isset($_POST['submit'])) {
	// $title = $_POST['title'];
	// $content = $_POST['content'];
	// $user_id = $session->user_id;

	// $topic = Topic::make($title, $content, $user_id);


	// var_dump($topic);

	// if(!$topic) {
	// 	// Failure
 //  		$message = join("<br />", $topic->errors);
	// } else {
	// 	// Success
	// 	$topic->save();
 //  		$session->message("Topic added successfully.");
	// 	redirect_to('topic_list.php');
	// }

	$topic = new Topic();
	$topic->title = htmlentities($_POST['title']);
	$topic->content = htmlentities($_POST['content']);
	$topic->user_id = $session->user_id;
	$topic->created_on = strftime("%Y-%m-%d %H:%M:%S", time());
	// var_dump($topic);
	$topic->save();

	if($topic->save()) {
		// Success
  		$session->message("Topic added successfully.");

  		// add 2 points to user contribution when create a topic  		
  		$user->contribution += 2;
  		$user->save();

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

    	<form action="add_topic.php" method="post" class="form-horizontal">
    		<div class="form-group">
    			<div class="col-sm-1 control-label">
                	<label for="title" class="pull-left"><span class="">Title</span></label>
                </div>
                <div class="col-sm-11">
                	<input class="form-control" name="title" id="title" value="">
                </div>
            </div>
            <div class="form-group">
                <label for="content"></label>
                <textarea class="form-control" name="content" id="content" rows="10"></textarea>
            </div>
            <button class="btn btn-primary center-block" name="submit" type="submit">Post</button>
        </form>
    </div>

</div>

<?php include('layouts/footer.php'); ?>