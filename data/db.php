<?php

//Configure credentials
$host='localhost';
$name='projectdatabase';
$user='baseUser';
$pass='simplePassword';
$user2='loggedInUser';
$pass2='loggedPassword';

//Specify options
$opt = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false
];

//Establish a connection to the db
global $db;
if(isset($_SESSION['username'])){
    $db=new PDO('mysql:host='.$host.';dbname='.$name.';charset=utf8mb4',$user2,$pass2,$opt);
} else {
    $db=new PDO('mysql:host='.$host.';dbname='.$name.';charset=utf8mb4',$user,$pass,$opt);
}
//header('Location: midterm/index.php');