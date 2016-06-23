<?php include('layouts/header.php'); ?>

<?php if (!$session->is_logged_in()) { redirect_to("login.php"); } ?>

<?php
  	if(empty($_GET['id'])) {
	    $session->message("No topic ID was provided.");
	    redirect_to('topic_list.php');
  	}
  
  	$topic = Topic::find_by_id($_GET['id']);

  	// find the owner of the topic 
  	$user_id = $topic->user_id;
	$user = User::find_by_id($user_id);

  	if(!$topic) {
	    $session->message("The topic could not be found.");
	    redirect_to('topic_list.php');
	}

	// Add new reply
	if(isset($_POST['submit'])) {
	  	$content = htmlentities(trim($_POST['content'])); 
	  	$user_id = $session->user_id;
	  	$topic_id = $topic->id;

	  	$new_reply = Reply::make($topic_id, $user_id, $content);
	  	// var_dump($new_reply);

	  	if($new_reply && $new_reply->save()) {
	  		$reply_user = User::find_by_id($new_reply->user_id);
	  		$reply_user->contribution++;
	  		$reply_user->save();

	  		redirect_to('topic_detail.php?id='. $topic->id . '#reply-form');
		} else {
			// Failed
			if(empty($content)){
				$message = "Reply content cannot be empty.";
			} else {
		    	$message = "There was an error that prevented the reply from being saved.";
			}
		}
	} else {
		$content = "";
	}
	
	$replies = $topic->replies();
	
?>

<!-- breadcrumb -->
<ol class="breadcrumb">
  <li><a href="index.php">Home</a></li>
  <li><a href="topic_list.php">Topic List</a></li>
  <li class="active">Topic Detail</li>
</ol>

<div class="row">
    <div class="col-xs-12 col-md-offset-1 col-md-10">
    	<!-- validation -->
		<?php echo output_message($message); ?>
    	<div class="panel panel-primary">
		  	<div class="panel-heading">
		    	<h3 class="panel-title"><?= $topic->title; ?></h3>
		  	</div>
		  	<div class="panel-body comment">
		    	<blockquote>
		            <?= $topic->content; ?>
		        </blockquote>
		  	</div>
		  	<div class="panel-footer">
		  		<ul class="list-inline">
			        <li><h4><a href="account.php?id=<?= $user->id; ?>"><?= $user->name; ?></a></h4></li>
			        <li>Contribution <span class="label label-primary"><?= $user->contribution; ?></span></li>
			        <li>posted on <?= $topic->created_on; ?></li>
			    </ul>	
		  	</div>
		</div>
    </div>
</div><!-- /.row -->

<?php foreach ($replies as $reply) { ?>
	<?php 
		// Find reply user
    	$reply_user_id = $reply->user_id;
    	$reply_user = User::find_by_id($reply_user_id);
    ?>	

	<div class="row">
	    <div class="col-xs-12 col-md-offset-1 col-md-2 profile">
	        <ul class="list-unstyled">
	            <li><h1><a href="account.php?id=<?= $reply_user->id; ?>">
	            	<?php echo $reply_user->name; ?>	
	            </a></h1></li>
	            <li>Contribution <span class="label label-primary"><?= $reply_user->contribution; ?></span></li>
	            <li><?= $reply->created_on; ?></li>
	        </ul>
	    </div>
	    <div class="col-xs-12 col-md-8" id="reply<?= $reply->id; ?>">
	        <div class="comment">
	            <blockquote>
	                <?= $reply->content; ?>
	            </blockquote>
	            <!-- check if the login user is the reply owner -->
                <?php if($session->user_id == $reply->user_id) { ?>
		            <div>
		                <button class="btn btn-primary btn-xs"  data-toggle="modal" data-target="#Modal--edit_reply<?= $reply->id; ?>">Edit</button>
		            	<a href="delete_reply.php?id=<?= $reply->id; ?>"><button class="btn btn-danger btn-xs" onclick="return confirm('Are you sure?');" style="margin-left: 1em;">Delete</button></a>
	            	</div>
            	<?php } ?>
	        </div>
	    </div>
	</div><!-- /.row -->

	<!-- edit reply content modal -->
	<div class="modal fade" tabindex="-1" role="dialog" id="Modal--edit_reply<?= $reply->id; ?>">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">Edit Reply</h4>
	      </div>
	      <div class="modal-body">
	      <?php echo output_message($message); ?>
	      	<form action="update_reply.php?id=<?= $reply->id; ?>" method="post">
	            <textarea class="form-control" name="content" rows="5" required><?= $reply->content; ?></textarea>
	            <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
		      	</div>
	        </form>
	      </div>	      
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
<?php }; ?>

<div class="row" id="reply-form">
    <div class="col-xs-12 col-md-offset-1 col-md-2"></div>
    <div class="col-xs-12 col-md-8">
        <form action="topic_detail.php?id=<?= $topic->id; ?>" method="post">
            <textarea class="form-control" name="content" rows="5"></textarea>
            <button type="submit" name="submit" class="btn btn-primary pull-right">Reply</button>
        </form>
    </div>
</div>


<?php include('layouts/footer.php'); ?>