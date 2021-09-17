<?php
    session_start();
    $connect = mysqli_connect('localhost', 'root', 'root', 'tutor');
    if (!$connect) {
        die('Error connect to DataBase');
    }

    $id = $_SESSION['user']['id'];
    $array = [];
    $nameOfStudent = mysqli_query($connect, "SELECT `full_name` FROM `users` where `id` = '$id'");
    $nameOfStudent = mysqli_fetch_assoc($nameOfStudent);
    $nameOfStudent = $nameOfStudent['full_name'];

    $sql = mysqli_query($connect, "SELECT * FROM `messages` where `sender`='$id' or `recipient`='$id '");

    for ($i=0; $i<mysqli_num_rows($sql); $i++){
        $array[$i] = mysqli_fetch_assoc($sql);

        $id = $array[$i]['sender'];
        $sender = mysqli_query($connect, "SELECT `full_name` FROM `users` where `id` = '$id'");
        $sender = mysqli_fetch_assoc($sender);
        $sender = $sender['full_name'];

        $id = $array[$i]['recipient'];
        $recipient = mysqli_query($connect, "SELECT `full_name` FROM `users` where `id` = '$id'");
        $recipient = mysqli_fetch_assoc($recipient);
        $recipient = $recipient['full_name'];

        $array[$i]['sender'] = $sender;
        $array[$i]['recipient'] = $recipient;
    }

    $response = [
        "array" => $array,
        "nameOfStudent" => $nameOfStudent
    ];

    echo json_encode($response);

?>