<!doctype html>
<?php
session_start();

require 'connection_db.php';
$conn = connect_db("root", "", "db_esercizio7");
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <style>
        body {
            text-align: center;
        }

        form label {
            display: inline-block;
            padding-right: 10px;
            padding-bottom: 10px;
        }
    </style>
</head>
<body>
<h1>Login Votazione 0nline</h1>
<?php
if (!isset($_GET['error'])) {
    $_GET['error'] = 0;
}

if ($_GET['error'] == 1) {
    ?>
    <h1>Errore di accesso, utente non trovato</h1>
    <form action="login.php" method="post">
        <input type="submit" name="riprova" value="Riprova">
    </form>
    <?php if (isset($_REQUEST['riprova'])) {
        header('Location: /login.php?error=0');
    }
} else {
    if (isset($_REQUEST['login'])) {

        $username = $_POST['username'];
        $password = $_POST['password'];
//      echo "<script>console.log('$username', '$password')</script>";

        $sql = "SELECT nome_utente, password FROM utenti WHERE nome_utente=\"$username\" AND password = \"$password\"";

        $result = $conn->query($sql);
        if ($result->num_rows == 1) {
            $conn->close();
            $_SESSION['user_auth'] = $username;
            header('Location: /login_result.php?login=1');
        } else {
            header('Location: /login.php?error=1');
        }
        exit();
    } else {
        ?>
        <form action="login.php" method="post">
            <label for="username">Inserisci username:</label>
            <input type="text" name="username" id="username" required> <br>

            <label for="password">Inserisci password:</label>
            <input type="password" name="password" id="password" required> <br>
            <input type="submit" value="Login" name="login" id="login">
        </form>
        <?php
    }
}
?>

</body>
</html>