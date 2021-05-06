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
    <title>Vota Opere</title>
</head>
<body>
<?php
if (isset($_SESSION['user_auth'])){
$user = $_SESSION['user_auth'];
echo "<h1>Benvenuto " . $user . ", in questa pagina puoi votare l'opera che preferisci</h1>";
$sql = "SELECT nome_file FROM db_esercizio7.opere";
$result = $conn->query($sql);
$pictures = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        array_push($pictures, $row['nome_file']);
    }
}
$conn->close();
//var_dump($pictures);
?>
<form action="voted.php" method="post">
    <?php
    for ($i = 0; $i < count($pictures); $i++) {
        ?>
        <label for="opera<?= $i+1 ?>"> <img style="width: 33%; height: auto" src="<?= $pictures[$i] ?>"
                                          alt="Opera numero <?= $i+1 ?>">Vota opera <?= $i+1 ?> </label>
        <input type="radio" name="vote" id='opera<?= $i+1 ?>' value='opera<?= $i+1 ?>' <?= $i == 0 ? 'checked' : '' ?>>
        <h1>opera<?=$i+1?></h1>
        <br>
        <?php
    }
    ?>
    <input type="submit" name="submit" id="submit" value="Vota">
    <?php
    }
    else {
        echo "<h1>Prima ti votare devi <a href='login.php'>eseguire il login</a></h1>";
    }
    ?>
</form>
</body>
</html>
