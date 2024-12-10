<html lang="en">
    <a href="index.php">Go Back</a><br>
    <?php
    session_start();
    $post_id=$_GET['post_id'];
    require_once("data/db.php");

    $write = $db->prepare('SELECT userID FROM lists WHERE listID = ?');
    $write->execute([$post_id]);
    $userID = $write->fetchColumn();
    $query = $db->prepare('SELECT Username FROM users WHERE userID = ?');
    $query->execute([$userID]);
    $author = $query->fetchColumn();
    if(($_SESSION['username']) == $author || isset($_SESSION['isAdmin'])){?><a href="deleteList.php?post_id=<?=$post_id?>">Delete List</a><br><?php }
    if(($_SESSION['username']) == $author || isset($_SESSION['isAdmin'])){?><a href="editList.php?post_id=<?=$post_id?>">Edit List</a><?php }

    function printItem ($r, $post_id, $author){ ?>
    <div>
        <h4><?=$r['Name']?><br>
        Found on: <?=$r['Location']?></h4>
        <?php if(($_SESSION['username']) == $author || isset($_SESSION['isAdmin'])){?><a href="editItem.php?item_id=<?=$r['itemID']?>&post_id=<?=$post_id?>">Edit Item</a><?php } ?>
        <?php if(($_SESSION['username']) == $author || isset($_SESSION['isAdmin'])){?><a href="deleteItem.php?item_id=<?=$r['itemID']?>&post_id=<?=$post_id?>">Delete Item</a><?php } ?>

        <p><?=$r['Description']?></p>
        <p>Rated a <?=$r['Rating']?> out of 5<br>
        <?=$r['Review']?></p>
        <hr>
    </div>
    <?php } ?>
    <head>
        <title>Roseberry Midterm</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
    <h2><?php $write = $db->prepare('SELECT Title FROM lists WHERE listID = ?'); $write->execute([$post_id]); echo $write = $write->fetchColumn()?></h2>

    <h3>By: <?= $author?><br>

    Last Updated on: <?php $write = $db->prepare('SELECT lastUpdated FROM lists WHERE listID = ?'); $write->execute([$post_id]); echo $write = $write->fetchColumn()?><br>

    <?php $write = $db->prepare('SELECT Description FROM lists WHERE listID = ?'); $write->execute([$post_id]); echo $write = $write->fetchColumn()?></h3>
    <?php if(($_SESSION['username']) == $author || isset($_SESSION['isAdmin'])){?><a href="createItem.php?post_id=<?=$post_id?>">Add Items</a><br><br><hr><?php }

    $result=$db->prepare('SELECT * FROM items WHERE listID = ?');
    $result->execute([$post_id]);
    while ($row = $result->fetch()){ printItem($row, $post_id, $author); }?>
    </body>
</html>
