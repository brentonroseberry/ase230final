<?php
session_start();
require_once('data/db.php');
$post_id = $_GET['post_id'];
if(!isset($_SESSION['username'])) {
    header('Location: index.php');
}
$db->beginTransaction();

$deleteitems = $db->prepare("DELETE FROM items WHERE listID = :listID");
$deleteitems->bindParam(':listID', $post_id);
$deleteitems->execute();

$deletelist = $db->prepare("DELETE FROM lists WHERE listID = :listID");
$deletelist->bindParam(':listID', $post_id);
$deletelist->execute();

$db->commit();

header('Location: index.php');
?>