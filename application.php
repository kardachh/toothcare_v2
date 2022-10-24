<?php

$dbHost = "localhost";
$user = "root";
$pass = "root";
$dbName = "tooth_care";
$mysqli = mysqli_connect($dbHost, $user, $pass, $dbName);
if ($mysqli == false) {
    echo ("Ошибка подключения к БД!");
}

$name = $_POST['name'];

if(mb_strlen($name)<2 || mb_strlen($name)>30){
    echo("Недопустимая длина имени!");
    exit();
}

$telNumber = $_POST['telNumber'];

if(mb_strlen($telNumber) != 11){
    echo("Недопустимая длина номера телефона, максимум 11 символов!");
    exit();
}

$mail = $_POST['mail'];

if(mb_strlen($mail) > 50 || mb_strlen($mail) < 15){
    echo("Недопустимая длина почты!");
    exit();
}

$result = mysqli_query($mysqli, "SELECT * FROM `application` WHERE `mail` = '$mail' OR WHERE `telNaumber` = $telNumber");

$application = mysqli_fetch_assoc($result);

if(count($application) > 0){
    echo("Вы уже оставляли заявку!");
    exit();
}

mysqli_query($mysqli, "INSERT INTO `application` (`id`, `name`, `number`, `mail`) VALUES (NULL, '$name', '$telNumber', '$mail');");

$mysqli -> close();

header('Location: /');

exit();

?>