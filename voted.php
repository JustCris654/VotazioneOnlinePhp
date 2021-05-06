<?php
session_start();
require 'connection_db.php';
$conn = connect_db("root", "", "db_esercizio7");
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php
if (isset($_POST['vote']) and isset($_SESSION['user_auth'])) {
    $voted_picture = $_POST['vote'];
    $user = $_SESSION['user_auth'];
    ?>
    <p>Hai votato <?= $voted_picture ?> loggato come <?= $user ?></p>
    <?php
    $sql = "SELECT id FROM utenti WHERE nome_utente='$user'";
    $id_user = -1;
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $id_user = $row['id'];
    }
    if($id_user != -1){
        $stmt = $conn->prepare("");
    }
} else {
    echo "Devi prima <a href='vote_page.php'>votare</a>
          oppure <a href='login.php'>loggarti</a> se non l'hai ancora fatto";
}
?>
</body>
</html>