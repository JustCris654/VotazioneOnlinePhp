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
if(isset($_REQUEST['vote']) and isset($_SESSION['user_auth'])){
    echo "";
} else {
    echo "devi loggarti caca";
}
?>
</body>
</html>