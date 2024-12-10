<?php session_start();
require_once('../data/db.php');
if(isset($_SESSION['username'])) { header('Location: index.php'); }

if(count($_POST) > 0) {
    if(isset($_POST['username'][0]) && isset($_POST['password'][0])){
        $inPass = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $inUser = $_POST['username'];
        $query = $db->prepare('SELECT Username FROM users WHERE Username = ?');
        $query->execute([$inUser]);
        $userExists = $query->fetchColumn();

        if($userExists) {
            echo "Username already taken";
        } else {
            $insert = $db->prepare('INSERT INTO users(userID, Username, Password, isAdmin) VALUES (NULL, ?, ?, 0)');
            $insert->execute([$inUser, $inPass]);
            echo "Signup complete! log in here: " ?><a href="signin.php">sign in</a><?php
        }
    } else { echo 'Username and password are required'; }
}
?>
<html lang="en">
    <head>
        <title>Sign Up</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <h3>Sign Up</h3>
        <form method="POST">
            Username<strong>*</strong><br>
            <input autocomplete="off" type="text" name="username" required><br><br>
            Password<strong>*</strong><br>
            <input autocomplete="off" type="password" name="password" required><br><br>
            <button type="submit">Sign Up</button>
        </form>
        <p>Already have an account? <a href="signin.php">Sign in</a></p>
    </body>
</html>