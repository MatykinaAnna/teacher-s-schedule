<?php

    session_start();
    $connect = mysqli_connect('localhost', 'root', 'root', 'tutor');
    if (!$connect) {
        die('Error connect to DataBase');
    }

    $id = $_SESSION['user']['id'];
    $input_data = json_decode(file_get_contents('php://input'),true);
    $date = $input_data["date"];

    $arrayTimeLessons = ['09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00'];

    $sql = mysqli_query($connect, "SELECT `timeBegining` FROM `schedule` WHERE`date`='$date'");

    for ($i=0; $i<mysqli_num_rows($sql); $i++){
        $time = strval(mysqli_fetch_assoc($sql)['timeBegining']);
        $time = $time[0].$time[1] + 0;
        unset($arrayTimeLessons[$time - 9]);
    }

    $arrayTimeLessons = array_chunk($arrayTimeLessons, 4);

    $response = [
        "arrayTimeLessons" => $arrayTimeLessons,
    ];

    echo json_encode($response);

?>