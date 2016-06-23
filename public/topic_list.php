<?php include('layouts/header.php'); ?>

<?php if (!$session->is_logged_in()) { redirect_to("login.php"); } ?>
<?php
    // Find all the topics
    $topics = Topic::find_all_topics();

?>

<!-- breadcrumb -->
<ol class="breadcrumb">
  <li><a href="index.php">Home</a></li>
  <li class="active">Topic List</li>
</ol>

<div class="row">
    <div class="col-xs-12 col-md-offset-1 col-md-10 section-title">
        <h2 class="pull-left"><a href="add_topic.php"><button class="btn btn-primary">New Topic</button></a>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-md-offset-1 col-md-10">
        <?php echo output_message($message); ?>

        <table class="table table-bordered table-responsive">
            <tr class="info">
                <th>Topics</th>
                <th>Author</th>
                <th>Time</th>
                <th>Admin</th>
            </tr>

            <?php foreach($topics as $topic): ?>
            <?php 
                // Find the topic user
                $user_id = $topic->user_id;
                $user = User::find_by_id($user_id);
            ?>
            <tr>
                <td>
                    <a href="topic_detail.php?id=<?= $topic->id; ?>"><?= $topic->title;?></a>
                </td>
                <td><a href="account.php?id=<?php echo $user->id; ?>">
                    <?php echo $user->name; ?>              	
                </a></td>
                <td><?= $topic->created_on;?></td>
                <td class="topic-admin-btn">
                    <!-- check if the login user is the topic owner -->
                    <?php if($session->user_id == $topic->user_id) { ?>
                    	<a href="update_topic.php?id=<?= $topic->id; ?>"><button class="btn btn-primary btn-xs">Edit</button></a>
                    	<a href="delete_topic.php?id=<?= $topic->id; ?>"><button class="btn btn-danger btn-xs" onclick="return confirm('Are you sure?');" style="margin-left: 1em;">Delete</button></a>
                    <?php } ?>
                </td>
                
            </tr>
        	<?php endforeach; ?>
        </table>

    </div>
</div>  <!-- row -->

<?php include('layouts/footer.php'); ?>