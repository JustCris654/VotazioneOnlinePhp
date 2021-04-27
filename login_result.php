<!doctype html>
<?php
session_start();
if(isset($_REQUEST['login'])){
    $result = $_GET['login'];
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
<h1>
<?php
if($result=="1"){
    $user = $_SESSION['user_auth'];
    echo "Login effettuato, Benvenuto $user";
    ?>
    <p>Vai alla <a href="vote_page.php">votazione</a></p>
    <?php
} elseif ($result == "0"){
    echo "Errore, credenziali errate"; ?>
    <p>Torna alla pagina di <a href="login.php">Login</a></p>
    <?php
}
?>
</h1>
</body>
</html>
