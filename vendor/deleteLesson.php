<?php

    session_start();
    $connect = mysqli_connect('localhost', 'root', 'root', 'tutor');
    if (!$connect) {
        die('Error connect to DataBase');
    }

    $id = $_SESSION['user']['id'];

    $input_data = json_decode(file_get_contents('php://input'),true);
    $date = $input_data["date"];
    $time = $input_data["time"];

    $sql = mysqli_query($connect, "SELECT `idSubject` FROM `schedule` WHERE idStudent='$id' AND `date`='$date' AND timeBegining='$time'");
    $idSubject = mysqli_fetch_assoc($sql)['idSubject'];
    $sql = mysqli_query($connect, "SELECT `price` FROM `subject` WHERE `id`='$idSubject'");
    $price = mysqli_fetch_assoc($sql)['price'];

    $sql = mysqli_query($connect, "DELETE FROM schedule WHERE idStudent='$id' AND `date`='$date' AND timeBegining='$time'");

    $sql = mysqli_query($connect,"SELECT `balance` FROM `users` WHERE `id`='$id'");
    $balance = mysqli_fetch_assoc($sql)['balance'];
    $balance = $balance+$price;

    $sql = mysqli_query($connect, "UPDATE `users` SET `balance` = '$balance' WHERE `id`='$id'");

    if ($sql){
        echo (true);
    } else {
        echo (false);
    }

?>