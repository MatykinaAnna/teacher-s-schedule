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
        $sql = mysqli_query($connect, "SELECT `idSubject`, `timeBegining`, `idStudent` FROM `schedule` where date='$date' and `isCompleted`='0'");

        for ($i=0; $i<mysqli_num_rows($sql); $i++){
            $schedule[$i] = mysqli_fetch_assoc($sql);
            $shId =  $schedule[$i]['idSubject'];
            $subject = mysqli_query($connect, "SELECT `name` FROM `subject` where `id`='$shId'");
            $subject = mysqli_fetch_assoc($subject);
            $schedule[$i]['idSubject'] = $subject['name'];

            $id = $schedule[$i]['idStudent'];
            $class = mysqli_query($connect, "SELECT `class1` FROM `users` where `id` = '$id'");
            $class = mysqli_fetch_assoc($class);
            $class = $class['class1'];
            $schedule[$i]['class'] = $class;

            $idStudent = mysqli_query($connect, "SELECT `full_name` FROM `users` where `id`='$id'");
            $idStudent = mysqli_fetch_assoc($idStudent);
            $idStudent = $idStudent['full_name'];
//            die($idStudent);
            $schedule[$i]['idStudent'] = $idStudent;
        }
        return ($schedule);
    }

    $response = [
        "schedule" => get_schedule($connect, $id, $date),
    ];

    echo json_encode($response);

?>