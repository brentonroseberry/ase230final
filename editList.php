<?php
session_start();
if(!isset($_SESSION['username'])) {
    header('Location: index.php');
}
$post_id=$_GET['post_id'];
require_once('data/db.php');

$getlist = $db->prepare("SELECT * FROM lists WHERE listID = ?");
$getlist->execute([$post_id]);
$getlist = $getlist->fetch();

if(count($_POST) > 0) {
    $title = $_POST['title'];
    $desc = $_POST['desc'];
    $date = date("Y-m-d");

    $updatelist = $db->prepare("UPDATE lists SET Title = ?, Description = ?, lastUpdated = ? WHERE listID = ?");
    $updatelist->execute([$title, $desc, $date, $post_id]);
    header('Location: detail.php?post_id='.$post_id);
}

?>
<html lang="en">
    <head>
        <title>Edit List</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <a href="detail.php?post_id=<?= $post_id ?>">Go Back</a>
        <h3>Edit List</h3>
        <form method="POST">
            List Title<strong>*</strong><br>
            <input autocomplete="off" type="text" name="title" value="<?= $getlist['Title'] ?>" required><br><br>
            Description of List<strong>*</strong><br>
            <input autocomplete="off" type="text" name="desc" value="<?= $getlist['Description'] ?>" required><br><br>
            <button type="submit">Edit</button>
        </form>
    </body>
</html>
