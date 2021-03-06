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
    echo "<h1>user: $user, votato: $voted_picture</h1>";

    //retrieve user id from the user name
    $sql = "SELECT id_utente FROM db_esercizio7.utenti WHERE nome_utente = '$user'";
    $id_user = -1;
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $id_user = $row['id_utente'];
    }
    echo "<h1>id user $id_user</h1>";

    //retrieve the picture id from the name of it
    $sql = "SELECT id_opera FROM db_esercizio7.opere WHERE nome_opera = '$voted_picture'";
    $id_opera = -1;
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $id_opera = $row['id_opera'];
    }
    echo "<h1>id opera $id_opera</h1>";


    if ($id_user != -1 and $id_opera != -1) {
        $stmt = $conn->prepare("INSERT INTO db_esercizio7.voti (utente, opera)
            VALUES (?, ?)");
        $stmt->bind_param("ii", $id_user, $id_opera);
        $stmt->execute();
        echo "<p>Hai votato $voted_picture loggato come $user</p>";
        session_destroy();
    }
} else {
    echo "Devi prima <a href='vote_page.php'>votare</a>
          oppure <a href='login.php'>loggarti</a> se non l'hai ancora fatto";
}
?>
</body>
</html>