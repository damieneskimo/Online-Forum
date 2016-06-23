<?php 
require_once("../includes/initialize.php"); 

$brand = new Brand();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="stylesheets/main.css">
</head>
<body>
<header>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><?= $brand->getName(); ?></a>
            </div>

            <?php if($session->is_logged_in()) { ?>
                <?php 
                    // Find the logged in user
                    $user = User::find_by_id($session->user_id);
                ?>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="account.php?id=<?= $user->id; ?>"><p><?= $user->name; ?> <span class="label label-primary"><?= $user->contribution; ?></span></p></a></li>
                        <li><a id="signup" class="btn " href="logout.php">Logout</a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            <?php } else { ?>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a id="signup" class="btn " href="sign_up.php">Sign up</a></li>
                        <li><a id="login" class="btn " href="login.php">Login</a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            <?php } ?>


        </div><!-- /.container-fluid -->
    </nav>
</header>

<main>
    <div class="container-fluid">
        