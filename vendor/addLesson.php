<?php
    session_start();
    $connect = mysqli_connect('localhost', 'root', 'root', 'tutor');
    if (!$connect) {
        die('Error connect to DataBase');
    }
    $id = $_SESSION['user']['id'];
    $input_data = json_decode(file_get_contents('php://input'),true);
    $date = $input_data["date"];
    $choiceLesson = $input_data["choiceLesson"];
    $choiceTime = $input_data["choiceTime"];

    $sql = mysqli_query($connect,"SELECT `balance` FROM `users` WHERE `id`='$id'");
    $balance = mysqli_fetch_assoc($sql)['balance'];

    $sql = mysqli_query($connect, "SELECT `id` FROM `subject` WHERE `name`='$choiceLesson'");
    $idSubject = mysqli_fetch_assoc($sql)['id'];

    $sql = mysqli_query($connect, "SELECT `price` FROM `subject` WHERE `id`='$idSubject'");
    $price = mysqli_fetch_assoc($sql)['price'];

    $price = $price * count($choiceTime);

    if ($balance<$price){
        $response = [
            "rezult" => false,
            "msg" => "Недостаточно средств для бронирования занятия",
        ];
    } else{
        foreach ($choiceTime as &$time_leson) {
            $sql = mysqli_query($connect, "INSERT INTO schedule  VALUES (null, '$id', '$idSubject', '$date', '$time_leson', '0')");
        }
        $balance = $balance - $price;
        $sql = mysqli_query($connect, "UPDATE `users` SET `balance` = '$balance' WHERE `users`.`id` = '$id'");
        $response = [
            "rezult" => true,
            "msg" => "Занятия забронированы",
        ];
    }

//    $response = [
//        "choiceLesson" => $choiceLesson,
//        "choiceTime" => $choiceTime,
//    ];

    echo json_encode($response);

?>