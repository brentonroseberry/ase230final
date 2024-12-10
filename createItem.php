<?php
session_start();
require_once('data/db.php');
$post_id=$_GET['post_id'];

if(!isset($_SESSION['username'])) {
    header('Location: index.php');
}
if(count($_POST) > 0){
    $title = $_POST['title'];
    $desc = $_POST['desc'];
    $where = $_POST['where'];
    $rating = $_POST['rating'];
    $review = $_POST['review'];


    $insert = $db->prepare('INSERT INTO items (itemID, listID, Name, Location, Description, Rating, Review) VALUES (NULL, ?, ?, ?, ?, ?, ?)');
    $insert->execute([$post_id, $title, $where, $desc, $rating, $review]);

}
?>
<html lang="en">
<head>
    <title>Create Item</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<a href="detail.php?post_id=<?=$post_id?>">Go Back</a>
<h3>Create Item</h3>
<form method="POST">
    What is it called?<strong>*</strong><br>
    <input autocomplete="off" type="text" name="title" required><br><br>
    Describe it<strong>*</strong><br>
    <input autocomplete="off" type="text" name="desc" required><br><br>
    Where can it be found?<strong>*</strong><br>
    <input autocomplete="off" type="text" name="where" required><br><br>
    Give it a rating(1-5)<strong>*</strong><br>
    <input autocomplete="off" type="text" name="rating" required><br><br>
    Write a small review<strong>*</strong><br>
    <input autocomplete="off" type="text" name="review" required><br><br>
    <button type="submit">Submit</button>
</form>
</body>
</html>