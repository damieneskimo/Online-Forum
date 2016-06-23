<?php 
require_once("../includes/initialize.php"); 

if (!$session->is_logged_in()) { redirect_to("login.php"); }

	// must have an ID
if(empty($_GET['id'])) {
  	$session->message("No topic ID was provided.");
    redirect_to('topic_list.php');
}

$topic = Topic::find_by_id($_GET['id']);

if($topic && $topic->delete()) {
    $session->message("The topic was deleted.");
    redirect_to('topic_list.php');
} else {
    $session->message("The photo could not be deleted.");
    redirect_to('topic_list.php');
}

if(isset($database)) { $database->close_connection(); } 