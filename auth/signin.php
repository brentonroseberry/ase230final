<?php
session_start();
require_once('../data/db.php');
$submitted = true; ?>
<html>
    <head>
        <title>Sign In</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <a href="../index.php">Go Back</a>
        <h3>Sign In</h3>
<?php
if(isset($_SESSION['username'])) { header('Location: ../index.php'); }
if(count($_POST) > 0){
    if(isset($_POST['username'][0]) && isset($_POST['password'][0])){
        $inPass = $_POST['password'];
        $inUser = $_POST['username'];
        $query = $db->prepare("SELECT Password FROM users WHERE Username = ?");
        $query->execute([$inUser]);
        $query = $query->fetchColumn();
        if($query && password_verify($inPass, $query)){
            $_SESSION['username'] = $inUser;
            $check = $db->prepare('SELECT isAdmin FROM users WHERE Username = ?');
            $check->execute([$inUser]);
            $check = $check->fetchColumn();
            if($check == 1 ){$_SESSION['isAdmin'] = 1;}
            $submitted = false;
            header('Location: ../index.php');
        }
        if($submitted) { ?><strong>Invalid Credentials</strong><?php }

    }
}
?>
        <form method="POST">
            Username<br>
            <input autocomplete="off" type="text" name="username" required><br><br>
            Password<br>
            <input autocomplete="off" type="password" name="password" required><br><br>
            <button type="submit">Sign in</button>
        </form>
        <p>Don't have an account? <a href="signup.php">Sign up</a></p>
    </body>
</html>