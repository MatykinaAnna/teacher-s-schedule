<?php
    session_start();
    $connect = mysqli_connect('localhost', 'root', 'root', 'tutor');
    if (!$connect) {
        die('Error connect to DataBase');
    }

    $id = $_SESSION['user']['id'];
    $input_data = json_decode(file_get_contents('php://input'),true);
    $student = $input_data["student"];

    $array = [];
    $nameOfStudent = mysqli_query($connect, "SELECT `full_name` FROM `users` where `id` = '$student'");
    $nameOfStudent = mysqli_fetch_assoc($nameOfStudent);
    $nameOfStudent = $nameOfStudent['full_name'];

    $nameOfTutor = mysqli_query($connect, "SELECT `full_name` FROM `users` where `id` = '$id'");
    $nameOfTutor = mysqli_fetch_assoc($nameOfTutor);
    $nameOfTutor = $nameOfTutor['full_name'];

    $sql = mysqli_query($connect, "SELECT * FROM `messages` where `sender`='$student' or `recipient`='$student '");

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
        "student" => $student,
        "array" => $array,
        "nameOfStudent" => $nameOfStudent,
        "nameOfTutor" => $nameOfTutor,
    ];

    echo json_encode($response);
?>