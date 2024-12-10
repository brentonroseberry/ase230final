<?php
session_start();
require_once('data/db.php');
$post_id = $_GET['post_id'];
$item_id = $_GET['item_id'];
if(!isset($_SESSION['username'])) {
    header('Location: index.php');
}
$db->beginTransaction();

$deleteitem = $db->prepare("DELETE FROM items WHERE itemID = :itemID");
$deleteitem->bindParam(':itemID', $item_id);
$deleteitem->execute();

$db->commit();

header('Location: detail.php?post_id='.$post_id);
?>