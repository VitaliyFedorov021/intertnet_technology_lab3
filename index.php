<?php
include('connect.php');
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="script.js"></script>
    <link href="style.css" rel="stylesheet"><?php
include('connect.php');
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="script.js"></script>
    <link href="style.css" rel="stylesheet">
    <title>LB3</title>
</head>
<body>
<div id="toLoad"></div>
<br>
<form action="" method="post" id="name">
    Получить статистику работы в сети выбранного клиента: 
    <select name="name">
        <?php
            $statement = $dbh->query("SELECT DISTINCT name FROM client");
            while ($data = $statement->fetch()) {
                echo "<option value='$data[0]'>$data[0]</option>";
            }
        ?>
    </select>
    <input type="submit" value="OK"><br>
</form>
<br>
<br>
<form action="" method="post" id="date">
<label>Получить статистику работы в сети c 
    <input type="datetime-local" name="start">
    по
    <input type="datetime-local" name="stop">
    <input type="submit" value="Enter"><br>
</form>
<br>
<br>
<form action="" method="post" id="balance">
    Получить список клиентов с отрицательным балансом счета:
    <input type="submit" value="OK"><br>
</form>
</body>
</html>