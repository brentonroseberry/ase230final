<?php
session_start();
if(!isset($_SESSION['username'])) {
    header('Location: index.php');
}
$item_id=$_GET['item_id'];
$post_id=$_GET['post_id'];
require_once('data/db.php');

$getItem = $db->prepare("SELECT * FROM items WHERE itemID = ?");
$getItem->execute([$item_id]);
$getItem = $getItem->fetch();

if(count($_POST) > 0) {
    $title = $_POST['title'];
    $desc = $_POST['desc'];
    $where = $_POST['where'];
    $rating = $_POST['rating'];
    $review = $_POST['review'];

    $updateItem = $db->prepare("UPDATE items SET Name = ?, Location = ?, Description = ?, Rating = ?, Review = ? WHERE itemID = ?");
    $updateItem->execute([$title, $where, $desc, $rating, $review, $item_id]);
    header('Location: detail.php?post_id='.$post_id);
}

?>
<html lang="en">
<head>
    <title>Edit Item</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<a href="detail.php?post_id=<?= $post_id ?>">Go Back</a>
<h3>Edit Item</h3>
<form method="POST">
    What is it called?<strong>*</strong><br>
    <input autocomplete="off" type="text" name="title" value="<?=$getItem['Name']?>" required><br><br>
    Describe it<strong>*</strong><br>
    <input autocomplete="off" type="text" name="desc" value="<?=$getItem['Description']?>" required><br><br>
    Where can it be found?<strong>*</strong><br>
    <input autocomplete="off" type="text" name="where" value="<?=$getItem['Location']?>" required><br><br>
    Give it a rating(1-5)<strong>*</strong><br>
    <input autocomplete="off" type="text" name="rating" value="<?=$getItem['Rating']?>" required><br><br>
    Write a small review<strong>*</strong><br>
    <input autocomplete="off" type="text" name="review" value="<?=$getItem['Review']?>" required><br><br>
    <button type="submit">Submit</button>
</form>
</body>
</html>
