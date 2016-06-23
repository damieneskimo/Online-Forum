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

$reply = Reply::find_by_id($_GET['id']);

if($reply && $reply->delete()) {
    $session->message("The reply was deleted.");
  	redirect_to('topic_detail.php?id='. $topic_id);
  	// var_dump($topic_id);
} else {
    $session->message("The reply could not be deleted.");
  	redirect_to('topic_detail.php?id=' .$topic_id);
}

if(isset($database)) { $database->close_connection(); } 