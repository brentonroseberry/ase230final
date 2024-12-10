<?php
session_start();
require_once("data/db.php");

function printLists($r, $db){
    $userID= $r['userID'];
    $query = $db->prepare('SELECT Username FROM users WHERE userID = ?');
    $query->execute([$userID]);
    $username = $query->fetchColumn();?>
    <div>
        <h3><a href="detail.php?post_id=<?= $r['listID'] ?>"><?= $r['Title']?></a></h3>
        <h4>By: <?= $username?></h4>
        <br>
    </div>
<?php } ?>

<html lang="en">
    <head>
        <title>Roseberry Final</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <h1>Welcome <?php if(!isset($_SESSION['username'])) { echo ""; }
            else { echo $_SESSION['username']; }?></h1>
        <?php if(!isset($_SESSION['username'])){?><a href="auth/signin.php">Sign In</a><br><?php }?>
        <?php if(isset($_SESSION['username'])){?><a href="auth/signout.php">Sign Out</a><br><?php }?>
        <h2>Our User's Lists of Things to Watch or Play:</h2>
        <a href="createList.php">Make a List</a>
        <?php $result=$db->query('SELECT * FROM lists');
        while ($row = $result->fetch()){ printLists($row, $db); }?>
    </body>
</html> <!-- By Brenton Roseberry -->