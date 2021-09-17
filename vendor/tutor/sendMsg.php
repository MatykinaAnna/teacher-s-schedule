<?php
    session_start();
    $connect = mysqli_connect('localhost', 'root', 'root', 'tutor');
    if (!$connect) {
        die('Error connect to DataBase');
    }
    $id = $_SESSION['user']['id'];
    $input_data = json_decode(file_get_contents('php://input'),true);
    $date = $input_data["date"];
    $msg = $input_data["msg"];
    $student = $input_data["student"];

    $nameOfStudent = mysqli_query($connect, "SELECT `full_name` FROM `users` where `id` = '$student'");
    $nameOfStudent = mysqli_fetch_assoc($nameOfStudent);
    $nameOfStudent = $nameOfStudent['full_name'];

    $interlocutor = mysqli_query($connect, "SELECT id FROM users WHERE status = 'tutor'");
    $interlocutor = mysqli_fetch_assoc($interlocutor)['id'];

    $sql = mysqli_query($connect, "INSERT INTO `messages` (`id`, `date`, `sender`, `recipient`, `content`, `flag`) VALUES (NULL, '$date', '$interlocutor', '$student', '$msg', '0')");

    $response = [
        "date" => $date,
        "sender" => $interlocutor,
        "recipient" => $nameOfStudent,
        "content" => $msg
    ];

echo json_encode($response);
?>