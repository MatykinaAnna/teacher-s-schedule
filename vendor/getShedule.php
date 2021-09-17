<?php
    session_start();
    $connect = mysqli_connect('localhost', 'root', 'root', 'tutor');
    if (!$connect) {
        die('Error connect to DataBase');
    }

    $id = $_SESSION['user']['id'];
    $input_data = json_decode(file_get_contents('php://input'),true);
    $date = $input_data["date"];

    function get_schedule($connect, $id, $date){
        $schedule = [];
        $sql = mysqli_query($connect, "SELECT `idSubject`, `timeBegining` FROM `schedule` where date='$date' and `idStudent`='$id' and `isCompleted`='0'");

        for ($i=0; $i<mysqli_num_rows($sql); $i++){
            $schedule[$i] = mysqli_fetch_assoc($sql);
            $shId =  $schedule[$i]['idSubject'];
            $subject = mysqli_query($connect, "SELECT `name` FROM `subject` where `id`='$shId'");
            $subject = mysqli_fetch_assoc($subject);
            $schedule[$i]['idSubject'] = $subject['name'];
        }
        return ($schedule);
    }

    $response = [
        "schedule" => get_schedule($connect, $id, $date),
    ];

    echo json_encode($response);

?>