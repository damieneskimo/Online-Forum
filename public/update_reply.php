<?php 
require_once("../includes/initialize.php"); 

if (!$session->is_logged_in()) { redirect_to("login.php"); }

// find the topic ID of this reply
$reply = Reply::find_by_id($_GET['id']);
$topic_id = (int) $reply->topic_id;

	// must have an ID
if(empty($_GET['id'])) {
  	$session->message("No reply ID was provided.");
  	redirect_to('topic_detail.php?id='. $topic_id);
}

// Edit reply

if(isset($_POST['submit'])) {
  	$reply->content = htmlentities(trim($_POST['content']));

  	if(empty($reply->content)){
		$message = "Reply content cannot be empty.";
		return false;
	} elseif ($reply && $reply->save()) {
  		redirect_to('topic_detail.php?id='. $topic_id . '#reply' . $reply->id);
	}
} else {
	$content = "";
}

if(isset($database)) { $database->close_connection(); } 