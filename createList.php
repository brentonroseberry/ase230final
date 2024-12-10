<?php
session_start();
require_once('data/db.php');
if(!isset($_SESSION['username'])) {
    header('Location: index.php');
}
if(count($_POST) > 0){
    $title = $_POST['title'];
    $desc = $_POST['desc'];
    $author = $_SESSION['username'];
    $date = date("Y-m-d");

    $query = $db->prepare('SELECT userID FROM users WHERE Username = ?');
    $query->execute([$author]);
    $userID = $query->fetchColumn();

    $insert = $db->prepare('INSERT INTO lists (listID, userID, Title, Description, lastUpdated) VALUES (NULL, ?, ?, ?, ?)');
    $insert->execute([$userID, $title, $desc, $date]);

}
?>
<html lang="en">
    <head>
        <title>Create Post</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <a href="index.php">Go Back</a>
        <h3>Create List</h3>
        <form method="POST">
            List Title<strong>*</strong><br>
            <input autocomplete="off" type="text" name="title" required><br><br>
            Description of List<strong>*</strong><br>
            <input autocomplete="off" type="text" name="desc" required><br><br>
            <button type="submit">Submit</button>
        </form>
    </body>
</html>